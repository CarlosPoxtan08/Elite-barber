<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;

class AttemptToAuthenticate
{
    protected $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function handle($request, $next)
    {
        $user = User::where(Fortify::username(), $request->{Fortify::username()})->first();

        if ($user && $user->trashed()) {
            throw ValidationException::withMessages([
                Fortify::username() => ['Esta cuenta ha sido desactivada.'],
            ]);
        }

        if (Fortify::$authenticateUsingCallback) {
            return $this->handleUsingCustomCallback($request, $next);
        }

        if (
            $this->guard->attempt(
                $request->only(Fortify::username(), 'password'),
                $request->boolean('remember')
            )
        ) {
            return $next($request);
        }

        $this->throwFailedAuthenticationException($request);
    }

    protected function handleUsingCustomCallback($request, $next)
    {
        $user = call_user_func(Fortify::$authenticateUsingCallback, $request);

        if (!$user) {
            $this->throwFailedAuthenticationException($request);
        }

        $this->guard->login($user, $request->boolean('remember'));

        return $next($request);
    }

    protected function throwFailedAuthenticationException($request)
    {
        throw ValidationException::withMessages([
            Fortify::username() => [trans('auth.failed')],
        ]);
    }
}
