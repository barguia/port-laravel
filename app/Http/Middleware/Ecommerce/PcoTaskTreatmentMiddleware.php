<?php

namespace App\Http\Middleware\Ecommerce;

use App\Repositories\Ecommerce\PcoTaskRepository;
use Closure;
use Illuminate\Http\Request;
class PcoTaskTreatmentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $task = $request->route('pco_task');
        if (!$task) {
            return  response(
                [
                    'message' => 'Record not found.'
                ],
                404
            );
        }
        return $next($request);
    }
}
