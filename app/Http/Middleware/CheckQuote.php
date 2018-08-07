<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Contract\Declined;
use App\Http\Controllers\Contract\ParseUrl;
use Closure;

class CheckQuote
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $parsedRequest = new ParseUrl;

        $this->hasNotBeenDeclined($parsedRequest);

        $request->attributes->add(['params' => $parsedRequest->get()]);

        return $next($request);
    }

    private function hasNotBeenDeclined($parsedRequest)
    {
        new Declined($parsedRequest);

        return;
    }
}
