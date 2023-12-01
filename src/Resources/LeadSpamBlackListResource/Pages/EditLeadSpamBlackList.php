<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadSpamBlackListResource\Pages;

use Pardalsalcap\LinterLeads\Resources\LeadSpamBlackListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Pardalsalcap\LinterLeads\Repositories\BlackListRepository;

class EditLeadSpamBlackList extends EditRecord
{
    protected static string $resource = LeadSpamBlackListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->after(function () {
                $repository = new BlackListRepository();
                $repository->refreshCache();
            }),
        ];
    }

    protected function afterSave(): void
    {
        $repository = new BlackListRepository();
        $repository->refreshCache();
    }
}
