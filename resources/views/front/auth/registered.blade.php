@extends('front.layouts.auth.layout')

@section('title', 'Регистрация')

@section('content')
    <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
        <h1 class="mb-5 text-lg font-semibold">Регистрация</h1>
        <form class="space-y-3" method="post" action="{{ route('registered.store') }}">
            @csrf

            <x-forms.text-input
                type="text"
                name="name"
                placeholder="Имя и фамилия"
                :isError="$errors->has('name')">
            </x-forms.text-input>

            @error('name')
                <x-forms.error>{{ $message }}</x-forms.error>
            @enderror

            <x-forms.text-input
                type="email"
                name="email"
                placeholder="E-mail"
                :isError="$errors->has('email')">
            </x-forms.text-input>

            @error('email')
                <x-forms.error>{{ $message }}</x-forms.error>
            @enderror

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <x-forms.text-input
                        type="password"
                        name="password"
                        placeholder="Пароль"
                        :isError="$errors->has('password')">
                    </x-forms.text-input>

                    @error('password')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
                <div>
                    <x-forms.text-input
                        type="password"
                        name="password_confirmation"
                        placeholder="Повторите пароль"
                        :isError="$errors->has('password_confirmation')">
                    </x-forms.text-input>

                    @error('password_confirmation')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
            </div>

            <x-forms.primary-button>Зарегистрироваться</x-forms.primary-button>
        </form>
        <div class="space-y-3 mt-5">
            <div class="text-xxs md:text-xs">Есть аккаунт?
                <a href="{{ route('login') }}"
                   class="text-white hover:text-white/70 font-bold underline underline-offset-4">Войти</a>
            </div>
        </div>

        @include('front.templates.politics')
    </div>
@endsection
