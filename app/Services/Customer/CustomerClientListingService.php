<?php

namespace App\Services\Customer;

use App\Repositories\ServiceCatalogRepository;
use App\Repositories\ServiceRepository;

class CustomerClientListingService
{
    public function __construct(
        private readonly ServiceRepository $serviceRepository,
        private readonly ServiceCatalogRepository $serviceCatalogRepository
    ) {
    }

    public function getIndexData(): array
    {
        return [
            'services' => $this->serviceRepository->getActiveServicesWithRatingPaginated(6),
            'catalogs' => $this->serviceCatalogRepository->getAll(),
            'selectId' => '',
        ];
    }

    public function getFilteredData(int $catalogId): array
    {
        return [
            'services' => $this->serviceRepository->getActiveServicesByCatalogWithRatingPaginated($catalogId, 6),
            'catalogs' => $this->serviceCatalogRepository->getAll(),
            'selectId' => $catalogId,
        ];
    }
}
