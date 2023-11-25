<?php

namespace Pardalsalcap\LinterLeads\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Pardalsalcap\LinterLeads\LinterLeads
 */
class LinterLeads extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Pardalsalcap\LinterLeads\LinterLeads::class;
    }
}
