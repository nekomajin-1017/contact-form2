@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('header__button')
<nav>
    <form action="/register" method="get">
        <button class="header-action header-action--register" type="submit">register</button>
    </form>
</nav>
@endsection


@section('content')
<div class="page-heading">
    <h2 class="page-heading__title">Login</h2>
</div>
<div class="login-form__content">
    <form class="form" action="/login" method="post" novalidate>
        @csrf
        <div class="form__group">
            <div class="form__label">
                <span class="form__label-text">メールアドレス</span>
            </div>
            <div class="form__control">
                <input class="form__text-input" type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__label">
                <span class="form__label-text">パスワード</span>
            </div>
            <div class="form__control">
                <input class="form__text-input" type="password" name="password" placeholder="例: coachtech1106" />
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>
@endsection
