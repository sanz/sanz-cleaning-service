<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\Client;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Exception;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        View::share($this->getViewData());
    }

    private function getViewData(): array
    {
        $arr = [];
        // $arr['countClient'] = $this->getClientCount();
        // $arr['countAdminServiceList'] = $this->getAdminServiceListCount();
        // $arr['countOrder'] = $this->getOrderCount();
        return $arr;
    }

    private function getClientCount(): string
    {
        $count = Client::where('client_status', '=', 'Pending')->count();
        return ($count > 0) ? $count : '';
    }

    private function getAdminServiceListCount(): string
    {
        $count = Service::where('status', 'Pending')->count();
        return ($count > 0) ? $count : '';
    }

    private function getOrderCount(): string
    {
        $where = [
            ['service_status', 'pending'],
            ['client_id', Auth::id()],
        ];
        $count = 10;
        return ($count > 0) ? $count : '';
    }
}
