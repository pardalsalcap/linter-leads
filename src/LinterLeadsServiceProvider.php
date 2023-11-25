<?php

namespace Pardalsalcap\LinterLeads;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Pardalsalcap\LinterLeads\Commands\LinterLeadsCommand;

class LinterLeadsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('linter-leads')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_linter-leads_table')
            ->hasCommand(LinterLeadsCommand::class);
    }
}
