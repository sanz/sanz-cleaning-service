<?php

namespace App\Repositories;

use App\Models\ServiceReview;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ServiceReviewRepository
{
    public function countAll(): int
    {
        return ServiceReview::count();
    }

    public function countRecentByClient(int $clientId, int $days): int
    {
        return DB::table('services')
            ->join('service_reviews', 'service_reviews.service_id', '=', 'services.service_id')
            ->where('client_id', $clientId)
            ->whereDate('service_reviews.created_at', '>=', now()->subDays($days))
            ->count();
    }

    public function getByClientPaginated(int $clientId, int $perPage)
    {
        return DB::table('service_reviews')
            ->join('customers as tum', 'service_reviews.user_id', '=', 'tum.id')
            ->rightJoin('services', 'service_reviews.service_id', '=', 'services.service_id')
            ->join('service_catalogs', 'services.service_catalog_id', '=', 'service_catalogs.id')
            ->where([
                ['client_id', '=', $clientId],
                ['ro_id', '!=', 'null'],
            ])
            ->paginate($perPage);
    }

    public function getAdminReviews(int $limit): Collection
    {
        return DB::table('service_reviews')
            ->join('services', 'services.service_id', '=', 'service_reviews.service_id')
            ->join('clients', 'clients.id', '=', 'services.client_id')
            ->join('customers', 'customers.id', '=', 'service_reviews.user_id')
            ->select('name', DB::raw('(response_rating+service_rating+communication_rating+price_rating)/4 as rating'), 'client_code', 'user_code', 'feedback')
            ->take($limit)
            ->get();
    }

    public function getByServiceWithCustomer(int $serviceId): Collection
    {
        return DB::table('service_reviews')
            ->where('service_id', $serviceId)
            ->join('customers', 'service_reviews.user_id', '=', 'customers.id')
            ->get();
    }

    public function getAverageByService(int $serviceId): ?object
    {
        return DB::table('service_reviews')
            ->where('service_id', $serviceId)
            ->select(
                DB::raw('AVG(response_rating) as response_rating'),
                DB::raw('AVG(service_rating) as service_rating'),
                DB::raw('AVG(communication_rating) as communication_rating'),
                DB::raw('AVG(price_rating) as price_rating')
            )
            ->first();
    }

    public function getCustomerServiceReview(int $serviceId, int $customerId): ?object
    {
        return DB::table('orders')
            ->join('service_reviews', 'service_reviews.user_id', '=', 'orders.user_id')
            ->where([
                ['service_reviews.service_id', '=', $serviceId],
                ['orders.user_id', '=', $customerId],
            ])
            ->first();
    }

    public function create(array $data): ServiceReview
    {
        return ServiceReview::create($data);
    }

    public function updateByServiceAndUser(int $serviceId, int $userId, array $data): int
    {
        return ServiceReview::where([
            ['service_id', '=', $serviceId],
            ['user_id', '=', $userId],
        ])->update($data);
    }
}
