<?php

namespace Pardalsalcap\LinterLeads\Repositories;

use Illuminate\Support\Facades\Cache;
use Pardalsalcap\LinterLeads\Models\LeadSpamBlackList;

class BlackListRepository
{
    public function __construct()
    {
        if (! Cache::has('blacklist')) {
            $this->refreshCache();
        }
    }

    public function refreshCache()
    {
        $blacklist = LeadSpamBlackList::where('is_active', true)->get();
        Cache::forever('blacklist', $blacklist);
    }

    public function getBlackList()
    {
        if (! Cache::has('blacklist')) {
            $this->refreshCache();
        }

        return Cache::get('blacklist');
    }
}
