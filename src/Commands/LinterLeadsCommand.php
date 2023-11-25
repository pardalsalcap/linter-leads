<?php

namespace Pardalsalcap\LinterLeads\Commands;

use Illuminate\Console\Command;

class LinterLeadsCommand extends Command
{
    public $signature = 'linter-leads';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
