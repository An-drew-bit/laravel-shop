@extends('front.layouts.home.layout')

@section('content')
    <main class="py-16 lg:py-20">
        <div class="container">

            <section>
                <!-- Section heading -->
                <h1 class="mb-8 text-lg lg:text-[42px] font-black text-center">Редактировать профиль</h1>

                <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
                    <form class="space-y-3" action="{{ route('profile.update') }}" method="post">
                        @csrf
                        @method('PUT')

                        <input type="text" name="name"
                               class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold
                               @error('name')
                                    _is-error focus:border-pink
                               @enderror"
                               value="{{ $user->name }}"
                               placeholder="Имя и фамилия">
                        @error('name')
                            <div class="mt-3 text-pink text-xxs xs:text-xs">{{ $message }}</div>
                        @enderror
                        <input type="email" name="email"
                               class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold
                               @error('email')
                                    _is-error focus:border-pink
                               @enderror"
                               value="{{ $user->email }}"
                               placeholder="E-mail">
                        @error('email')
                            <div class="mt-3 text-pink text-xxs xs:text-xs">{{ $message }}</div>
                        @enderror
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <input type="password" name="password"
                                       class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold
                                        @error('password')
                                            _is-error focus:border-pink
                                        @enderror"
                                       placeholder="Пароль">
                                @error('password')
                                    <div class="mt-3 text-pink text-xxs xs:text-xs">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <input type="password" name="password_confirmation"
                                       class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold
                                        @error('password_confirmation')
                                            _is-error focus:border-pink
                                        @enderror"
                                       placeholder="Повторно пароль">
                                @error('password_confirmation')
                                    <div class="mt-3 text-pink text-xxs xs:text-xs">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="w-full btn btn-pink">Сохранить</button>
                    </form>
                </div>

            </section>

        </div>
    </main>
@endsection
