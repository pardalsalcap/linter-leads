<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadConfigurationResource\Pages;

use App\Filament\Resources\LeadConfigurationResource;
use Filament\Resources\Pages\CreateRecord;
use Pardalsalcap\LinterLeads\Repositories\LeadConfigurationRepository;

class CreateLeadConfiguration extends CreateRecord
{
    protected static string $resource = LeadConfigurationResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $repository = new LeadConfigurationRepository();
        $repository->refreshCache();
    }
}
