<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Pardalsalcap\LinterLeads\Models\Lead;

class LeadsSuccess extends BaseWidget
{
    protected int|string|array $columnSpan = 1;

    protected function getStats(): array
    {
        $total_leads = Lead::count();
        $no_data_description = __('linter-leads::leads.no_leads_yet');
        $total_success = 0;
        $total_success_description = $no_data_description;
        $total_spam_description = $no_data_description;
        $total_unread_description = $no_data_description;
        $total_spam = 0;
        $total_unread = 0;

        if ($total_leads > 0) {
            $total_success = Lead::where('is_success', true)->count();
            $total_success_description = __('linter-leads::leads.stats_success_description', ['ls' => $total_success]);
            $total_spam = Lead::where('is_spam', true)->count();
            $total_spam_description = __('linter-leads::leads.stats_spam_description', ['ls' => $total_spam]);
            $total_unread = Lead::where('is_read', false)->count();
            $total_unread_description = __('linter-leads::leads.stats_unread_description', ['ls' => $total_spam]);
        }

        return [
            Stat::make(__('linter-leads::leads.stats_success_title'), self::percentage($total_success, $total_leads).'%')
                ->description($total_success_description),
            Stat::make(__('linter-leads::leads.stats_spam_title'), self::percentage($total_spam, $total_leads).'%')
                ->description($total_spam_description),
            Stat::make(__('linter-leads::leads.stats_unread_title'), self::percentage($total_unread, $total_leads).'%')
                ->description($total_unread_description),
        ];
    }

    protected function percentage($num_amount, $num_total)
    {
        if ($num_total < 1) {
            return 0;
        }
        $count1 = $num_amount / $num_total;
        $count2 = $count1 * 100;
        $count = number_format($count2, 0);

        return $count;
    }

    protected function getColumns(): int
    {
        return 3;
    }
}
