<?php

namespace App\Exceptions;

use Exception;

class InvalidContractQuery extends Exception
{
    public function __construct(){
        abort(403,
            '<p>
                Hmmm... It seems this link is invalid. Please contact us if you continue to see this error.
            </p>
            <p>
                Please contact
                    <a href="mailto:' . config('company.email.special_events') . '">' .
                        config('company.email.special_events') . '</a> for help.</p>');
    }
}
