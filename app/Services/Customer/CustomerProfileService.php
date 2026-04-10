<?php

namespace App\Services\Customer;

use App\Repositories\CustomerRepository;
use Illuminate\Support\Facades\Hash;

class CustomerProfileService
{
    public function __construct(private readonly CustomerRepository $customerRepository)
    {
    }

    public function updateProfile(int $customerId, array $data): int
    {
        return $this->customerRepository->updateById($customerId, $data);
    }

    public function checkOldPassword(string $plainOldPassword, string $currentHash): bool
    {
        return Hash::check($plainOldPassword, $currentHash);
    }

    public function makePasswordHash(string $password): string
    {
        return Hash::make($password);
    }
}
