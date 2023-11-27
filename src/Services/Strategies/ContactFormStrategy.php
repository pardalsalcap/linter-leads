<?php

namespace Pardalsalcap\LinterLeads\Services\Strategies;

use Pardalsalcap\LinterLeads\Models\Lead;
use Exception;
use Pardalsalcap\LinterLeads\Pipelines\EvaluateSpamPotential;
use Illuminate\Support\Facades\Pipeline;

class ContactFormStrategy implements FormStrategyInterface
{
    public $source = 'contact';

    public function handle(array $leadData)
    {
        $leadData = $this->standardizeFormData($leadData);
        return $this->processData($leadData);
    }

    public function standardizeFormData($leadData)
    {
        $leadData['ip'] = request()->ip();
        return $leadData;
    }

    public function processData($leadData)
    {
        $lead = new Lead();
        $lead->fill($leadData);

        $lead = Pipeline::send($lead)
            ->through([
                EvaluateSpamPotential::class
            ])
            ->then(fn(Lead $user) => $lead);
        dd($lead);
        if (!$lead->save()) {
            throw new Exception(__("linter-leads::form.error_saving_lead"));
        }
        return $lead;
    }

    public function mapping(): array
    {
        return config("linter-leads.mappings." . $this->source);
    }
}
