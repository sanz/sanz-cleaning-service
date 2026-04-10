<?php

namespace App\Services\Client;

use App\Repositories\ServiceReviewRepository;

class ClientReviewService
{
    public function __construct(private readonly ServiceReviewRepository $serviceReviewRepository)
    {
    }

    public function getClientReviews(int $clientId)
    {
        return $this->serviceReviewRepository->getByClientPaginated($clientId, 10);
    }
}
