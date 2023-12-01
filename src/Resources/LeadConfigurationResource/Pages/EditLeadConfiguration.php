<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadConfigurationResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Pardalsalcap\LinterLeads\Repositories\LeadConfigurationRepository;
use Pardalsalcap\LinterLeads\Resources\LeadConfigurationResource;

class EditLeadConfiguration extends EditRecord
{
    protected static string $resource = LeadConfigurationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->after(function () {
                $repository = new LeadConfigurationRepository();
                $repository->refreshCache();
            }),
        ];
    }

    protected function afterSave(): void
    {
        $repository = new LeadConfigurationRepository();
        $repository->refreshCache();
    }
}
