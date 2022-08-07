<?php

namespace App\Http\Middleware;

use App\Domains\User\Models\User;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthorizeUserPanelAccess
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check() && Auth::user()) {

            return $next($request);

        }

        abort(ResponseAlias::HTTP_UNAUTHORIZED);

        }

    }
