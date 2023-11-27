<?php

namespace Pardalsalcap\LinterLeads\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FormDataPreprocessorMiddleware
{
    public function handle($request, Closure $next)
    {
        // Retrieve all input data
        $input = $request->all();

        // Perform sanitization, validation, or formatting
        // Example: Sanitize input data
        $sanitizedInput = $this->sanitizeInput($input);

        // Replace the request's input with the sanitized data
        $request->merge($sanitizedInput);

        // Continue to the next middleware or the form handler
        return $next($request);
    }

    protected function sanitizeInput($input)
    {
        // Implement sanitization logic
        // Example: trim strings, remove unwanted characters, etc.
        return array_map('trim', $input);
    }
}
