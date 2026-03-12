# Linter Leads

Small leads module for projects built with `pardalsalcap/linter`.

This package provides:

- Lead storage and basic lead scoring
- Spam blacklist management
- Lead configuration management
- Filament resources for managing leads from the CMS

## Compatibility

- `v3.x`: compatible with Filament 3
- `main`: compatible with Filament 5

## Installation

Install the package with Composer:

```bash
composer require pardalsalcap/linter-leads
```

Publish the config file and migrations:

```bash
php artisan vendor:publish --tag="linter-leads-config"
php artisan vendor:publish --tag="linter-leads-migrations"
```

Run the migrations:

```bash
php artisan migrate
```

Run the installation command:

```bash
php artisan linter-leads:install
```

The installation command can:

- Populate the spam blacklist
- Populate the default lead configuration
- Copy the package models to `app/Models`
- Copy the Filament resources to `app/Filament/Resources`

## Configuration

After publishing the config, you can adjust these values in [config/linter-leads.php](/Users/pardalsalcap/Development/pardalsalcap/packages/linter/linter-leads/config/linter-leads.php):

- Available lead statuses
- Field mappings for supported form types
- Notification email and name for lead management
- Spam score threshold

Default mappings included:

- `contact`: `email`, `phone`, `name`, `message`
- `newsletter`: `email`

## Typical Setup Flow

```bash
composer require pardalsalcap/linter-leads
php artisan vendor:publish --tag="linter-leads-config"
php artisan vendor:publish --tag="linter-leads-migrations"
php artisan migrate
php artisan linter-leads:install
```

## Development

Run tests:

```bash
composer test
```

Run static analysis:

```bash
composer analyse
```

## License

The MIT License (MIT). See [LICENSE.md](LICENSE.md).
