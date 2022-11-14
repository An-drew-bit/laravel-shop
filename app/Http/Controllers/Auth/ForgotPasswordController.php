<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Jobs\ForgotPasswordJob;
use Domain\User\Models\User;
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

    public function update(ForgotPasswordRequest $request): RedirectResponse
    {
        $user = User::getByEmail($request->email);
        $url = url('/') . bcrypt('reestablish');

        dispatch(new ForgotPasswordJob($user, $url));

        flash()->info('Вам на почту отправлено письмо');

        return back();
    }
}
