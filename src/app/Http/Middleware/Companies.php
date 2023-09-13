<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\Api\Account\EloquentAccountRepository;
use App\Services\Api\Account\AccountService;
use App\Services\Api\MediaFile\MediaFileService;

class Companies
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $accountService = new AccountService(new EloquentAccountRepository, new MediaFileService);
        if ($accountService->getCurrentCompanyID() != null) {
            return $next($request);
        }
        return response()->json(['error' => 'Access denied.'], 403);
    }
}
