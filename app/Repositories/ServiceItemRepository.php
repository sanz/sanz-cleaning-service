<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ServiceItemRepository
{
    public function getByIds(array $itemIds): Collection
    {
        if (empty($itemIds)) {
            return collect();
        }

        return DB::table('service_items')
            ->whereIn('item_id', $itemIds)
            ->get();
    }

    public function getById(int $itemId): ?object
    {
        return DB::table('service_items')
            ->where('item_id', $itemId)
            ->first();
    }

    public function updateById(int $itemId, array $data): int
    {
        return DB::table('service_items')
            ->where('item_id', $itemId)
            ->update($data);
    }

    public function insertAndGetId(array $data): int
    {
        return (int) DB::table('service_items')->insertGetId($data);
    }

    public function getMappedByIds(array $itemIds): array
    {
        if (empty($itemIds)) {
            return [];
        }

        $items = $this->getByIds($itemIds)->keyBy('item_id');
        $result = [];

        foreach ($itemIds as $id) {
            if (isset($items[$id])) {
                $result[] = $items[$id];
            }
        }

        return $result;
    }
}
