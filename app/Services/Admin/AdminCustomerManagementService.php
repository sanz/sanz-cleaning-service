<?php

namespace App\Services\Admin;

use App\Repositories\CustomerRepository;

class AdminCustomerManagementService
{
    public function __construct(private readonly CustomerRepository $customerRepository)
    {
    }

    public function getCustomerRows(): array
    {
        $rows = $this->customerRepository->getAll();
        $data = [];
        $i = 0;

        foreach ($rows as $row) {
            $id = encrypt($row->id);
            $data[$i] = [
                '#' => $i + 1,
                'user-id' => '#' . $row->user_code,
                'user-name' => $row->user_name,
                'mobileNo' => $row->user_mobile,
                'email' => $row->user_email,
                'user-location' => $row->user_loc,
                'user-status' => ['text' => $row->user_status == 1 ? 'Active' : 'Inactive', 'id' => $id],
                'transactions' => ['id' => $id],
            ];
            $i++;
        }

        return $data;
    }

    public function updateUserStatus(string $encryptedId, string $hasClassValue): bool
    {
        $id = (int) decrypt($encryptedId);
        $isActive = $hasClassValue === 'true' ? false : true;

        return $this->customerRepository->updateStatus($id, $isActive) > 0;
    }

    public function getUserData(string $encryptedId)
    {
        $id = (int) decrypt($encryptedId);

        return $this->customerRepository->findById($id);
    }
}
