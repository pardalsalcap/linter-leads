<?php

namespace Pardalsalcap\LinterLeads\Repositories;

use Illuminate\Support\Facades\Cache;
use Pardalsalcap\LinterLeads\Models\LeadConfiguration;

class LeadConfigurationRepository
{
    public function __construct()
    {
        if (! Cache::has('lead_configuration')) {
            $this->refreshCache();
        }
    }

    public function refreshCache():void
    {
        $configuration = LeadConfiguration::where('is_active', true)->get();
        Cache::forever('lead_configuration', $configuration);
    }

    public function getConfiguration()
    {
        if (! Cache::has('lead_configuration')) {
            $this->refreshCache();
        }

        return Cache::get('lead_configuration');
    }

    public function getParameterValue(string $parameter)
    {
        $configuration = $this->getConfiguration();
        $parameter = $configuration->where('parameter', $parameter)->first();
        return $parameter->value;
    }

    public function getParameterStatus (string $parameter):bool
    {
        $configuration = $this->getConfiguration();
        $parameter = $configuration->where('parameter', $parameter)->first();
        if (!$parameter){
            return false;
        }
        return (bool) $parameter->is_active;
    }
}
