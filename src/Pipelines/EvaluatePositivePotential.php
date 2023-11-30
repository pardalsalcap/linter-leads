<?php

namespace Pardalsalcap\LinterLeads\Pipelines;

use Pardalsalcap\LinterLeads\Models\Lead;

class EvaluatePositivePotential
{
    protected int $score = 0;

    public function handle(Lead $lead, $next)
    {
        // Evaluate the positive potential of the lead
        $this->calculate($lead);
        $lead->score = $lead->score - $this->score;

        return $next($lead);
    }

    private function calculate($lead): void
    {
        // Evaluate is the lead has visited the website
        // Evaluate how many pages has visited

    }
}
