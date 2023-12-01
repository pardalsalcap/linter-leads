<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadConfigurationResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Pardalsalcap\LinterLeads\Repositories\LeadConfigurationRepository;
use Pardalsalcap\LinterLeads\Resources\LeadConfigurationResource;

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
