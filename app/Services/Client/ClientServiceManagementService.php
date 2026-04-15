<?php

namespace App\Services\Client;

use App\Repositories\ServiceCatalogRepository;
use App\Repositories\ServiceItemRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;

class ClientServiceManagementService
{
    public function __construct(
        private readonly ServiceRepository $serviceRepository,
        private readonly ServiceCatalogRepository $serviceCatalogRepository,
        private readonly ServiceItemRepository $serviceItemRepository
    ) {
    }

    public function getServiceCatalogOptions(): array
    {
        $catalogs = $this->serviceCatalogRepository->getActive();
        $options = [];

        foreach ($catalogs as $catalog) {
            $options[] = [
                'main_id' => (int) $catalog->id,
                'ser_name' => $catalog->service_name,
                'ser_cat' => $catalog->service_category,
            ];
        }

        return $options;
    }

    public function getClientServiceListing(int $clientId): array
    {
        return $this->getServiceData('all', $clientId);
    }

public function getServiceById(int $serviceId): ?array
    {
        $rows = $this->getServiceData('service', $serviceId);

        return $rows[0] ?? null;
    }

    public function createService(int $clientId, array $input)
    {
        $itemIds = $this->saveItemList($clientId, $input['items'] ?? []);
        $payload = $this->buildServicePayload($clientId, $input, $itemIds);

        return $this->serviceRepository->create($payload);
    }

    public function updateService(int $clientId, int $serviceId, array $input): int
    {
        $itemIds = $this->saveItemList($clientId, $input['items'] ?? []);
        $payload = $this->buildServicePayload($clientId, $input, $itemIds);

        return $this->serviceRepository->updateByServiceId($serviceId, $payload);
    }

    public function toggleStatus(int $serviceId, string $currentStatus): ?string
    {
        $nextStatus = null;
        if ($currentStatus === 'Active') {
            $nextStatus = 'Inactive';
        } elseif ($currentStatus === 'Inactive') {
            $nextStatus = 'Active';
        }

        if ($nextStatus === null) {
            return null;
        }

        $this->serviceRepository->updateByServiceId($serviceId, [
            'status' => $nextStatus,
        ]);

        return $nextStatus;
    }

    private function getServiceData(string $action, int $id): array
    {
        $services = $action === 'service'
            ? $this->serviceRepository->getByServiceId($id)
            : $this->serviceRepository->getByClientId($id);

        return $this->formatServiceRows($services);
    }

    private function formatServiceRows(Collection $rows): array
    {
        $data = [];

        foreach ($rows as $row) {
            $catalog = $this->serviceCatalogRepository->findById((int) $row->service_catalog_id);
            if (!$catalog) {
                continue;
            }

            $itemData = $this->getItemData((string) $row->item_ids);
            $data[] = [
                'main_id' => (int) $row->service_id,
                'name' => $row->name,
                'exp' => $row->experience,
                'service_id' => (int) $catalog->id,
                'service_name' => $catalog->service_name,
                'service_cat' => $catalog->service_category,
                'dec' => $row->description,
                'phone' => $row->phone,
                'email' => $row->email,
                'web' => $row->website,
                'fb' => $row->facebook,
                'tw' => $row->twitter,
                'linkedin' => $row->linkedin,
                'insta' => 'instagram.com',
                'img' => $row->photo,
                'doc_num' => $row->document_number,
                'doc_img' => $row->document_image,
                'state' => $row->state,
                'city' => $row->city,
                'address' => $row->address,
                'pin_code' => $row->pincode,
                'days' => $row->available_days,
                'days_time' => $row->available_time,
                'item' => $itemData,
                'status' => $row->status,
                'status_id' => $row->status,
            ];
        }

        return $data;
    }

    private function getItemData(string $itemIds): array
    {
        $itemIdList = array_filter(array_map('intval', explode(',', $itemIds)), static fn ($id) => $id > 0);
        $items = [];

        foreach ($itemIdList as $itemId) {
            $item = $this->serviceItemRepository->getById($itemId);
            if (!$item) {
                continue;
            }

            $items[] = [
                'iID' => (int) $item->item_id,
                'iName' => $item->name,
                'iDes' => $item->description,
                'iPrice' => $item->item_price,
            ];
        }

        return $items;
    }

    private function saveItemList(int $clientId, array $items): string
    {
        $savedIds = [];

        foreach ($items as $item) {
            $name = trim((string) ($item['pli_name'] ?? ''));
            $description = trim((string) ($item['pli_desc'] ?? ''));
            $price = trim((string) ($item['pli_price'] ?? ''));

            if ($name === '' && $description === '' && $price === '') {
                continue;
            }

            $payload = [
                'client_id' => $clientId,
                'name' => $name,
                'description' => $description,
                'item_price' => (int) $price,
            ];

            if (isset($item['item_id'])) {
                $itemId = (int) $item['item_id'];
                $this->serviceItemRepository->updateById($itemId, $payload);
            } else {
                $itemId = $this->serviceItemRepository->insertAndGetId($payload);
            }

            $savedIds[] = $itemId;
        }

        if (empty($savedIds)) {
            return '';
        }

        return implode(', ', $savedIds) . ', ';
    }

    private function buildServicePayload(int $clientId, array $input, string $itemIds): array
    {
        return [
            'client_id' => $clientId,
            'service_catalog_id' => (int) ($input['service_id'] ?? 0),
            'name' => trim((string) ($input['provider_name'] ?? '')),
            'experience' => trim((string) ($input['ser_exp'] ?? '')),
            'description' => trim((string) ($input['dec_msg'] ?? '')),
            'phone' => trim((string) ($input['ser_phone'] ?? '')),
            'email' => trim((string) ($input['ser_email'] ?? '')),
            'website' => trim((string) ($input['ser_website'] ?? '')),
            'facebook' => trim((string) ($input['ser_fblink'] ?? '')),
            'twitter' => trim((string) ($input['ser_twlink'] ?? '')),
            'linkedin' => trim((string) ($input['ser_ldlink'] ?? '')),
            'photo' => $input['ser_img'] ?? null,
            'document_number' => trim((string) ($input['ser_doc_no'] ?? '')),
            'document_image' => $input['doc_img'] ?? null,
            'state' => $this->safeDecrypt((string) ($input['ser_state'] ?? '')),
            'city' => $this->safeDecrypt((string) ($input['ser_city'] ?? '')),
            'address' => trim((string) ($input['ser_address'] ?? '')),
            'pincode' => trim((string) ($input['ser_pin_no'] ?? '')),
            'available_days' => $input['days'] ?? null,
            'available_time' => $input['time'] ?? null,
            'item_ids' => $itemIds,
        ];
    }

    private function safeDecrypt(string $value): string
    {
        $value = trim($value);
        if ($value === '') {
            return '';
        }

        try {
            return Crypt::decryptString($value);
        } catch (DecryptException) {
            return $value;
        }
    }
}
