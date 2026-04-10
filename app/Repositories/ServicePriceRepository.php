<?php

namespace App\Repositories;

use App\Models\ServicePrice;
use Illuminate\Support\Collection;

class ServicePriceRepository
{
    public function createForCatalog(int $catalogId): ServicePrice
    {
        $servicePrice = new ServicePrice();
        $servicePrice->service_catalog_id = $catalogId;
        $servicePrice->save();

        return $servicePrice;
    }

    public function getActiveWithCatalog(): Collection
    {
        return ServicePrice::where('pr_d_status', 0)
            ->join('service_catalogs', 'service_catalogs.id', '=', 'service_prices.service_catalog_id')
            ->get();
    }

    public function getByIdWithCatalog(int $priceId): Collection
    {
        return ServicePrice::where('pr_id', $priceId)
            ->join('service_catalogs', 'service_catalogs.id', '=', 'service_prices.service_catalog_id')
            ->get();
    }

    public function updateById(int $priceId, array $data): int
    {
        return ServicePrice::where('pr_id', $priceId)->update($data);
    }

    public function softDeleteById(int $priceId): int
    {
        return ServicePrice::where('pr_id', $priceId)->update([
            'pr_d_status' => true,
        ]);
    }

    public function toggleStatus(int $priceId, bool $status): int
    {
        return ServicePrice::where('pr_id', $priceId)->update([
            'pr_status' => $status,
        ]);
    }
}
