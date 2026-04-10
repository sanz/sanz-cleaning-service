<?php

namespace App\Services\Client;

use App\Repositories\OrderRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\ServiceReviewRepository;

class ClientDashboardService
{
    public function __construct(
        private readonly ServiceRepository $serviceRepository,
        private readonly OrderRepository $orderRepository,
        private readonly ServiceReviewRepository $serviceReviewRepository
    ) {
    }

    public function getDashboardCounts(int $clientId): array
    {
        return [
            'countService' => $this->serviceRepository->countByClientId($clientId),
            'countOrder' => $this->orderRepository->countByClientId($clientId),
            'countReview' => $this->serviceReviewRepository->countRecentByClient($clientId, 5),
        ];
    }
}
