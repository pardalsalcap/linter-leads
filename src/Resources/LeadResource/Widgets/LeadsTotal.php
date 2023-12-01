<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadResource\Widgets;

use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Pardalsalcap\LinterLeads\Models\Lead;

class LeadsTotal extends BaseWidget
{
    protected int|string|array $columnSpan = 1;

    protected function getStats(): array
    {
        //diffForHumans
        $total_leads = 0;
        $total_leads_description = __('linter-leads::leads.no_leads_yet');
        $total_leads_this_week_description = __('linter-leads::leads.no_leads_yet');
        $total_leads_last_week_description = __('linter-leads::leads.no_leads_yet');
        $total_leads_this_week = 0;
        $total_leads_last_week = 0;
        $days_up = '';
        $first = Lead::orderBy('created_at', 'ASC')->first();
        if ($first) {
            $total_leads_last_week = Lead::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->count();
            $total_leads_success_last_week = Lead::where('is_success', true)->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->count();
            $total_leads_this_week = Lead::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $total_leads_success_this_week = Lead::where('is_success', true)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

            $total_leads = Lead::count();
            $days_up = $first->created_at->diffForHumans();
            $total_leads_description = __('linter-leads::leads.stats_total_description', [
                't' => $total_leads,
                'd' => $days_up,
            ]);
            $total_leads_this_week_description = __('linter-leads::leads.stats_total_current_week_description', [
                't' => $total_leads_this_week,
                's' => $total_leads_success_this_week,
            ]);
            $total_leads_last_week_description = __('linter-leads::leads.stats_total_last_week_description', [
                't' => $total_leads_last_week,
                's' => $total_leads_success_last_week,
            ]);
        }

        return [
            Stat::make(__('linter-leads::leads.stats_total_title'), $total_leads)
                ->description($total_leads_description)
            //->descriptionIcon('heroicon-m-arrow-trending-up')
            ,
            Stat::make(__('linter-leads::leads.stats_total_current_week_title'), $total_leads_this_week)
                ->description($total_leads_this_week_description)
            //->descriptionIcon('heroicon-m-arrow-trending-up')
            ,
            Stat::make(__('linter-leads::leads.stats_total_last_week_title'), $total_leads_last_week)
                ->description($total_leads_last_week_description)
            //->descriptionIcon('heroicon-m-arrow-trending-up')
            ,
        ];
    }

    protected function getColumns(): int
    {
        return 3;
    }
}
