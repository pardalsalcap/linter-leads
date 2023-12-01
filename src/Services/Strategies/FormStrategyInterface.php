<?php

namespace Pardalsalcap\LinterLeads\Services\Strategies;

interface FormStrategyInterface
{
    public function handle(array $formData);

    public function standardizeFormData($formData);

    public function processData($data);

    public function mapping(): array;
}
