<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PdfMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response->headers->get('content-type') === 'application/pdf') {
            $response->headers->set('Content-Disposition', 'inline; filename="raport.pdf"');
        }

        return $response;
    }
}
