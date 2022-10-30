<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredRequest;
use Domain\User\Actions\Contract\RegisteredContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RegisteredController extends Controller
{
    public function show(): Application|Factory|View
    {
        return view('front.auth.registered');
    }

    public function store(RegisteredRequest $request, RegisteredContract $action): RedirectResponse
    {
        // TODO перевести на DTO
        try {
            $action->handle(
                $request->get('name'),
                $request->get('email'),
                $request->get('password')
            );

            flash()->info(__('auth.success_registered'));

            return to_route('verification.notice');

        } catch (\Throwable $exception) {
            return to_route('login');
        }
    }
}
