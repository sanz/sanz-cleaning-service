<?php

namespace App\Services\Admin;

use App\Repositories\ClientRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ServiceReviewRepository;

class AdminDashboardService
{
    public function __construct(
        private readonly ClientRepository $clientRepository,
        private readonly CustomerRepository $customerRepository,
        private readonly OrderRepository $orderRepository,
        private readonly ServiceReviewRepository $serviceReviewRepository
    ) {
    }

    public function getAnalytics(): array
    {
        return [
            'countClient' => $this->clientRepository->countAll(),
            'countUser' => $this->customerRepository->countAll(),
            'countOrder' => $this->orderRepository->countAll(),
            'countReview' => $this->serviceReviewRepository->countAll(),
        ];
    }

    public function getOrderDetails(): array
    {
        $countOrder = $this->orderRepository->countAll();
        $countPendingOrder = $this->orderRepository->countPendingServiceStatus();
        $countCompleteOrder = $countOrder - $countPendingOrder;

        $completePercent = $countOrder > 0 ? ($countCompleteOrder / $countOrder) * 100 : 0;
        $pendingPercent = $countOrder > 0 ? ($countPendingOrder / $countOrder) * 100 : 0;

        return [
            $countOrder,
            $countCompleteOrder,
            $countPendingOrder,
            $completePercent,
            $pendingPercent,
        ];
    }
}
