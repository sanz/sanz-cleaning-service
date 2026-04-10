<?php

namespace App\Services\Client;

use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ServiceItemRepository;
use App\Repositories\ServiceRepository;

class ClientOrderManagementService
{
    public function __construct(
        private readonly OrderRepository $orderRepository,
        private readonly ServiceRepository $serviceRepository,
        private readonly ServiceItemRepository $serviceItemRepository,
        private readonly CustomerRepository $customerRepository
    ) {
    }

    public function createOrder(int $serviceId, int $customerId, array $payload, array $cookies): array
    {
        $address = $payload['address1'] . ', ' . $payload['address2'] . ', ' . $payload['city'] . ', ' . $payload['state'] . ' - ' . $payload['pincode'];

        $date = date_create_from_format('d-m-Y', (string) ($cookies['date'] ?? ''));
        $selectedTime = (string) ($cookies['selected_time'] ?? '');

        $itemIds = $this->parseItemCookie($cookies['services'] ?? null);
        $itemsText = implode(', ', $itemIds);
        $amount = $this->calculateAmount($itemIds);
        $clientId = $this->serviceRepository->getClientIdByServiceId($serviceId);

        $orderData = [
            'order_code' => $this->generateOrderCode(),
            'client_id' => $clientId,
            'user_id' => $customerId,
            'service_id' => $serviceId,
            'item_ids' => $itemsText,
            'booking_date' => $date,
            'address' => $address,
            'time_slot' => $selectedTime,
            'amount' => $amount,
        ];

        $this->customerRepository->updateById($customerId, [
            'address_1' => $payload['address1'],
            'address_2' => $payload['address2'],
            'user_city' => $payload['city'],
            'user_state' => $payload['state'],
            'user_pincode' => $payload['pincode'],
        ]);

        $order = $this->orderRepository->create($orderData);

        return [
            'order' => $order,
            'mail_data' => [
                'order_code' => $orderData['order_code'],
                'client_id' => $orderData['client_id'],
                'user_id' => $orderData['user_id'],
                'service_id' => $orderData['service_id'],
                'item_ids' => $orderData['item_ids'],
                'booking_date' => $orderData['booking_date'],
                'address' => $orderData['address'],
                'time_slot' => $orderData['time_slot'],
                'amount' => $orderData['amount'],
            ],
        ];
    }

    public function getOrderList(int $clientId): array
    {
        $orders = $this->orderRepository->getByClientId($clientId);
        $rows = [];

        foreach ($orders as $order) {
            $service = $this->serviceRepository->findByServiceId((int) $order->service_id);
            if (!$service) {
                continue;
            }

            $rows[] = [
                'main_id' => (int) $order->order_id,
                'order_id' => $order->order_code,
                'service_name' => $service->name,
                'service_img' => $service->photo,
                'booking_date' => $order->booking_date,
                'booking_time' => $order->time_slot,
                'amount' => $order->amount,
                'city' => $service->city . ' - ' . $service->state,
                'address' => $order->address,
                'payment_status' => $order->pay_status,
                'service_status' => $order->service_status,
            ];
        }

        return $rows;
    }

    public function getOrderDetail(int $orderId): array
    {
        $rows = $this->orderRepository->getOrderWithRelationsById($orderId);
        if ($rows->isEmpty()) {
            return [];
        }

        $data = $rows->first();

        return [
            'provider_name' => $data->name,
            'service_status' => $data->service_status,
            'order_id' => $data->order_code,
            'service_name' => 'Service Name',
            'service_cat' => 'Service Cat.',
            'booking_date' => $data->booking_date,
            'booking_time' => $data->time_slot,
            'city' => $data->city . ' - ' . $data->state,
            'address' => $data->address,
            'user_id' => $data->user_code,
            'user_name' => $data->user_name,
            'user_email' => $data->user_email,
            'user_phone' => $data->user_mobile,
            'client_id' => $data->client_code,
            'client_name' => $data->client_name,
            'client_email' => $data->client_email,
            'payment_status' => $data->pay_status,
            'items' => $this->getItems((string) $data->item_ids),
            'oAmount' => $data->amount,
        ];
    }

    private function getItems(string $itemText): array
    {
        $ids = array_filter(array_map('intval', explode(',', $itemText)), static fn ($id) => $id > 0);
        $items = [];

        foreach ($ids as $id) {
            $item = $this->serviceItemRepository->getById($id);
            if (!$item) {
                continue;
            }

            $items[] = [
                'item_id' => (int) $item->item_id,
                'name' => $item->name,
                'item_price' => $item->item_price,
            ];
        }

        return $items;
    }

    private function calculateAmount(array $itemIds): int
    {
        $amount = 0;
        $items = $this->serviceItemRepository->getByIds($itemIds);

        foreach ($items as $item) {
            $amount += (int) $item->item_price;
        }

        return $amount;
    }

    private function parseItemCookie(?string $cookie): array
    {
        $decoded = json_decode((string) $cookie, true);
        if (!is_array($decoded)) {
            return [];
        }

        $ids = array_map('intval', $decoded);
        $ids = array_filter($ids, static fn ($id) => $id > 0);

        return array_values($ids);
    }

    private function generateOrderCode(): string
    {
        do {
            $id = date('ymd') . rand(1000, 9999);
        } while ($this->orderRepository->countByColumnValue('order_code', $id) > 0);

        return $id;
    }
}
