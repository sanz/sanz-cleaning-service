<?php

namespace App\Services\Customer;

use App\Repositories\OrderRepository;
use App\Repositories\ServiceItemRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Support\Carbon;

class CustomerConfirmOrderService
{
    public function __construct(
        private readonly ServiceRepository $serviceRepository,
        private readonly ServiceItemRepository $serviceItemRepository,
        private readonly OrderRepository $orderRepository
    ) {
    }

    public function getConfirmationData(int $serviceId, ?string $serviceCookie): array
    {
        $service = $this->serviceRepository->getServiceWithCatalog($serviceId);
        $itemIds = $this->parseCookieItemIds($serviceCookie);
        $items = $this->serviceItemRepository->getByIds($itemIds);

        return [
            'service' => $service,
            'items' => $items,
        ];
    }

    public function getInvoiceData(string $orderCode, int $customerId): ?array
    {
        $raw = $this->orderRepository->getInvoiceDataByOrderCode($orderCode, $customerId);
        if (!$raw) {
            return null;
        }

        $clientEmail = !empty($raw['service_email']) ? $raw['service_email'] : ($raw['client_email'] ?? '');
        $clientPhone = !empty($raw['service_phone']) ? $raw['service_phone'] : ($raw['client_mobile'] ?? '');
        $items = $this->buildItemsSummary($raw['user_ser_item'] ?? '');
        $serviceAddress = trim(
            (($raw['service_address'] ?? '') !== '' ? (string) $raw['service_address'] : '')
            . '<br/>'
            . (($raw['service_city'] ?? '') !== '' ? (string) $raw['service_city'] : '')
            . (($raw['service_city'] ?? '') !== '' || ($raw['service_state'] ?? '') !== '' ? ', ' : '')
            . (($raw['service_state'] ?? '') !== '' ? (string) $raw['service_state'] : '')
            . (($raw['service_pincode'] ?? '') !== '' ? (' - ' . (string) $raw['service_pincode']) : '')
        );

        return [
            'invoice_no' => $raw['order_code'] ?? '',
            'invoice_date' => !empty($raw['created_at']) ? Carbon::parse($raw['created_at'])->format('M d, Y') : Carbon::now()->format('M d, Y'),
            'user_id' => '# ' . ($raw['user_code'] ?? ''),
            'user_name' => $raw['user_name'] ?? '',
            'user_address' => $raw['order_address'] ?? '',
            'user_email' => $raw['user_email'] ?? '',
            'user_phone' => $raw['user_mobile'] ?? '',
            'service_name' => $raw['service_name'] ?? '',
            'service_address' => $serviceAddress,
            'client_id' => $raw['client_code'] ?? '',
            'client_email' => $clientEmail,
            'client_phone' => $clientPhone,
            'items' => $items['data'],
            'total_amount' => $items['total'],
        ];
    }

    private function parseCookieItemIds(?string $serviceCookie): array
    {
        $decoded = json_decode((string) $serviceCookie, true);
        if (!is_array($decoded)) {
            return [];
        }

        $ids = array_map('intval', $decoded);
        $ids = array_filter($ids, static fn ($id) => $id > 0);

        return array_values($ids);
    }

    private function buildItemsSummary(string $itemIds): array
    {
        $ids = array_filter(array_map('intval', explode(',', $itemIds)), static fn ($id) => $id > 0);

        $items = [];
        $total = 0;

        foreach ($ids as $id) {
            $item = $this->serviceItemRepository->getById($id);
            if (!$item) {
                continue;
            }

            $items[] = [
                'item_id' => (int) $item->item_id,
                'name' => $item->name,
                'item_price' => (int) $item->item_price,
            ];
            $total += (int) $item->item_price;
        }

        return [
            'data' => $items,
            'total' => $total,
        ];
    }
}
