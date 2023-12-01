<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadConfigurationResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Pardalsalcap\LinterLeads\Resources\LeadConfigurationResource;

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
