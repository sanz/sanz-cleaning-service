<?php

namespace App\Services\Client;

use App\Repositories\ClientRepository;
use App\Repositories\ServiceRepository;

class ClientProfileService
{
    public function __construct(
        private readonly ClientRepository $clientRepository,
        private readonly ServiceRepository $serviceRepository
    ) {
    }

    public function getClientProfileData(int $clientId): array
    {
        $client = $this->clientRepository->getByIdAsArray($clientId);
        if (empty($client)) {
            return [];
        }

        return [
            'main_id' => encrypt($client['id']),
            'client_id' => $client['client_code'],
            'name' => $client['client_name'],
            'client_email' => $client['client_email'],
            'client_gender' => $client['client_gender'],
            'client_phone' => $client['client_mobile'],
            'client_img' => $client['client_photo_url'],
            'status' => $client['client_status'],
            'services' => $this->serviceRepository->countActiveByClientId($clientId),
        ];
    }

    public function updateProfileDetails(int $clientId, array $data): int
    {
        return $this->clientRepository->updateById($clientId, $data);
    }

    public function updatePassword(int $clientId, string $passwordHash): int
    {
        return $this->clientRepository->updatePassword($clientId, $passwordHash);
    }
}
