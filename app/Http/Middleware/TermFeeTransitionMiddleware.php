<?php

namespace App\Http\Middleware;

use App\Models\Student;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TermFeeTransitionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Student::where('overpayment', '>', 0)
            ->chunk(100, function ($students) {
                foreach ($students as $student) {
                    try {
                        $student->applyOverpaymentToNextTerm();
                    } catch (\Exception $e) {
                    }
                }
            });

        return $next($request);
    }
}
