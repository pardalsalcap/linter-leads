<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadSpamBlackListResource\Pages;

use App\Filament\Resources\LeadSpamBlackListResource;
use Filament\Actions;
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
