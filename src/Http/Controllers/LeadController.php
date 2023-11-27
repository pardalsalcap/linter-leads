<?php

namespace Pardalsalcap\LinterLeads\Http\Controllers;

use Illuminate\Http\Request;
use Pardalsalcap\LinterLeads\Services\FormHandler;
use Pardalsalcap\LinterLeads\Services\Strategies\ContactFormStrategy;
use Pardalsalcap\LinterLeads\Services\Strategies\NewsletterSignupStrategy;

class LeadController extends App\Http\Controller
{
    protected $formHandler;

    public function __construct(FormHandler $formHandler)
    {
        $this->formHandler = $formHandler;
    }

    public function store(Request $request)
    {
        // Determine the form type (e.g., from request data)
        $formType = $request->input('form_type');

        // Select the appropriate strategy
        switch ($formType) {
            case 'contact':
                $strategy = new ContactFormStrategy();
                break;
            case 'newsletter':
                $strategy = new NewsletterSignupStrategy();
                break;
                // Add more cases as needed
        }

        // Handle the form with the selected strategy
        $formHandler = new FormHandler($strategy);

        return $formHandler->handle($request);
    }
}
