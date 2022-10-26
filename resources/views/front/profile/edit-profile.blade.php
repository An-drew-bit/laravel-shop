@extends('front.layouts.home.layout')

@section('content')
    <main class="py-16 lg:py-20">
        <div class="container">
            <section>
                <h1 class="mb-8 text-lg lg:text-[42px] font-black text-center">Редактировать профиль</h1>

                <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
                    <form class="space-y-3" action="{{ route('profile.update') }}" method="post">
                        @csrf
                        @method('PUT')

                        <x-forms.text-input
                            type="text"
                            name="name"
                            placeholder="Имя и фамилия"
                            :isError="$errors->has('name')"
                            value="{{ $user->name }}">
                        </x-forms.text-input>

                        @error('name')
                            <x-forms.error>{{ $message }}</x-forms.error>
                        @enderror

                        <x-forms.text-input
                            type="email"
                            name="email"
                            placeholder="E-mail"
                            :isError="$errors->has('email')"
                            value="{{ $user->email }}">
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

                        <x-forms.primary-button>Сохранить</x-forms.primary-button>
                    </form>
                </div>
            </section>
        </div>
    </main>
@endsection
