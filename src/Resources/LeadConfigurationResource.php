<?php

namespace Pardalsalcap\LinterLeads\Resources;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Pardalsalcap\LinterLeads\Models\LeadConfiguration;
use Pardalsalcap\LinterLeads\Repositories\LeadConfigurationRepository;
use Pardalsalcap\LinterLeads\Resources\LeadConfigurationResource\Pages\CreateLeadConfiguration;
use Pardalsalcap\LinterLeads\Resources\LeadConfigurationResource\Pages\EditLeadConfiguration;
use Pardalsalcap\LinterLeads\Resources\LeadConfigurationResource\Pages\ListLeadConfiguration;


class LeadConfigurationResource extends Resource
{
    protected static ?string $model = LeadConfiguration::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('parameter')
                        ->label(__('linter-leads::configuration.parameter'))
                        ->autofocus()
                        ->required()
                        ->minLength(3)
                        ->maxLength(255),
                    Toggle::make('is_active')
                        ->label(__('linter-leads::configuration.is_active'))
                        ->default(true),
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('parameter')
                    ->label(__('linter-leads::configuration.parameter'))
                    ->searchable()
                    ->formatStateUsing(function (string $state, LeadConfiguration $record) {
                        return __("linter-leads::parameters.".$state);
                    })
                    ->wrap()
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label(__('linter-leads::configuration.is_active'))
                    ->afterStateUpdated(function ($record, $state) {
                        (new LeadConfigurationRepository())->refreshCache();
                    })
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => ListLeadConfiguration::route('/'),
            'create' => CreateLeadConfiguration::route('/create'),
            'edit' => EditLeadConfiguration::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('linter-leads::configuration.navigation');
    }

    public static function getModelLabel(): string
    {
        return __('linter-leads::configuration.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('linter-leads::configuration.model_label_plural');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('linter-leads::configuration.navigation_group');
    }
}
