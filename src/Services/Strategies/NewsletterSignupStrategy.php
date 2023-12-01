<?php

namespace Pardalsalcap\LinterLeads\Services\Strategies;

class NewsletterSignupStrategy implements FormStrategyInterface
{
    protected string $source = 'newsletter';
    public function handle(array $formData)
    {
        // Handle newsletter signup specific logic
    }

    public function standardizeFormData($formData)
    {
        // Implement your logic to standardize the form data
        // For example, renaming fields, formatting phone numbers, etc.
        return $formData;
    }

    public function processData($data)
    {
        // Implement the logic to process (e.g., save to database)
        // This can be saving the data to a leads model, sending emails, etc.
    }

    public function mapping(): array
    {
        return config('linter-leads.mappings.'.$this->source);
    }
}
