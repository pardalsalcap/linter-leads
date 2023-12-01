<?php

namespace Pardalsalcap\LinterLeads\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LinterLeadsCommand extends Command
{
    public $signature = 'linter-leads:install';

    public $description = 'This command will install Linter Leads, it will populate the database with the default configuration and the blacklisted words';

    protected array $models = [
        'Lead',
        'LeadSpamBlackList',
        'LeadConfiguration',
        'LeadInteraction',
    ];
    protected string $models_path = '';
    protected string $resources_path = '';
    protected string $stubs_path = '';

    protected array $resources = [
        'LeadResource',
        'LeadSpamBlackListResource',
        'LeadConfigurationResource',
    ];
    protected array $default_configuration = [
        'check_html',
        'check_links',
        'check_black_list',
        'check_ip',
    ];

    public function handle(): int
    {
        $this->stubs_path = __DIR__ . '/../../resources/stubs/';
        $this->models_path = app_path('Models/');
        $this->resources_path = app_path('Filament/Resources/');

        if ($this->confirm('This command will install Linter Leads, it will populate the database with the default configuration and the blacklisted words. Do you wish to continue?')) {
            $blacklist = json_decode(file_get_contents($this->stubs_path.'blacklist.json'), true);
            foreach ($blacklist as $word) {
                \Pardalsalcap\LinterLeads\Models\LeadSpamBlackList::firstOrCreate([
                    'slug' => \Illuminate\Support\Str::slug($word),
                ], [
                    'word' => $word,
                    'is_active' => true,
                ]);
            }
        }



        if ($this->confirm('Do you wish to populate the configuration table?')) {
            foreach ($this->default_configuration as $config) {
                \Pardalsalcap\LinterLeads\Models\LeadConfiguration::firstOrCreate([
                    'parameter' => $config,
                ], [
                    'is_active' => true,
                ]);
            }
        }

        if ($this->confirm('Do you wish to copy the models?')) {
            foreach($this->models as $model)
            {
                if (!File::exists($this->models_path . $model . '.php')) {
                    File::copy($this->stubs_path . $model . '.php.stub', $this->models_path . $model . '.php');
                    $this->info($model . '.php copied successfully');
                }
                else
                {
                    $this->info($model . '.php already exists, skipping...');
                }
            }
        }

        if ($this->confirm('Do you wish to copy the Resources?')) {
            foreach ($this->resources as $resource) {
                if (!File::exists($this->resources_path . $resource . '.php')) {
                    File::copy($this->stubs_path . $resource . '.php.stub', $this->resources_path . $resource . '.php');
                    $this->info($resource . '.php copied successfully');
                }
                else
                {
                    $this->info($resource . '.php already exists, skipping...');
                }
            }
        }

        $this->comment('All done');

        return self::SUCCESS;
    }
}
