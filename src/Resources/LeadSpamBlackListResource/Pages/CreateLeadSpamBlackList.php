<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadSpamBlackListResource\Pages;

use Pardalsalcap\LinterLeads\Resources\LeadSpamBlackListResource;
use Filament\Resources\Pages\CreateRecord;
use Pardalsalcap\LinterLeads\Repositories\BlackListRepository;

class CreateLeadSpamBlackList extends CreateRecord
{
    protected static string $resource = LeadSpamBlackListResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $repository = new BlackListRepository();
        $repository->refreshCache();
    }
}
