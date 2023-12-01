<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Pardalsalcap\LinterLeads\Resources\LeadResource;

class EditLead extends EditRecord
{
    protected static string $resource = LeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
