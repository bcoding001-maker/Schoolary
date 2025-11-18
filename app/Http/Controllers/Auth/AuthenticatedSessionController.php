<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // If a redirect URL is provided (e.g. user came from guest page), send them back there
        $redirect = $request->input('redirect');

        if ($redirect) {
            return redirect()->intended($redirect);
        }

        $user = Auth::user();
        $intended = $request->session()->get('url.intended');

        // If the user is not an admin, prevent redirection to admin-only pages
        if (! $user->isAdmin() && $intended && Str::startsWith($intended, [url('/admin'), url('/dashboard')])) {
            $request->session()->forget('url.intended');
            $intended = null;
        }

        if ($user->isAdmin()) {
            return redirect()->intended(route('dashboard'));
        }

        return $intended
            ? redirect()->to($intended)
            : redirect()->route('welcome');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
