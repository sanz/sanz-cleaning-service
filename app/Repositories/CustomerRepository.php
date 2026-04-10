<?php

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Support\Collection;

class CustomerRepository
{
    public function countAll(): int
    {
        return Customer::count();
    }

    public function getAll(): Collection
    {
        return Customer::all();
    }

    public function findById(int $id): ?Customer
    {
        return Customer::find($id);
    }

    public function updateStatus(int $id, bool $isActive): int
    {
        return Customer::where('id', $id)->update([
            'user_status' => $isActive,
        ]);
    }

    public function countByColumnValue(string $column, string $value): int
    {
        return Customer::where($column, $value)->count();
    }

    public function create(array $data): Customer
    {
        return Customer::create($data);
    }

    public function updateById(int $id, array $data): int
    {
        return Customer::where('id', $id)->update($data);
    }
}
