<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Services\Country\CountryService;
use App\Services\Profile\ProfileService;
use App\Services\User\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    protected $userService;
    protected $profileService;
    protected $countryService;
    public function __construct(UserService $userService, ProfileService $profileService, CountryService $countryService)
    {
        $this->userService = $userService;
        $this->profileService = $profileService;
        $this->countryService = $countryService;
    }
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        $countries = Country::all();
        return Inertia::render('Auth/Register', ['countries' => $countries]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'country' => ['required', 'integer'],
            'city' => ['required', 'string'],
            'birthday' => ['required', 'date'],
        ]);

        $user = $this->userService->createUser($request);
        $this->profileService->createProfile($request, $user);
        $this->userService->assignUserRole('student', $user);

        event(new Registered($user));

        Auth::login($user);

        if ($user->hasRole('admin')) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        return redirect()->intended(route('user.dashboard', absolute: false));
    }
}
