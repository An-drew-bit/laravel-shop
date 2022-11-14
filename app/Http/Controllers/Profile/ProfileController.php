<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\EditProfileRequest;
use Domain\User\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    public function edit(int $id): Application|Factory|View
    {
        return view('front.profile.edit-profile', [
            'user' => User::getById($id)
        ]);
    }

    public function update(EditProfileRequest $request): RedirectResponse
    {
        $user = User::getByEmail($request->email);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return to_route('home');
    }
}
