<?php

namespace App\Services\Auth;

use App\Repositories\ClientRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class RegistrationService
{
    public function __construct(
        private readonly ClientRepository $clientRepository,
        private readonly CustomerRepository $customerRepository,
        private readonly UserRepository $userRepository
    ) {
    }

    public function createAdminUser(array $data)
    {
        return $this->userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function createClient(array $data)
    {
        return $this->clientRepository->create([
            'client_code' => $this->generateCode('client_code'),
            'client_name' => $data['name'],
            'client_email' => $data['email'],
            'client_mobile' => $data['mobile'],
            'client_gender' => $data['gender'] ?? null,
            'password' => Hash::make($data['password']),
        ]);
    }

    public function createCustomer(array $data)
    {
        return $this->customerRepository->create([
            'user_code' => $this->generateCode('user_code'),
            'user_name' => $data['name'],
            'user_email' => $data['email'],
            'user_mobile' => $data['mobile'],
            'user_gender' => $data['gender'] ?? null,
            'password' => Hash::make($data['password']),
        ]);
    }

    private function generateCode(string $column): string
    {
        if ($column === 'client_code') {
            return $this->generateClientCode();
        }

        return $this->generateCustomerCode();
    }

    private function generateClientCode(): string
    {
        do {
            $id = 'CI-' . date('ym') . rand(100, 999);
        } while ($this->clientRepository->countByColumnValue('client_code', $id) > 0);

        return $id;
    }

    private function generateCustomerCode(): string
    {
        do {
            $id = 'UI-' . date('ym') . rand(100, 999);
        } while ($this->customerRepository->countByColumnValue('user_code', $id) > 0);

        return $id;
    }
}
