<?php

namespace Pardalsalcap\LinterLeads\Repositories;

use Pardalsalcap\LinterLeads\Models\Lead;

class LeadRepository
{
    public static function showFieldInInfoList(Lead $lead, string $field): bool
    {
        $available_fields = config('linter-leads.mappings.'.$lead->source);
        if (! is_array($available_fields)) {
            return false;
        }
        if (! in_array($field, array_keys($available_fields))) {
            return false;
        }

        return true;
    }

    public static function byStatusCount(string $status): int
    {
        return Lead::where('status', $status)->count();
    }

    public static function readCount(bool $read_status = true): int
    {
        return Lead::where('is_read', $read_status)->count();
    }

    public static function successCount(bool $success_status = true): int
    {
        return Lead::where('is_success', $success_status)->count();
    }

    public static function spamCount(bool $spam_status = true): int
    {
        return Lead::where('is_spam', $spam_status)->count();
    }

    public static function bySourceCount(string $source): int
    {
        return Lead::where('source', $source)->count();
    }

    public static function flaggedCount(bool $flagged_status = true): int
    {
        return Lead::where('is_flagged', $flagged_status)->count();
    }
}
