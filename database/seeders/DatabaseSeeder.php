<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ServicePrice;
use App\Models\ServiceCatalog;
use App\Models\Service;
use App\Models\ServiceReview;
use App\Models\Client;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->createAdmin();
        $this->seedServiceCatalog();
        $this->seedServiceListings($this->seedClients());

        Customer::factory(10)->create();

        Customer::factory([
            'user_name' => 'Akash Kumar Patel',
            'user_email' => 'akash@customer.com',
            'user_gender' => 'male',
            'user_state' => 'Ontario',
            'user_city' => 'Toronto',
        ])->create();

        Customer::factory([
            'user_name' => 'Zarrin Tasnim',
            'user_email' => 'zarrin@customer.com',
            'user_gender' => 'female',
            'user_state' => 'Quebec',
            'user_city' => 'Montreal',
        ])->create();

        Customer::factory([
            'user_name' => 'Sanish Gurung',
            'user_email' => 'sanish@customer.com',
            'user_gender' => 'male',
            'user_state' => 'Ontario',
            'user_city' => 'Sudbury',
        ])->create();

        $this->seedServiceReviews();
        
    }

    private function createAdmin(): void
    {
        User::create([
            'name' => 'Sanish',
            'email' => 'sanish@admin.com',
            'password' => Hash::make('password'),
        ]);
    }

    private function seedServiceCatalog(): void
    {
        $json = file_get_contents(storage_path('json-data/service-catalogs.json'));
        $catalogs = json_decode($json, true);

        foreach ($catalogs as $catalog) {
            $catalogModel = new ServiceCatalog();
            $catalogModel->service_name = $catalog['service_name'];
            $catalogModel->service_category = $catalog['service_category'];
            $catalogModel->service_description = $catalog['service_description'];
            $catalogModel->service_image = $catalog['service_image'];
            $catalogModel->save();

            $servicePrice = new ServicePrice();
            $servicePrice->service_catalog_id = $catalogModel->id;
            $servicePrice->visit_charge = rand(5, 20);
            $servicePrice->service_charge = rand(35, 80);
            $servicePrice->save();
        }
    }

    private function seedClients(): array
    {
        $json = file_get_contents(storage_path('json-data/clients.json'));
        $clients = json_decode($json, true);

        $clientIds = [];
        foreach ($clients as $client) {
            $model = new Client();
            $model->client_code = $client['client_code'];
            $model->client_name = $client['client_name'];
            $model->client_email = $client['client_email'];
            $model->client_mobile = $client['client_mobile'];
            $model->client_gender = $client['client_gender'];
            $model->client_photo_url = $client['client_photo_url'];
            $model->password = Hash::make($client['password']);
            $model->save();

            $clientIds[] = $model->id;
        }

        return $clientIds;
    }

    private function seedServiceListings(array $clientIds): void
    {
        $json = file_get_contents(storage_path('json-data/service-listings.json'));
        $listings = json_decode($json, true);

        foreach ($listings as $listing) {
            $clientId = $clientIds[$listing['client_index']];
            $catalog = ServiceCatalog::where('service_name', $listing['service_name'])->first();

            if (!$catalog) {
                continue;
            }

            $itemIds = $this->seedItems($clientId, $listing['items']);

            Service::create([
                'client_id' => $clientId,
                'service_catalog_id' => $catalog->id,
                'name' => $listing['ser_pro_name'],
                'experience' => $listing['user_ser_exp'],
                'description' => $listing['ser_dec'],
                'phone' => $listing['ser_phone'],
                'email' => $listing['ser_email'],
                'website' => $listing['ser_web'],
                'facebook' => $listing['ser_fb'],
                'twitter' => $listing['ser_tw'],
                'linkedin' => $listing['ser_linkedin'],
                'photo' => $listing['ser_photo'],
                'document_number' => $listing['doc_no'],
                'document_image' => $listing['doc_image'],
                'state' => $listing['ser_state'],
                'city' => $listing['ser_city'],
                'address' => $listing['ser_address'],
                'pincode' => $listing['pin_no'],
                'available_days' => $listing['ser_days'],
                'available_time' => $listing['ser_time'],
                'item_ids' => $itemIds,
                'status' => $listing['ser_status'],
            ]);
        }
    }

    private function seedItems(int $clientId, array $items): string
    {
        $ids = '';
        foreach ($items as $item) {
            $id = DB::table('service_items')->insertGetId([
                'client_id' => $clientId,
                'name' => $item['item_name'],
                'description' => $item['item_des'],
                'item_price' => $item['item_price'],
            ]);
            $ids .= $id . ', ';
        }

        return $ids;
    }

    private function seedServiceReviews(): void
    {
        $customerIds = Customer::query()->pluck('id')->all();

        if (empty($customerIds)) {
            return;
        }

        $serviceIds = Service::query()->pluck('service_id')->all();

        foreach ($serviceIds as $serviceId) {
            ServiceReview::factory()
                ->count(5)
                ->state(function () use ($serviceId, $customerIds): array {
                    return [
                        'service_id' => $serviceId,
                        'user_id' => $customerIds[array_rand($customerIds)],
                    ];
                })
                ->create();
        }
    }
}
