<?php

namespace App\Repositories;

use App\Models\ServiceCatalog;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ServiceCatalogRepository
{
    public function getAll(): Collection
    {
        return ServiceCatalog::all();
    }

    public function getActive(): Collection
    {
        return ServiceCatalog::where('service_status', 1)->get();
    }

    public function findById(int $id): ?ServiceCatalog
    {
        return ServiceCatalog::find($id);
    }

    public function create(array $data): ServiceCatalog
    {
        return ServiceCatalog::create($data);
    }

    public function updateById(int $id, array $data): int
    {
        return ServiceCatalog::where('id', $id)->update($data);
    }

    public function setStatus(int $id, bool $status): int
    {
        return ServiceCatalog::where('id', $id)->update([
            'service_status' => $status,
        ]);
    }

    public function deleteById(int $id): int
    {
        return ServiceCatalog::where('id', $id)->delete();
    }

    public function getTopActiveWithServiceCount(int $limit): Collection
    {
        return DB::table('service_catalogs')
            ->leftJoin('services', 'services.service_catalog_id', '=', 'service_catalogs.id')
            ->select(DB::raw('COUNT(services.service_id) as serCount, service_catalogs.*'))
            ->where('status', '=', 'Active')
            ->orderBy('serCount', 'DESC')
            ->limit($limit)
            ->groupBy('service_catalogs.id')
            ->get();
    }
}
