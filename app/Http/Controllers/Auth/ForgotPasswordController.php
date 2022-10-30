<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Jobs\ForgotPasswordJob;
use Domain\User\Queries\UserBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ForgotPasswordController extends Controller
{
    public function show(): Application|Factory|View
    {
        return view('front.auth.lost-password');
    }

    public function update(ForgotPasswordRequest $request, UserBuilder $builder): RedirectResponse
    {
        $user = $builder->getUserByEmail($request->email);
        $url = url('/') . bcrypt('reestablish');

        dispatch(new ForgotPasswordJob($user, $url));

        return back()->with('message', 'Вам на почту отправлено письмо');
    }
}
