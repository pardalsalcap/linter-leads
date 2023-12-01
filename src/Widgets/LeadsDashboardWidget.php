<?php

namespace Pardalsalcap\LinterLeads\Widgets;

use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Pardalsalcap\LinterLeads\Models\Lead;
use Pardalsalcap\LinterLeads\Resources\LeadResource;

class LeadsDashboardWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Lead::latest()->take(10);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('email')
                ->label(__('linter-leads::leads.contact_email_field'))
                ->searchable(['name', 'email'])
                ->formatStateUsing(function (Lead $record) {
                    return (! empty($record->name) ? $record->name.'<br />' : '').$record->email;
                })
                ->html(),
            TextColumn::make('created_at')
                ->label(__('linter-leads::leads.contact_created_at_field'))
                ->dateTime(config('linter.date_time_format_tables'))
                ->sortable(),
            TextColumn::make('message')
                ->label('Message')
                ->limit(100)
                ->wrap()
                ->searchable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make('view'),
        ];
    }

    protected function getTableHeaderActions(): array
    {
        return [
            Tables\Actions\Action::make('View all')
                ->label('View All')
                ->url(LeadResource::getUrl()),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
