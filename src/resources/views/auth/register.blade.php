@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('header__button')
<nav>
    <form action="/login" method="get">
        <button class="header-action header-action--login" type="submit">login</button>
    </form>
</nav>
@endsection

@section('content')
<div class="page-heading">
    <h2 class="page-heading__title">Register</h2>
</div>
<div class="register-form__content">
    <form class="form" action="/register" method="post" novalidate>
        @csrf
        <div class="form__group">
            <div class="form__label">
                <span class="form__label-text">お名前</span>
            </div>
            <div class="form__control">
                <input class="form__text-input" type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田　太郎" />
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
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
            <button class="form__button-submit" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection
