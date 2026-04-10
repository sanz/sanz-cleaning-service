<?php

namespace App\Services\Customer;

use App\Repositories\OrderRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\ServiceReviewRepository;

class CustomerReviewService
{
    public function __construct(
        private readonly OrderRepository $orderRepository,
        private readonly ServiceRepository $serviceRepository,
        private readonly ServiceReviewRepository $serviceReviewRepository
    ) {
    }

    public function getReviewPageData(int $serviceId, int $customerId): array
    {
        return [
            'checkOrder' => $this->orderRepository->hasCustomerBookedService($serviceId, $customerId),
            'checkReview' => $this->orderRepository->getCustomerServiceReview($serviceId, $customerId),
            'service' => $this->serviceRepository->findByServiceId($serviceId),
            'serviceId' => $serviceId,
        ];
    }

    public function submitReview(int $serviceId, int $customerId, array $data)
    {
        $payload = $this->buildReviewPayload($serviceId, $customerId, $data);

        return $this->serviceReviewRepository->create($payload);
    }

    public function updateReview(int $serviceId, int $customerId, array $data): int
    {
        $payload = $this->buildReviewPayload($serviceId, $customerId, $data);

        return $this->serviceReviewRepository->updateByServiceAndUser($serviceId, $customerId, $payload);
    }

    private function buildReviewPayload(int $serviceId, int $customerId, array $data): array
    {
        $payload = [
            'service_id' => $serviceId,
            'user_id' => $customerId,
            'response_rating' => $data['resp_revw'],
            'service_rating' => $data['serv_revw'],
            'communication_rating' => $data['comm_revw'],
            'price_rating' => $data['price_revw'],
            'title' => $data['revw_title'],
            'feedback' => $data['revw_text'],
        ];

        if (!empty($data['image'])) {
            $payload['image'] = $data['image'];
        }

        return $payload;
    }
}
