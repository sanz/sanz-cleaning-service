<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ClientRepository
{
    public function countPending(): int
    {
        return Client::where('client_status', 'Pending')->count();
    }

    public function countAll(): int
    {
        return Client::count();
    }

    public function getAllForAdminList(): array
    {
        return DB::table('clients')
            ->orderByRaw('(client_status = "Pending") DESC')
            ->orderByDesc('created_at')
            ->get()
            ->all();
    }

    public function updateStatus(int $id, string $status): int
    {
        return Client::where('id', $id)->update([
            'client_status' => $status,
        ]);
    }

    public function findById(int $id): ?Client
    {
        return Client::find($id);
    }

    public function getClientWithServices(int $clientId): Collection
    {
        return DB::table('services')
            ->join('service_catalogs', 'service_catalogs.id', '=', 'services.service_catalog_id')
            ->rightJoin('clients', 'services.client_id', '=', 'clients.id')
            ->where('clients.id', $clientId)
            ->get();
    }

    public function countByColumnValue(string $column, string $value): int
    {
        return Client::where($column, $value)->count();
    }

    public function create(array $data): Client
    {
        return Client::create($data);
    }

    public function updateById(int $id, array $data): int
    {
        return Client::where('id', $id)->update($data);
    }

    public function getByIdAsArray(int $id): array
    {
        $record = Client::where('id', $id)->first();

        return $record ? $record->toArray() : [];
    }

    public function updatePassword(int $id, string $passwordHash): int
    {
        return Client::where('id', $id)->update([
            'password' => $passwordHash,
        ]);
    }
}
