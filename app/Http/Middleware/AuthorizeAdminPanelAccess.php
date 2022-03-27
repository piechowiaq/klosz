<?php

namespace App\Http\Middleware;

use App\Domains\User\Models\User;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthorizeAdminPanelAccess
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->getUser()->isSuperAdmin()) {

            return $next($request);

        }

        abort(ResponseAlias::HTTP_UNAUTHORIZED);
    }

    private function getUser(): User
    {
        $user = Auth::user();

        assert($user instanceof User);

        return $user;
    }
}
