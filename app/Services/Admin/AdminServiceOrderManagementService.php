<?php

namespace App\Services\Admin;

use App\Repositories\OrderRepository;
use Illuminate\Support\Str;

class AdminServiceOrderManagementService
{
    public function __construct(private readonly OrderRepository $orderRepository)
    {
    }

    public function getOrderRows(?string $action = null, ?string $searchText = null): array
    {
        $rows = $action === 'search'
            ? $this->orderRepository->getAdminBookingRows($searchText)
            : $this->orderRepository->getAdminBookingRows();

        $data = [];
        $i = 0;

        foreach ($rows as $row) {
            if ($i > 199 && (int) $row->pay_status === 1 && (int) $row->service_status === 1) {
                break;
            }

            $payStatus = (int) $row->pay_status === 0 ? 'Pending' : 'Completed';
            $serviceStatus = (int) $row->service_status === 0 ? 'Pending' : 'Completed';

            $data[$i] = [
                '#' => $i + 1,
                'order-id' => $row->order_code,
                'service-name' => $row->service_name,
                'service-provider' => ['clientName' => $row->client_name, 'clientImg' => $this->toPublicUrl($row->client_photo_url)],
                'user-name' => ['userName' => $row->user_name, 'userImg' => $this->toPublicUrl($row->user_img_url)],
                'service-address' => $row->address,
                'service-timeslot' => $row->booking_date . ' ' . $row->time_slot,
                'service-amount' => $row->amount,
                'payment-status' => $payStatus,
                'service-status' => $serviceStatus,
            ];
            $i++;
        }

        return $data;
    }

    private function toPublicUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://', '//'])) {
            return $path;
        }

        return asset(ltrim($path, '/'));
    }
}
