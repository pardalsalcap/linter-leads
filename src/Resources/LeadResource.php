<?php

namespace Pardalsalcap\LinterLeads\Resources;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;
use Pardalsalcap\LinterLeads\Models\Lead;
use Pardalsalcap\LinterLeads\Repositories\LeadRepository;
use Pardalsalcap\LinterLeads\Resources\LeadResource\Pages\CreateLead;
use Pardalsalcap\LinterLeads\Resources\LeadResource\Pages\EditLead;
use Pardalsalcap\LinterLeads\Resources\LeadResource\Pages\ListLeads;
use Pardalsalcap\LinterLeads\Resources\LeadResource\Pages\ViewLead;
use Pardalsalcap\LinterLeads\Resources\LeadResource\Widgets\LeadsChartLastMonth;
use Pardalsalcap\LinterLeads\Resources\LeadResource\Widgets\LeadsChartLastYear;
use Pardalsalcap\LinterLeads\Resources\LeadResource\Widgets\LeadsSuccess;
use Pardalsalcap\LinterLeads\Resources\LeadResource\Widgets\LeadsTotal;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-star';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
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
                TextColumn::make('status')
                    ->label(__('linter-leads::leads.status_column'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'gray',
                        'read' => 'info',
                        'follow_up' => 'warning',
                        'fail' => 'danger',
                        'success' => 'success',
                        default => 'black',
                    })
                    ->sortable()
                    ->formatStateUsing(fn (string $state) => __('linter-leads::status.'.$state)),
                IconColumn::make('is_read')
                    ->boolean()
                    ->label(__('linter-leads::leads.contact_read'))
                    ->sortable(),
                IconColumn::make('is_spam')
                    ->boolean()
                    ->label(__('linter-leads::leads.contact_spam'))
                    ->sortable(),
                IconColumn::make('is_success')
                    ->boolean()
                    ->label(__('linter-leads::leads.contact_success'))
                    ->sortable(),
            ])
            ->filters([
                Filter::make('is_unread')
                    ->label(__('linter-leads::leads.contact_read_0'))
                    ->query(fn (Builder $query): Builder => $query->where('is_read', false)),
                Filter::make('spam')
                    ->label(__('linter-leads::leads.contact_spam_1'))
                    ->query(fn (Builder $query): Builder => $query->where('is_spam', true)),
                Filter::make('is_success')
                    ->label(__('linter-leads::leads.contact_success_1'))
                    ->query(fn (Builder $query): Builder => $query->where('is_success', true)),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * @return array<class-string<Widget>>
     */
    public static function getWidgets(): array
    {
        return [
            LeadsSuccess::class,
            LeadsTotal::class,
            LeadsChartLastMonth::class,
            LeadsChartLastYear::class,
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLeads::route('/'),
            'create' => CreateLead::route('/create'),
            'edit' => EditLead::route('/{record}/edit'),
            'view' => ViewLead::route('/{record}'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('linter-leads::leads.navigation');
    }

    public static function getModelLabel(): string
    {
        return __('linter-leads::leads.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('linter-leads::leads.model_label_plural');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('linter-leads::leads.navigation_group');
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Group::make()
                    ->columnSpan(2)
                    ->schema([
                        Section::make()
                            ->schema([
                                TextEntry::make('status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'new' => 'gray',
                                        'read' => 'info',
                                        'follow_up' => 'warning',
                                        'fail' => 'danger',
                                        'success' => 'success',
                                        default => 'primary',
                                    })
                                    ->formatStateUsing(fn (string $state) => __('linter-leads::status.'.$state)),
                                TextEntry::make('name')
                                    ->label(__('linter-leads::form.contact_name_field'))
                                    ->visible(function (Lead $record) {
                                        return LeadRepository::showFieldInInfoList($record, 'name');
                                    }),
                                TextEntry::make('company')
                                    ->label(__('linter-leads::form.contact_company_field'))
                                    ->visible(function (Lead $record) {
                                        return LeadRepository::showFieldInInfoList($record, 'company');
                                    }),
                                TextEntry::make('email')
                                    ->label(__('linter-leads::form.contact_email_field'))
                                    ->visible(function (Lead $record) {
                                        return LeadRepository::showFieldInInfoList($record, 'email');
                                    }),
                                TextEntry::make('phone')
                                    ->label(__('linter-leads::form.contact_phone_field'))
                                    ->visible(function (Lead $record) {
                                        return LeadRepository::showFieldInInfoList($record, 'phone');
                                    }),

                                TextEntry::make('city')
                                    ->label(__('linter-leads::form.contact_city_field'))
                                    ->visible(function (Lead $record) {
                                        return LeadRepository::showFieldInInfoList($record, 'phone');
                                    }),
                                TextEntry::make('message')
                                    ->label(__('linter-leads::form.contact_message_field'))
                                    ->formatStateUsing(fn (string $state) => nl2br($state))
                                    ->visible(function (Lead $record) {
                                        return LeadRepository::showFieldInInfoList($record, 'phone');
                                    }),
                            ]),
                    ]),
                Group::make()
                    ->schema([
                        Section::make(__('linter-leads::leads.contact_metadata'))
                            ->schema([
                                TextEntry::make('source')
                                    ->label(__('linter-leads::leads.contact_source_field'))
                                    ->formatStateUsing(fn (string $state) => __('linter-leads::types.'.$state)),
                                TextEntry::make('created_at')
                                    ->label(__('linter-leads::leads.contact_created_at_field'))
                                    ->dateTime(config('linter.date_time_format_tables')),
                                TextEntry::make('ip')
                                    ->label(__('linter-leads::leads.contact_ip_field')),
                                TextEntry::make('is_read')
                                    ->label(__('linter-leads::leads.contact_read'))
                                    ->formatStateUsing(function (Lead $lead) {
                                        if ($lead->is_read) {
                                            return __('linter-leads::leads.contact_read_1');
                                        }

                                        return __('linter-leads::leads.contact_read_0');
                                    })
                                    ->hintAction(
                                        Action::make('read')
                                            ->label(__('linter-leads::leads.contact_mark_as_read'))
                                            ->icon('heroicon-m-envelope')
                                            ->requiresConfirmation()
                                            ->action(function (Lead $lead) {
                                                $lead->is_read = true;
                                                $lead->save();
                                            })
                                            ->visible(function (Lead $lead) {
                                                return $lead->is_read == 0;
                                            }),
                                    )
                                    ->hintAction(
                                        Action::make('not_read')
                                            ->label(__('linter-leads::leads.contact_mark_as_unread'))
                                            ->icon('heroicon-m-envelope-open')
                                            ->requiresConfirmation()
                                            ->action(function (Lead $lead) {
                                                $lead->is_read = false;
                                                $lead->save();
                                            })
                                            ->visible(function (Lead $lead) {
                                                return $lead->is_read == 1;
                                            }),
                                    ),
                                TextEntry::make('is_spam')
                                    ->label(__('linter-leads::leads.contact_spam'))
                                    ->formatStateUsing(function (Lead $lead) {
                                        if ($lead->is_spam) {
                                            return __('linter-leads::leads.contact_spam_1');
                                        }

                                        return __('linter-leads::leads.contact_spam_0');
                                    })
                                    ->hintAction(
                                        Action::make('spam')
                                            ->label(__('linter-leads::leads.contact_mark_as_spam'))
                                            ->icon('heroicon-m-bug-ant')
                                            ->requiresConfirmation()
                                            ->action(function (Lead $lead) {
                                                $lead->is_spam = true;
                                                $lead->save();
                                            })
                                            ->visible(function (Lead $lead) {
                                                return $lead->is_spam == 0;
                                            }),
                                    )
                                    ->hintAction(
                                        Action::make('not_spam')
                                            ->label(__('linter-leads::leads.contact_mark_as_not_spam'))
                                            ->icon('heroicon-m-star')
                                            ->requiresConfirmation()
                                            ->action(function (Lead $lead) {
                                                $lead->is_spam = false;
                                                $lead->save();
                                            })
                                            ->visible(function (Lead $lead) {
                                                return $lead->is_spam == 1;
                                            }),
                                    ),
                                TextEntry::make('is_success')
                                    ->label(__('linter-leads::leads.contact_success'))
                                    ->formatStateUsing(function (Lead $lead) {
                                        if ($lead->is_success) {
                                            return __('linter-leads::leads.contact_success_1');
                                        }

                                        return __('linter-leads::leads.contact_success_0');
                                    })
                                    ->hintAction(
                                        Action::make('is_success')
                                            ->label(__('linter-leads::leads.contact_mark_as_success'))
                                            ->icon('heroicon-m-sparkles')
                                            ->requiresConfirmation()
                                            ->action(function (Lead $lead) {
                                                $lead->is_success = true;
                                                $lead->save();
                                            })
                                            ->visible(function (Lead $lead) {
                                                return $lead->is_success == 0;
                                            }),
                                    )
                                    ->hintAction(
                                        Action::make('not_success')
                                            ->label(__('linter-leads::leads.contact_mark_as_not_success'))
                                            ->icon('heroicon-m-question-mark-circle')
                                            ->requiresConfirmation()
                                            ->action(function (Lead $lead) {
                                                $lead->is_success = false;
                                                $lead->save();
                                            })
                                            ->visible(function (Lead $lead) {
                                                return $lead->is_success == 1;
                                            }),
                                    ),
                            ]),
                    ]),

                // ['content_id', '', 'surname', '', '', '', '', '', 'type', 'ip', 'read', 'spam', 'success', 'data', 'created_at', 'updated_at'];
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
