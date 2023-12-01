<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Pardalsalcap\LinterLeads\Repositories\LeadRepository;
use Pardalsalcap\LinterLeads\Resources\LeadResource;
use Pardalsalcap\LinterLeads\Resources\LeadResource\Widgets\LeadsChartLastMonth;
use Pardalsalcap\LinterLeads\Resources\LeadResource\Widgets\LeadsChartLastYear;
use Pardalsalcap\LinterLeads\Resources\LeadResource\Widgets\LeadsSuccess;
use Pardalsalcap\LinterLeads\Resources\LeadResource\Widgets\LeadsTotal;

class ListLeads extends ListRecords
{
    protected static string $resource = LeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            LeadsSuccess::class,
            LeadsTotal::class,
            LeadsChartLastMonth::class,
            LeadsChartLastYear::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 2;
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'new' => Tab::make('New')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('status', 'new');
                })
                ->badge(function () {
                    return LeadRepository::byStatusCount('new');
                }),
            'read' => Tab::make('Read')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('is_read', true);
                })
                ->badge(function () {
                    return LeadRepository::readCount(true);
                }),
            'unread' => Tab::make('Unread')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('is_read', false);
                })
                ->badge(function () {
                    return LeadRepository::readCount(false);
                }),
            'success' => Tab::make('Success')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('is_success', true);
                })
                ->badge(function () {
                    return LeadRepository::successCount(true);
                }),
            'spam' => Tab::make('Spam')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('is_spam', true);
                })->badge(function () {
                    return LeadRepository::spamCount(true);
                }),
            'flagged' => Tab::make('Flagged')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('is_flagged', true);
                })->badge(function () {
                    return LeadRepository::flaggedCount(true);
                }),

        ];
    }
}
