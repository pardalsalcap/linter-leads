<?php

namespace Pardalsalcap\LinterLeads\Repositories;

use Pardalsalcap\LinterLeads\Models\Lead;

class LeadRepository
{
    public static function showFieldInInfoList (Lead $lead, string $field):bool
    {
        $available_fields = config("linter-leads.mappings.".$lead->source);
        if (!is_array($available_fields))
        {
            return false;
        }
        if (!in_array($field, array_keys($available_fields)))
        {
            return false;
        }
        return true;
    }
}
