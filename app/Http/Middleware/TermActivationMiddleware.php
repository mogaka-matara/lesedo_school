<?php

namespace App\Http\Middleware;

use App\Models\Grade;
use App\Models\Term;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TermActivationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        try {
            $activeTerm = Term::getActiveTerm();

            if ($activeTerm) {
                Term::where('id', '!=', $activeTerm->id)->update(['is_active' => false]);

                $activeTerm->update(['is_active' => true]);
            } else {
                Term::query()->update(['is_active' => false]);
            }
        } catch (\Exception $e) {
            Log::error("Failed to update active terms: " . $e->getMessage());
        }


        return $next($request);
    }
}
