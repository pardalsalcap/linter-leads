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
use Pardalsalcap\LinterLeads\Models\LeadSpamBlackList;
use Pardalsalcap\LinterLeads\Resources\LeadSpamBlackListResource\Pages\CreateLeadSpamBlackList;
use Pardalsalcap\LinterLeads\Resources\LeadSpamBlackListResource\Pages\EditLeadSpamBlackList;
use Pardalsalcap\LinterLeads\Resources\LeadSpamBlackListResource\Pages\ListLeadSpamBlackLists;

class LeadSpamBlackListResource extends Resource
{
    protected static ?string $model = LeadSpamBlackList::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('word')
                        ->label(__('linter-leads::black_list.word'))
                        ->autofocus()
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Set $set, string $state) {
                            $set('slug', Str::slug($state));
                        })
                        ->minLength(3)
                        ->maxLength(255),
                    TextInput::make('slug')
                        ->label(__('linter-leads::black_list.slug'))
                        ->autofocus()
                        ->required()
                        ->minLength(3)
                        ->readOnly()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),
                    Toggle::make('is_active')
                        ->label(__('linter-leads::black_list.is_active'))
                        ->default(true),
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('word')
                    ->label(__('linter-leads::black_list.word'))
                    ->searchable()
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label(__('linter-leads::black_list.is_active'))
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
            'index' => ListLeadSpamBlackLists::route('/'),
            'create' => CreateLeadSpamBlackList::route('/create'),
            'edit' => EditLeadSpamBlackList::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('linter-leads::black_list.navigation');
    }

    public static function getModelLabel(): string
    {
        return __('linter-leads::black_list.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('linter-leads::black_list.model_label_plural');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('linter-leads::black_list.navigation_group');
    }
}
