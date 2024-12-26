<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Module;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;


class CheckModuleActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$moduleName): Response
    {
        $module = Module::where('name', $moduleName)->first();

        // If the module is inactive, deny access
        if ($module && !$module->is_active) {
            Log::info("Module {$module->name} is inactive, aborting request.");
            return response()->json(['error' => 'Module is deactivated.'], 403);
        }

        return $next($request);
    }
}
