<?php

namespace Infinety\TemplyThemeManager\Http\Middleware;

use Infinety\TemplyThemeManager\ThemeManager;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return resolve(ThemeManager::class)->authorize($request) ? $next($request) : abort(403);
    }
}
