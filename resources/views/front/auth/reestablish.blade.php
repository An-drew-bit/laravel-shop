@extends('front.layouts.auth.layout')

@section('title', 'Восстановление пароля')

@section('content')
    <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
        <h1 class="mb-5 text-lg font-semibold">Восстановление пароля</h1>
        <form class="space-y-3" method="post" action="{{ route('reestablish.reestablish') }}">
            @csrf

            <x-forms.text-input
                type="email"
                name="email"
                placeholder="E-mail"
                value="{{ request('email') }}"
                :isError="$errors->has('email')">
            </x-forms.text-input>

            @error('email')
                <x-forms.error>{{ $message }}</x-forms.error>
            @enderror

            <x-forms.text-input
                type="password"
                name="password"
                placeholder="Пароль"
                :isError="$errors->has('password')">
            </x-forms.text-input>

            @error('password')
                <x-forms.error>{{ $message }}</x-forms.error>
            @enderror

            <x-forms.text-input
                type="password"
                name="password_confirmation"
                placeholder="Повторите пароль"
                :isError="$errors->has('password_confirmation')">
            </x-forms.text-input>

            @error('password_confirmation')
                <x-forms.error>{{ $message }}</x-forms.error>
            @enderror

            <x-forms.primary-button>Восстановить</x-forms.primary-button>
        </form>
    </div>
@endsection
