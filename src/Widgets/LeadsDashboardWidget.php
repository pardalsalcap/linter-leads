<?php

namespace Pardalsalcap\LinterLeads\Widgets;

use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Pardalsalcap\LinterLeads\Models\Lead;
use Pardalsalcap\LinterLeads\Resources\LeadResource;

class LeadsDashboardWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(Lead::query()->latest()->limit(10))
            ->columns([
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
            ])
            ->recordActions([
                ViewAction::make('view'),
            ])
            ->headerActions([
                Action::make('viewAll')
                    ->label('View All')
                    ->url(LeadResource::getUrl()),
            ])
            ->paginated(false);
    }
}
