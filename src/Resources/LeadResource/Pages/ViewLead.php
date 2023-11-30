<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadResource\Pages;

use App\Filament\Resources\LeadResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewLead extends ViewRecord
{
    protected static string $resource = LeadResource::class;

    public function getTitle(): string|Htmlable
    {
        return __("linter-leads::leads.view_title", ["name"=>$this->record->name, 'date'=>$this->record->created_at->format(config('linter.date_time_format_tables'))]);
    }


}
