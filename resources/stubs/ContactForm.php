<?php

use Exception;
use Livewire\Component;
use Pardalsalcap\LinterLeads\Services\FormHandler;
use Pardalsalcap\LinterLeads\Services\Strategies\ContactFormStrategy;

class ContactForm extends Component
{
    public string $name = '';

    public string $company = '';

    public string $email = '';

    public string $phone = '';

    public string $city = '';

    public string $message = '';

    public ?int $content_id = null;

    public string $type = 'contact';

    public bool $policy = false;

    public bool $success = false;

    public bool $simple_module = false;

    public function mount(string $content = null, bool $simple = false)
    {
        if (! is_null($content)) {
            $this->content_id = $content->id;
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }

    public function submit()
    {
        $this->validate($this->rules(), $this->messages());

        try {
            $lead = [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'company' => $this->company,
                'city' => $this->city,
                'message' => $this->message,
                'data' => [],
            ];

            $formHandler = new FormHandler(new ContactFormStrategy());
            $success = $formHandler->handle($lead);

            if (! $success) {
                throw new Exception(__('linter-leads::form.error_saving_lead'));
            }
            $this->success = true;
            $this->name = '';
            $this->company = '';
            $this->email = '';
            $this->phone = '';
            $this->city = '';
            $this->message = '';
            $this->policy = false;

        } catch (\Throwable $e) {
            $this->addError('policy', $e->getMessage());
        }
    }

    public function clear()
    {
        $this->success = false;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'company' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'min:3', 'max:255'],
            'phone' => ['required', 'min:3', 'max:255'],
            'city' => ['required', 'min:3', 'max:255'],
            'message' => ['required', 'min:3', 'max:255'],
            'policy' => ['accepted'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('linter-leads::form.contact_name_required'),
            'name.min' => __('linter-leads::form.contact_name_required'),
            'name.max' => __('linter-leads::form.contact_name_required'),

            'company.required' => __('linter-leads::form.contact_company_required'),
            'company.min' => __('linter-leads::form.contact_company_required'),
            'company.max' => __('linter-leads::form.contact_company_required'),

            'email.required' => __('linter-leads::form.contact_email_required'),
            'email.min' => __('linter-leads::form.contact_email_required'),
            'email.max' => __('linter-leads::form.contact_email_required'),
            'email.email' => __('linter-leads::form.contact_email_required'),

            'phone.required' => __('linter-leads::form.contact_phone_required'),
            'phone.min' => __('linter-leads::form.contact_phone_required'),
            'phone.max' => __('linter-leads::form.contact_phone_required'),

            'city.required' => __('linter-leads::form.contact_city_required'),
            'city.min' => __('linter-leads::form.contact_city_required'),
            'city.max' => __('linter-leads::form.contact_city_required'),

            'message.required' => __('linter-leads::form.contact_message_required'),
            'message.min' => __('linter-leads::form.contact_message_required'),
            'message.max' => __('linter-leads::form.contact_message_required'),

            'policy.accepted' => __('linter-leads::form.contact_policy_accepted'),

        ];
    }
}
