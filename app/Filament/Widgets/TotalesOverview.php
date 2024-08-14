<?php

namespace App\Filament\Widgets;

use App\Models\Movements;
use App\Models\Requests;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalesOverview extends BaseWidget
{
    protected function getStats(): array
    {

        $request = Requests::get()->count();
        $movements = Movements::get()->count();

        return [
            Stat::make('Total de solicitudes', $request)
                ->description('Total de solicitudes de clientes')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('info')
                ->chart([1,1]),
            Stat::make('Total de movimientos', $movements)
                ->description('Total de movimientos de solicitudes')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('info')
                ->chart([1,1]),
        ];
    }
}
