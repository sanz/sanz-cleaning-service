<?php

namespace App\Services\Customer;

use App\Repositories\OrderRepository;

class CustomerOrderService
{
    public function __construct(private readonly OrderRepository $orderRepository)
    {
    }

    public function getOrders(int $customerId)
    {
        return $this->orderRepository->getCustomerOrdersWithReview($customerId);
    }

    public function markOrderComplete(int $orderId): bool
    {
        $updated = $this->orderRepository->updateByOrderId($orderId, [
            'service_status' => 'complete',
            'pay_status' => true,
        ]);

        return $updated > 0;
    }
}
