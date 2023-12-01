<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Pardalsalcap\LinterLeads\Resources\LeadResource;
use Pardalsalcap\LinterLeads\Resources\LeadResource\Widgets\LeadsChartLastMonth;
use Pardalsalcap\LinterLeads\Resources\LeadResource\Widgets\LeadsChartLastYear;
use Pardalsalcap\LinterLeads\Resources\LeadResource\Widgets\LeadsSuccess;
use Pardalsalcap\LinterLeads\Resources\LeadResource\Widgets\LeadsTotal;

class ListLeads extends ListRecords
{
    protected static string $resource = LeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            LeadsSuccess::class,
            LeadsTotal::class,
            LeadsChartLastMonth::class,
            LeadsChartLastYear::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 2;
    }
}
