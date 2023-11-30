<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadSpamBlackListResource\Pages;

use App\Filament\Resources\LeadSpamBlackListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

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
