<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadResource\Pages;

use Pardalsalcap\LinterLeads\Resources\LeadResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

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
