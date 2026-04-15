<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    public function countAll(): int
    {
        return Order::count();
    }

    public function countPendingServiceStatus(): int
    {
        return Order::where('service_status', 'pending')->count();
    }

    public function countByClientId(int $clientId): int
    {
        return Order::where('client_id', $clientId)->count();
    }

    public function countByColumnValue(string $column, string $value): int
    {
        return Order::where($column, $value)->count();
    }

    public function create(array $data): Order
    {
        return Order::create($data);
    }

    public function updateByOrderId(int $orderId, array $data): int
    {
        return Order::where('order_id', $orderId)->update($data);
    }

    public function getByClientId(int $clientId): Collection
    {
        return Order::where('client_id', $clientId)->get();
    }

    public function getCustomerOrdersWithReview(int $customerId): Collection
    {
        return Order::query()
            ->where('orders.user_id', $customerId)
            ->join('services', 'services.service_id', '=', 'orders.service_id')
            ->leftJoin('service_reviews', function ($join) {
                $join->on('service_reviews.user_id', '=', 'orders.user_id')
                    ->on('service_reviews.service_id', '=', 'orders.service_id');
            })
            ->select('services.*', 'orders.*', 'service_reviews.ro_id as usrReview')
            ->get();
    }

    public function getOrderWithRelationsById(int $orderId): Collection
    {
        return Order::query()
            ->where('orders.order_id', $orderId)
            ->join('services', 'services.service_id', '=', 'orders.service_id')
            ->join('service_catalogs', 'service_catalogs.id', '=', 'services.service_catalog_id')
            ->join('customers', 'customers.id', '=', 'orders.user_id')
            ->join('clients', 'clients.id', '=', 'orders.client_id')
            ->select(
                'orders.order_code',
                'orders.service_status',
                'orders.booking_date',
                'orders.time_slot',
                'orders.address',
                'orders.pay_status',
                'orders.item_ids',
                'orders.amount',
                'services.name as provider_name',
                'services.city',
                'services.state',
                'service_catalogs.service_name',
                'service_catalogs.service_category',
                'customers.user_code',
                'customers.user_name',
                'customers.user_email',
                'customers.user_mobile',
                'clients.client_code',
                'clients.client_name',
                'clients.client_email'
            )
            ->get();
    }

    public function getInvoiceDataByOrderCode(string $orderCode, int $customerId): ?array
    {
        $row = DB::table('orders')
            ->where('orders.order_code', trim($orderCode))
            ->where('orders.user_id', $customerId)
            ->join('clients', 'clients.id', '=', 'orders.client_id')
            ->join('customers', 'customers.id', '=', 'orders.user_id')
            ->join('services', 'services.service_id', '=', 'orders.service_id')
            ->select(
                'orders.order_code',
                'orders.created_at',
                'orders.item_ids as user_ser_item',
                'orders.address as order_address',
                'customers.user_code',
                'customers.user_name',
                'customers.user_email',
                'customers.user_mobile',
                'clients.client_code',
                'clients.client_email',
                'clients.client_mobile',
                'services.name as service_name',
                'services.address as service_address',
                'services.city as service_city',
                'services.state as service_state',
                'services.pincode as service_pincode',
                'services.email as service_email',
                'services.phone as service_phone'
            )
            ->first();

        return $row ? (array) $row : null;
    }

    public function hasCustomerBookedService(int $serviceId, int $customerId): bool
    {
        return DB::table('orders')
            ->where('service_id', $serviceId)
            ->where('user_id', $customerId)
            ->exists();
    }

    public function getCustomerServiceReview(int $serviceId, int $customerId): ?object
    {
        return DB::table('orders')
            ->join('service_reviews', 'service_reviews.user_id', '=', 'orders.user_id')
            ->where([
                ['orders.user_id', '=', $customerId],
                ['service_reviews.service_id', '=', $serviceId],
            ])
            ->first();
    }

    public function getAdminBookingRows(?string $searchText = null): Collection
    {
        $query = DB::table('orders as om')
            ->join('services as ser', 'ser.service_id', '=', 'om.service_id')
            ->join('service_catalogs as ser_cat', 'ser_cat.id', '=', 'ser.service_catalog_id')
            ->join('customers as usr', 'usr.id', '=', 'om.user_id')
            ->join('clients as client', 'client.id', '=', 'om.client_id');

        if ($searchText !== null && $searchText !== '') {
            $query->where(function ($inner) use ($searchText) {
                $inner->where('om.order_code', 'like', '%' . $searchText . '%')
                    ->orWhere('usr.user_code', 'like', '%' . $searchText . '%')
                    ->orWhere('client.client_code', 'like', '%' . $searchText . '%');
            });
        }

        return $query
            ->orderByRaw('pay_status = 0 OR om.service_status = 0 DESC')
            ->get();
    }
}
