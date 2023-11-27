<?php

namespace Pardalsalcap\LinterLeads\Services;

class LeadScoringService {
    public function calculateScore(Lead $lead) {
        $score = 0;

        // Add points based on defined criteria
        $score += $lead->emailOpens * 2;
        $score += $lead->whitepapersDownloaded * 10;
        // ... other criteria

        return $score;
    }
}
