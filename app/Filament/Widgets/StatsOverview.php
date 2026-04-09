<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Products', Product::count())
                ->description('Total products in store')
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->color('success'),
            Stat::make('Total Orders', Order::count())
                ->description('Orders placed')
                ->descriptionIcon('heroicon-o-shopping-cart')
                ->color('primary'),
            Stat::make('Total Users', User::where('role', 'user')->count())
                ->description('Registered users')
                ->descriptionIcon('heroicon-o-users')
                ->color('warning'),
            Stat::make('Pending Orders', Order::where('status', 'pending')->count())
                ->description('Orders waiting confirmation')
                ->descriptionIcon('heroicon-o-clock')
                ->color('danger'),
        ];
    }
}