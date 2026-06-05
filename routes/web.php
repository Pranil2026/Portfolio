<?php

use App\Http\Controllers\Admin\PortfolioAdminController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index']);

// Global login route used by Laravel's auth middleware — redirect to admin login
Route::get('login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::prefix('admin')->group(function () {
    // Login routes (public)
    Route::get('login', function () {
        return view('admin.login');
    })->name('admin.login');

    Route::post('login', function (Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    })->name('admin.login.post');

    // Protected admin routes
    Route::middleware('auth')->group(function () {
        Route::get('/', [PortfolioAdminController::class, 'index'])->name('admin.dashboard');
        Route::post('settings/{section}', [PortfolioAdminController::class, 'updateSetting'])->name('admin.settings.update');

        Route::post('skills', [PortfolioAdminController::class, 'storeSkill'])->name('admin.skills.store');
        Route::put('skills/{skill}', [PortfolioAdminController::class, 'updateSkill'])->name('admin.skills.update');
        Route::delete('skills/{skill}', [PortfolioAdminController::class, 'destroySkill'])->name('admin.skills.destroy');

        Route::post('projects', [PortfolioAdminController::class, 'storeProject'])->name('admin.projects.store');
        Route::put('projects/{project}', [PortfolioAdminController::class, 'updateProject'])->name('admin.projects.update');
        Route::delete('projects/{project}', [PortfolioAdminController::class, 'destroyProject'])->name('admin.projects.destroy');

        Route::post('services', [PortfolioAdminController::class, 'storeService'])->name('admin.services.store');
        Route::put('services/{service}', [PortfolioAdminController::class, 'updateService'])->name('admin.services.update');
        Route::delete('services/{service}', [PortfolioAdminController::class, 'destroyService'])->name('admin.services.destroy');

        Route::post('testimonials', [PortfolioAdminController::class, 'storeTestimonial'])->name('admin.testimonials.store');
        Route::put('testimonials/{testimonial}', [PortfolioAdminController::class, 'updateTestimonial'])->name('admin.testimonials.update');
        Route::delete('testimonials/{testimonial}', [PortfolioAdminController::class, 'destroyTestimonial'])->name('admin.testimonials.destroy');

        // Logout
        Route::post('logout', function (Request $request) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('admin.login');
        })->name('admin.logout');
    });
});
