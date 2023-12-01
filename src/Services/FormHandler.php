<?php

namespace Pardalsalcap\LinterLeads\Services;

use Pardalsalcap\LinterLeads\Services\Strategies\FormStrategyInterface;

class FormHandler
{
    public function __construct(protected FormStrategyInterface $strategy)
    {

    }

    public function handle(array $leadData)
    {
        return $this->strategy->handle($this->mapFields($leadData, $this->strategy->mapping()));
    }

    protected function mapFields($leadData, $mappings)
    {
        $mappedData = [];
        foreach ($mappings as $formField => $dbField) {
            if (isset($leadData[$formField])) {
                $mappedData[$dbField] = $leadData[$formField];
            }
        }

        return $mappedData;
    }
}
