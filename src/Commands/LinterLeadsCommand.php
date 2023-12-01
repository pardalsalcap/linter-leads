<?php

namespace Pardalsalcap\LinterLeads\Commands;

use Illuminate\Console\Command;

class LinterLeadsCommand extends Command
{
    public $signature = 'linter-leads:install';

    public $description = 'This command will install Linter Leads, it will populate the database with the default configuration and the blacklisted words';

    public function handle(): int
    {
        // Prompt the user to confirm the database population
        if (! $this->confirm('This command will install Linter Leads, it will populate the database with the default configuration and the blacklisted words. Do you wish to continue?')) {
            $this->comment('Installation aborted');

            return self::SUCCESS;
        }
        // Parse the Json file located in resources/stubs/blacklist.json
        $blacklist = json_decode(file_get_contents(__DIR__.'/../../resources/stubs/blacklist.json'), true);
        // Populate the database with the blacklisted words
        foreach ($blacklist as $word) {
            // check if the word is created using the model LeadSpamBlackList slug field using the firstOrCreate method
            \Pardalsalcap\LinterLeads\Models\LeadSpamBlackList::firstOrCreate([
                'slug' => \Illuminate\Support\Str::slug($word),
            ], [
                'word' => $word,
                'is_active' => true,
            ]);


        }

        $this->comment('All done');

        return self::SUCCESS;
    }
}
