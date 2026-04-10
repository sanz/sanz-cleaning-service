<?php

namespace App\Services\Admin;

use App\Repositories\ServiceCatalogRepository;
use App\Repositories\ServicePriceRepository;

class AdminServiceCatalogManagementService
{
    public function __construct(
        private readonly ServiceCatalogRepository $serviceCatalogRepository,
        private readonly ServicePriceRepository $servicePriceRepository
    ) {
    }

    public function getAllCatalogs()
    {
        return $this->serviceCatalogRepository->getAll();
    }

    public function createCatalog(array $data): bool
    {
        $catalog = $this->serviceCatalogRepository->create([
            'service_name' => $data['service_name'],
            'service_category' => $data['service_category'],
            'service_description' => $data['service_description'] ?? null,
            'service_image' => $data['service_image'],
        ]);

        $this->servicePriceRepository->createForCatalog((int) $catalog->id);

        return true;
    }

    public function updateByAction(string $action, array $data)
    {
        if ($action === 'service') {
            $id = (int) $data['id'];
            unset($data['id'], $data['_token'], $data['action']);
            return $this->serviceCatalogRepository->updateById($id, $data);
        }

        if ($action === 'status') {
            $id = (int) $data['id'];
            $catalog = $this->serviceCatalogRepository->findById($id);
            $nextStatus = $catalog && !$catalog->service_status;
            $this->serviceCatalogRepository->setStatus($id, $nextStatus);
            return $nextStatus;
        }

        if ($action === 'status-enable') {
            $id = (int) $data['id'];
            $this->serviceCatalogRepository->setStatus($id, true);
            return true;
        }

        if ($action === 'status-disable') {
            $id = (int) $data['id'];
            $this->serviceCatalogRepository->setStatus($id, false);
            return true;
        }

        return null;
    }

    public function deleteCatalog(int $catalogId): bool
    {
        return $this->serviceCatalogRepository->deleteById($catalogId) > 0;
    }
}
