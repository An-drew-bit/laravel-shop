<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RemoveHeaders
{
    private array $headers = [
        'X-Powered-By',
        'Server',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        foreach ($this->headers as $header) {
            header_remove($header);

            $response->headers->remove($header);
        }

        return $response;
    }
}
