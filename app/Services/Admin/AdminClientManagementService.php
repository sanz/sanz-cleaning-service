<?php

namespace App\Services\Admin;

use App\Repositories\ClientRepository;
use Illuminate\Support\Str;

class AdminClientManagementService
{
    public function __construct(private readonly ClientRepository $clientRepository)
    {
    }

    public function getPendingCount(): int
    {
        return $this->clientRepository->countPending();
    }

    public function getClientRows(): array
    {
        $rows = $this->clientRepository->getAllForAdminList();
        $data = [];
        $i = 0;

        foreach ($rows as $row) {
            $id = encrypt($row->id);
            $data[$i] = [
                '#' => $i + 1,
                'client-id' => '#' . $row->client_code,
                'client-name' => $row->client_name,
                'avatar' => $this->toPublicUrl($row->client_photo_url),
                'mobileNo' => $row->client_mobile,
                'email' => $row->client_email,
                'client-status' => ['val' => $row->client_status, 'id' => $id],
                'approval' => ['val' => $row->client_status, 'id' => $id],
                'transactions' => ['id' => $id],
            ];
            $i++;
        }

        return $data;
    }

    public function updateClientStatus(string $encryptedId, string $status): void
    {
        $id = decrypt($encryptedId);
        $mappedStatus = $this->mapStatus($status);
        $this->clientRepository->updateStatus((int) $id, $mappedStatus);
    }

    public function getClientServices(string $encryptedId)
    {
        $id = (int) decrypt($encryptedId);

        return $this->clientRepository->getClientWithServices($id)->map(function ($row) {
            $row->client_photo_url = $this->toPublicUrl($row->client_photo_url ?? null);
            $row->photo = $this->toPublicUrl($row->photo ?? null);
            $row->document_image = $this->toPublicUrl($row->document_image ?? null);
            $row->service_image_url = !empty($row->service_image)
                ? asset('storage/' . ltrim((string) $row->service_image, '/'))
                : null;

            return $row;
        });
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

    private function mapStatus(string $status): string
    {
        return match ($status) {
            'Approve' => 'Active',
            'Rejected' => 'Rejected',
            'Active' => 'Active',
            default => 'Blocked',
        };
    }
}
