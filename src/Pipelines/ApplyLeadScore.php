<?php

namespace Pardalsalcap\LinterLeads\Pipelines;

use Pardalsalcap\LinterLeads\Models\Lead;

class ApplyLeadScore
{
    public function handle(Lead $lead, $next)
    {
        $threshold=config('linter-leads.spam_score_threshold');
        // Flag the lead as spam if it meets certain criteria
        if($lead->score >= $threshold/2)
        {
            $lead->is_flagged = true;
        }
        if ($lead->score > $threshold) {
            $lead->is_spam = true;
        }

        return $next($lead);
    }
}
