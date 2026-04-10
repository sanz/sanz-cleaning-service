<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ServiceRepository
{
    public function countAll(): int
    {
        return Service::count();
    }

    public function countPending(): int
    {
        return Service::where('status', 'Pending')->count();
    }

    public function countByClientId(int $clientId): int
    {
        return Service::where('client_id', $clientId)->count();
    }

    public function countActiveByClientId(int $clientId): int
    {
        return Service::where('client_id', $clientId)
            ->where('status', '1')
            ->count();
    }

    public function create(array $data): Service
    {
        return Service::create($data);
    }

    public function updateByServiceId(int $serviceId, array $data): int
    {
        return Service::where('service_id', $serviceId)->update($data);
    }

    public function findByServiceId(int $serviceId): ?Service
    {
        return Service::where('service_id', $serviceId)->first();
    }

    public function getByClientId(int $clientId): Collection
    {
        return Service::where('client_id', $clientId)->get();
    }

    public function getByServiceId(int $serviceId): Collection
    {
        return Service::where('service_id', $serviceId)->get();
    }

    public function getServiceWithCatalog(int $serviceId): ?object
    {
        return DB::table('services')
            ->where('service_id', $serviceId)
            ->join('service_catalogs as tsc', 'services.service_catalog_id', '=', 'tsc.id')
            ->first();
    }

    public function getServiceWithCatalogAndClient(int $serviceId): ?object
    {
        return DB::table('services')
            ->where('service_id', $serviceId)
            ->join('service_catalogs as tsc', 'services.service_catalog_id', '=', 'tsc.id')
            ->join('clients as tcm', 'services.client_id', '=', 'tcm.id')
            ->first();
    }

    public function getClientIdByServiceId(int $serviceId): ?int
    {
        $row = DB::table('services')
            ->select('client_id')
            ->where('service_id', $serviceId)
            ->first();

        return $row ? (int) $row->client_id : null;
    }

    public function getHomeActiveServicesWithRating(int $limit): Collection
    {
        return DB::table('services')
            ->join('service_catalogs', 'services.service_catalog_id', '=', 'service_catalogs.id')
            ->leftJoin('service_reviews', 'services.service_id', '=', 'service_reviews.service_id')
            ->select(
                DB::raw('COUNT(ro_id) as revCount, services.*, service_catalogs.*'),
                DB::raw('AVG(response_rating) as response_rating, AVG(service_rating) as service_rating, AVG(communication_rating) as communication_rating, AVG(price_rating) as price_rating')
            )
            ->where('status', 'Active')
            ->inRandomOrder()
            ->limit($limit)
            ->groupBy('services.service_id')
            ->get();
    }

    public function getActiveServicesWithRatingPaginated(int $perPage)
    {
        return DB::table('services')
            ->join('service_catalogs', 'services.service_catalog_id', '=', 'service_catalogs.id')
            ->leftJoin('service_reviews', 'services.service_id', '=', 'service_reviews.service_id')
            ->select(
                DB::raw('COUNT(ro_id) as revCount, services.*, service_catalogs.service_name'),
                DB::raw('AVG(response_rating) as response_rating, AVG(service_rating) as service_rating, AVG(communication_rating) as communication_rating, AVG(price_rating) as price_rating')
            )
            ->where('status', 'Active')
            ->groupBy('services.service_id')
            ->paginate($perPage);
    }

    public function getActiveServicesByCatalogWithRatingPaginated(int $catalogId, int $perPage)
    {
        return DB::table('services')
            ->where('service_catalog_id', $catalogId)
            ->join('service_catalogs', 'services.service_catalog_id', '=', 'service_catalogs.id')
            ->leftJoin('service_reviews', 'services.service_id', '=', 'service_reviews.service_id')
            ->select(
                DB::raw('COUNT(ro_id) as revCount, services.*, service_catalogs.service_name'),
                DB::raw('AVG(response_rating) as response_rating, AVG(service_rating) as service_rating, AVG(communication_rating) as communication_rating, AVG(price_rating) as price_rating')
            )
            ->where('status', 'Active')
            ->groupBy('services.service_id')
            ->paginate($perPage);
    }

    public function getAdminServiceRows(): Collection
    {
        return Service::query()
            ->join('service_catalogs', 'service_catalogs.id', '=', 'services.service_catalog_id')
            ->join('clients', 'clients.id', '=', 'services.client_id')
            ->orderBy('status', 'DESC')
            ->get();
    }
}
