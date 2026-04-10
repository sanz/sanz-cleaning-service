<?php

namespace App\Services\Admin;

use App\Repositories\ServiceCatalogRepository;
use App\Repositories\ServiceItemRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class AdminServiceManagementService
{
    public function __construct(
        private readonly ServiceRepository $serviceRepository,
        private readonly ServiceCatalogRepository $serviceCatalogRepository,
        private readonly ServiceItemRepository $serviceItemRepository
    ) {
    }

    public function getServiceRows(): array
    {
        $rows = $this->serviceRepository->getAdminServiceRows();
        $data = [];
        $i = 1;

        foreach ($rows as $row) {
            $id = encrypt($row->service_id);
            $data[] = [
                '#' => $i++,
                'main_id' => $id,
                'shop-name' => ['name' => $row->name, 'img' => $this->toPublicUrl($row->photo)],
                'service-name' => $row->service_name,
                'category' => $row->service_category,
                'client-id' => '#' . $row->client_code,
                'client-name' => $row->client_name,
                'location' => $row->city . ' - ' . $row->state,
                'experience' => $row->experience,
                'avalibility' => $row->available_days,
                'mobileNo' => $row->client_mobile,
                'email' => $row->client_email,
                'IDProof' => ['name' => 'Document', 'url' => $this->toPublicUrl($row->document_image)],
                'client-status' => ['val' => $row->status, 'id' => $id],
                'approval' => ['val' => $row->status, 'id' => $id],
                'transactions' => ['id' => $id],
            ];
        }

        return $data;
    }

    public function updateStatus(string $encryptedServiceId, string $dataAction): string
    {
        $status = $this->mapStatus($dataAction);
        $serviceId = (int) decrypt($encryptedServiceId);

        $this->serviceRepository->updateByServiceId($serviceId, [
            'status' => $status,
        ]);

        return $this->countPendingServices();
    }

    public function getServiceDetail(string $encryptedServiceId): ?array
    {
        $serviceId = (int) decrypt($encryptedServiceId);
        $rows = $this->getServiceData('service', $serviceId);

        return $rows[0] ?? null;
    }

    private function getServiceData(string $action, int $id): array
    {
        $rows = $action === 'service'
            ? $this->serviceRepository->getByServiceId($id)
            : $this->serviceRepository->getByClientId($id);

        return $this->formatRows($rows);
    }

    private function formatRows(Collection $rows): array
    {
        $data = [];

        foreach ($rows as $row) {
            $catalog = $this->serviceCatalogRepository->findById((int) $row->service_catalog_id);
            if (!$catalog) {
                continue;
            }

            $itemData = $this->getItemData((string) $row->item_ids);
            $id = encrypt($row->service_id);

            $data[] = [
                'main_id' => $id,
                'name' => $row->name,
                'exp' => $row->experience,
                'service_id' => encrypt($catalog->id),
                'service_name' => $catalog->service_name,
                'service_cat' => $catalog->service_category,
                'dec' => $row->description,
                'phone' => $row->phone,
                'email' => $row->email,
                'web' => $row->website,
                'fb' => $row->facebook,
                'tw' => $row->twitter,
                'linkedin' => $row->linkedin,
                'img' => $this->toPublicUrl($row->photo),
                'doc_num' => $row->document_number,
                'doc_img' => $this->toPublicUrl($row->document_image),
                'state' => $row->state,
                'city' => $row->city,
                'address' => $row->address,
                'pin_code' => $row->pincode,
                'days' => $row->available_days,
                'days_time' => $row->available_time,
                'item' => $itemData,
                'status' => $row->status,
            ];
        }

        return $data;
    }

    private function getItemData(string $itemText): array
    {
        $ids = array_filter(array_map('intval', explode(',', $itemText)), static fn ($id) => $id > 0);
        $data = [];

        foreach ($ids as $id) {
            $item = $this->serviceItemRepository->getById($id);
            if (!$item) {
                continue;
            }

            $data[] = [
                'iID' => encrypt($item->item_id),
                'iName' => $item->name,
                'iDes' => $item->description,
                'iPrice' => $item->item_price,
            ];
        }

        return $data;
    }

    private function mapStatus(string $action): string
    {
        return match ($action) {
            'Approve' => 'Active',
            'Active' => 'Blocked',
            'Blocked' => 'Active',
            'Inactive' => 'Blocked',
            default => 'Rejected',
        };
    }

    private function countPendingServices(): string
    {
        $count = $this->serviceRepository->countPending();

        return $count > 0 ? (string) $count : '';
    }

    private function toPublicUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://', '//'])) {
            return $path;
        }

        return asset(ltrim($path, '/'));
    }
}
