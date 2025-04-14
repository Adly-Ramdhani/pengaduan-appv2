<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
    
        $user = Auth::user();
    
        // Tambahkan log untuk debugging
        \Log::info("User yang login:", ['id' => $user->id, 'role' => $user->role]);
        \Log::info("Role yang diperlukan:", ['required_role' => $role]);
    
        // Gunakan strtolower() agar tidak ada error perbedaan huruf kapital
        if (strtolower($user->role) !== strtolower($role)) {
            \Log::warning("Akses ditolak untuk user:", [
                'id' => $user->id,
                'role' => $user->role,
                'required' => $role
            ]);
            return abort(403, 'Akses ditolak.');
        }
    
        return $next($request);
    }
}
