<?php

namespace App\Http\Middleware;

use Closure;

class SecureHeaders
{
    // Enumerate headers which you do not want in your application's responses.
    // Great starting point would be to go check out @Scott_Helme's:
    // https://securityheaders.com/
    private $unwantedHeaderList = [
        'X-Powered-By',
        'Server',
    ];
    public function handle($request, Closure $next)
    {
        $this->removeUnwantedHeaders($this->unwantedHeaderList);
        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,PATCH,DELETE,OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type,Authorization,X-Requested-With,X-CSRF-Token');
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->headers->set('Expect-CT', 'enforce, max-age=30');
        $response->headers->set('Permissions-Policy', 'autoplay=(self), camera=(), encrypted-media=(self), fullscreen=(), geolocation=(self), gyroscope=(self), magnetometer=(), microphone=(), midi=(), payment=(), sync-xhr=(self), usb=()');
        // $response->headers->set('Content-Security-Policy', "style-src 'self'"); // Clearly, you will be more elaborate here.
        return $response;
    }
    private function removeUnwantedHeaders($headerList)
    {
        foreach ($headerList as $header)
            header_remove($header);
    }
}
