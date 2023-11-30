<?php

namespace Pardalsalcap\LinterLeads\Pipelines;

use Pardalsalcap\LinterLeads\Models\Lead;
use Pardalsalcap\LinterLeads\Repositories\BlackListRepository;
use Pardalsalcap\LinterLeads\Repositories\LeadConfigurationRepository;

class EvaluateSpamPotential
{
    protected int $score = 0;
    protected LeadConfigurationRepository $repository;

    public function handle(Lead $lead, $next)
    {
        $this->repository = new LeadConfigurationRepository();
        // Evaluate the spam potential of the lead
        $this->calculate($lead);
        $lead->score = $lead->score + $this->score;

        return $next($lead);
    }

    private function calculate($lead): void
    {
        $this->evaluateLinks($lead);
        $this->evaluateBlackList($lead);
        $this->evaluateHtml($lead);
        $this->evaluateIp($lead);
    }

    protected function evaluateLinks(Lead $lead)
    {
        // Evaluate a max of links the message can contain
        if ($this->repository->getParameterStatus('check_links')) {
            $this->score += preg_match_all('/https?:\/\/\S+/i', $lead->message);
        }
    }

    public function evaluateHtml(Lead $lead)
    {
        // Evaluate if the message contains any HTML
        if ($this->repository->getParameterStatus('check_html')) {
            if ($lead->message !== strip_tags($lead->message)) {
                $this->score += 1;
            }
        }
    }

    public function evaluateBlackList(Lead $lead)
    {
        // Evaluate if the message contains any blacklisted words
        if ($this->repository->getParameterStatus('check_black_list')) {
            $repository = new BlackListRepository();
            foreach ($repository->getBlackList() as $blacklistedWord) {
                if (stripos($lead->message, $blacklistedWord->word) !== false) {
                    $this->score += 1;
                }
            }
        }
    }

    public function evaluateIp (Lead $lead)
    {
        // Check if the same IP has any spam reported messages
        if ($this->repository->getParameterStatus('check_ip')) {
            if (Lead::where('ip', $lead->ip)->where('is_spam', true)->first()) {
                $this->score += 10;
            }
        }
    }
}
/**
 * 1. Content Analysis
 * Keyword Density: High density of known spam-related keywords or phrases.
 * Link Count: Excessive number of hyperlinks in the message.
 * HTML Content: Presence of HTML tags where plain text is expected.
 * Unusual Characters: Overuse of special characters or nonsensical strings.
 * 2. Submission Patterns
 * Submission Frequency: Rapid consecutive submissions from the same IP address.
 * Session Duration: Very short duration between form view and submission, which might indicate automated submission.
 * Form Completion Time: If the form was filled out suspiciously quickly, beyond human capability.
 * 3. Source Analysis
 * IP Reputation: Check if the IP address is known for sending spam (using services like Akismet or a custom IP blacklist).
 * Geolocation Mismatch: Inconsistency between the IP geolocation and the provided location information (if relevant).
 * 4. User Behavior
 * Interaction with CAPTCHA: Failure or unusual patterns in interacting with CAPTCHA challenges.
 * Honeypot Fields: Interaction with hidden fields that should be ignored by human users.
 * Mouse and Keyboard Dynamics: Analyzing behavior can be complex but can indicate bot-like interactions (mostly applicable in sophisticated systems).
 * 5. Email Analysis
 * Email Domain Reputation: Check if the email domain is commonly associated with spam or is from a disposable email provider.
 * Syntax Irregularities: Unusual formatting or characters in the email address.
 * 6. Historical Data Analysis
 * Repeat Offenders: Increase score for IP addresses or email domains that have previously submitted spam.
 * Feedback Loop: Incorporating feedback from users or admins who manually mark leads as spam or not spam.
 */
