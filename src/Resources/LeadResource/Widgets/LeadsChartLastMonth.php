<?php

namespace Pardalsalcap\LinterLeads\Resources\LeadResource\Widgets;

use Filament\Widgets\ChartWidget as BaseWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Pardalsalcap\LinterLeads\Models\Lead;

class LeadsChartLastMonth extends BaseWidget
{
    protected int|string|array $columnSpan = 1;

    protected static ?string $heading = 'Leads Recibidos este mes';

    protected function getData(): array
    {
        $data = Trend::model(Lead::class)
            ->between(
                start: now()->subMonth(),
                end: now(),
            )
            ->perDay()
            ->count();
        $data_success = Trend::query(
            Lead::query()
                ->where('is_success', true)
        )
            ->between(
                start: now()->subMonth(),
                end: now(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Leads',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
                [
                    'label' => 'Success',
                    'backgroundColor' => '#08A045',
                    'borderColor' => '#08A045',
                    'data' => $data_success->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getColumns(): int
    {
        return 1;
    }
}
