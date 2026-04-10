<?php

namespace App\Services\Customer;

use App\Repositories\ServiceItemRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\ServiceReviewRepository;

class CustomerClientDetailService
{
    public function __construct(
        private readonly ServiceRepository $serviceRepository,
        private readonly ServiceItemRepository $serviceItemRepository,
        private readonly ServiceReviewRepository $serviceReviewRepository
    ) {
    }

    public function getDetailData(int $serviceId, ?int $customerId): array
    {
        $service = $this->serviceRepository->getServiceWithCatalogAndClient($serviceId);
        if (!$service) {
            return [];
        }

        $itemIds = $this->parseItemIds($service->item_ids ?? '');
        $items = $this->serviceItemRepository->getByIds($itemIds);
        $reviews = $this->serviceReviewRepository->getByServiceWithCustomer($serviceId);
        $avg = $this->serviceReviewRepository->getAverageByService($serviceId);

        $userReview = '';
        if ($customerId) {
            $userReview = $this->serviceReviewRepository->getCustomerServiceReview($serviceId, $customerId);
        }

        return [
            'service' => $service,
            'items' => $items,
            'reviews' => $reviews,
            'avg' => $avg,
            'usrReview' => $userReview,
        ];
    }

    private function parseItemIds(string $itemIds): array
    {
        $ids = array_map('intval', explode(',', $itemIds));
        $ids = array_filter($ids, static fn ($id) => $id > 0);

        return array_values($ids);
    }
}
