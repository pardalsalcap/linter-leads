<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadSpamBlackListResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Pardalsalcap\LinterLeads\Resources\LeadSpamBlackListResource;

class ListLeadSpamBlackLists extends ListRecords
{
    protected static string $resource = LeadSpamBlackListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
