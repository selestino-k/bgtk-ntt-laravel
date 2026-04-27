<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next): Response
    {
        $nonce = base64_encode(random_bytes(16));
        view()->share('cspNonce', $nonce);

        $response = $next($request);

        // Vite HMR requires localhost connections in local development
        $connectSrc = "'self'";
        if (app()->environment('local')) {
            $connectSrc .= ' ws://localhost:* http://localhost:*';
        }

        $directives = [
            "default-src 'self'",
            "script-src 'self' 'nonce-{$nonce}' https://cdn.jsdelivr.net",
            "style-src 'self' 'nonce-{$nonce}' https://fonts.googleapis.com https://fonts.bunny.net https://cdn.jsdelivr.net",
            "font-src 'self' https://fonts.gstatic.com https://fonts.bunny.net https://cdn.jsdelivr.net",
            "img-src 'self' data: blob:",
            "connect-src {$connectSrc}",
            "frame-ancestors 'none'",
            "base-uri 'self'",
            "form-action 'self'",
            "object-src 'none'",
        ];

        if (! app()->environment('local')) {
            $directives[] = "upgrade-insecure-requests";
        }

        $response->headers->set(
            'Content-Security-Policy',
            implode('; ', $directives)
        );

        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');

        // Ensure all Set-Cookie headers carry the HttpOnly flag
        $cookies = $response->headers->all('set-cookie');
        if ($cookies) {
            $response->headers->remove('set-cookie');
            foreach ($cookies as $cookie) {
                if (stripos($cookie, 'httponly') === false) {
                    $cookie .= '; HttpOnly';
                }
                $response->headers->set('set-cookie', $cookie, false);
            }
        }

        return $response;
    }
}
