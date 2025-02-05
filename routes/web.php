<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});

// Redirect to GitHub
Route::get('/auth/github', function () {
    return Socialite::driver('github')->redirect();
});

// Handle callback
Route::get('/auth/github/callback', function () {
    $githubUser = Socialite::driver('github')->user();

    // Find or create user in database
    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return 'Welcome to your dashboard, ' . Auth::user()->name;
})->middleware('auth');
