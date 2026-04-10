<?php

namespace App\Services\Admin;

use App\Repositories\ServiceReviewRepository;

class AdminServiceReviewManagementService
{
    public function __construct(private readonly ServiceReviewRepository $serviceReviewRepository)
    {
    }

    public function getReviewRows(): array
    {
        $reviews = $this->serviceReviewRepository->getAdminReviews(200);
        $rows = [];
        $i = 0;

        foreach ($reviews as $review) {
            $rows[$i] = [
                'service-name' => $review->name,
                'clientId' => '#' . $review->client_code,
                'userId' => '#' . $review->user_code,
                'rating' => $review->rating,
                'feedback' => $review->feedback,
            ];
            $i++;
        }

        return $rows;
    }
}
