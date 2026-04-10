<?php

namespace App\Services\Admin;

use App\Repositories\ServicePriceRepository;

class AdminServicePriceManagementService
{
    public function __construct(private readonly ServicePriceRepository $servicePriceRepository)
    {
    }

    public function getPriceRows(): array
    {
        $rows = $this->servicePriceRepository->getActiveWithCatalog();
        $data = [];
        $i = 0;

        foreach ($rows as $row) {
            $id = encrypt($row->pr_id);
            $data[$i] = [
                '#' => $i + 1,
                'main_id' => $id,
                'service-name' => $row->service_name,
                'visit-charge-brokrage' => $row->visit_charge,
                'service-charge-brokrage' => $row->service_charge,
                'status' => ['text' => $row->pr_status == 1 ? 'Enable' : 'Disable', 'id' => $id],
            ];
            $i++;
        }

        return $data;
    }

    public function getPriceDetail(string $encryptedId): array
    {
        $id = (int) decrypt($encryptedId);
        $row = $this->servicePriceRepository->getByIdWithCatalog($id)->first();

        if (!$row) {
            return [];
        }

        return [
            'main_id' => encrypt($row->pr_id),
            'service_name' => $row->service_name,
            'visit_charge' => $row->visit_charge,
            'service_charge' => $row->service_charge,
        ];
    }

    public function updateByAction(string $action, string $encryptedId, array $data): void
    {
        $id = (int) decrypt($encryptedId);

        if ($action === 'delete') {
            $this->servicePriceRepository->softDeleteById($id);
            return;
        }

        if ($action === 'update') {
            $this->servicePriceRepository->updateById($id, [
                'visit_charge' => $data['npr_visitbrokrage'],
                'service_charge' => $data['npr_servicebrokrage'],
            ]);
            return;
        }

        if ($action === 'status') {
            $status = ($data['hasClass'] ?? '') === 'true' ? false : true;
            $this->servicePriceRepository->toggleStatus($id, $status);
        }
    }
}
