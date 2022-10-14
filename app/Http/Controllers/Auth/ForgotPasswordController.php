<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Jobs\ForgotPasswordJob;
use App\Queries\UserBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;

class ForgotPasswordController extends Controller
{
    public function show(): Application|Factory|View
    {
        return view('front.auth.forgot');
    }

    public function update(ForgotPasswordRequest $request, UserBuilder $builder): RedirectResponse
    {
        $user = $builder->getUserByEmail($request->email);
        $url = URL::to('/') . bcrypt('reestablish');

        dispatch(new ForgotPasswordJob($user, $url));

        return back()->with('message', 'Вам на почту отправлено письмо');
    }
}
