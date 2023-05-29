<?php

namespace AshAllenDesign\ShortURL\Middleware;

use AshAllenDesign\ShortURL\Models\ShortURL;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShortURLMiddleware
{
    /**
     * Set the ShortURL instance as an attribute on the request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $shortURL = ShortURL::where('url_key', $request->route('shortURLKey'))->firstOrFail();
        $request->attributes->add(['shortURL' => $shortURL]);

        return $next($request);
    }
}
