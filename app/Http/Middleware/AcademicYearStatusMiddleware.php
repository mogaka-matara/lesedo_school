<?php

namespace App\Http\Middleware;

use App\Models\AcademicYear;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AcademicYearStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        try {
            // Update academic year statuses dynamically
            AcademicYear::updateActiveStatus();
        } catch (\Exception $e) {
            Log::error("Failed to update academic year statuses: " . $e->getMessage());
        }
        return $next($request);
    }
}
