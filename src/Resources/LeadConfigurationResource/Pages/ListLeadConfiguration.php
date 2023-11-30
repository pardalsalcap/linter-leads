<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadConfigurationResource\Pages;

use App\Filament\Resources\LeadConfigurationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLeadConfiguration extends ListRecords
{
    protected static string $resource = LeadConfigurationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
