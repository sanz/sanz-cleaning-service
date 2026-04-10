<?php

namespace App\Services\Client;

use App\Repositories\ServiceCatalogRepository;
use App\Repositories\ServiceRepository;

class ClientHomeService
{
    public function __construct(
        private readonly ServiceRepository $serviceRepository,
        private readonly ServiceCatalogRepository $serviceCatalogRepository
    ) {
    }

    public function getHomePageData(): array
    {
        return [
            'services' => $this->serviceRepository->getHomeActiveServicesWithRating(6),
            'catalogs' => $this->serviceCatalogRepository->getTopActiveWithServiceCount(6),
        ];
    }
}
