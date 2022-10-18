<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\EditProfileRequest;
use App\Queries\UserBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    public function edit(UserBuilder $builder, int $id): Application|Factory|View
    {
        return view('front.profile.edit-profile', [
            'user' => $builder->getUserById($id)
        ]);
    }

    public function update(EditProfileRequest $request, UserBuilder $builder): RedirectResponse
    {
        $user = $builder->getUserById(auth()->user()->id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return to_route('home');
    }
}
