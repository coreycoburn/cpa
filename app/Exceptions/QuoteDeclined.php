<?php

namespace App\Exceptions;

use Exception;

class QuoteDeclined extends Exception
{
    public function __construct()
    {
        abort(403,
            '<p>
                This quote was previously marked as <span class="text-red-dark">no longer interested</span>. Please contact <a href="mailto:' . config('company.email.special_events') . '">' .
                        config('company.email.special_events') . '</a>
                         for more information.
            </p>');
    }
}
