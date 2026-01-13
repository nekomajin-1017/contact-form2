@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="page-heading">
        <h2 class="page-heading__title">Contact</h2>
    </div>
    <form class="form" action="/confirm" method="post" novalidate>
        @csrf
            <div class="form__row">
                <div class="form__label">
                    <span class="form__label-text">お名前</span>
                    <span class="form__label-required">※</span>
                </div>
                <div class="form__control">
                    <div class="form__input-group">
                        <div class="form__field">
                            <input class="form__text-input" type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}" />
                            <div class="form__error">
                                @error('last_name')
                                {{$message}}
                                @enderror
                            </div>
                        </div>
                        <div class="form__field">
                            <input class="form__text-input" type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}" />
                            <div class="form__error">
                                @error('first_name')
                                {{$message}}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form__row">
                <div class="form__label">
                    <span class="form__label-text">性別</span>
                    <span class="form__label-required">※</span>
                </div>
                <div class="form__control">
                    <div class="form__radio">
                        <input type="radio" id="male" name="gender" value="1" {{ old('gender') === '1' ? 'checked' : '' }}>
                        <label for="male">男性</label>
                        <input type="radio" id="female" name="gender" value="2" {{ old('gender') === '2' ? 'checked' : '' }}>
                        <label for="female">女性</label>
                        <input type="radio" id="others" name="gender" value="3" {{ old('gender') === '3' ? 'checked' : '' }}>
                        <label for="others">その他</label>
                    </div>
                    <div class="form__error">
                        @error('gender')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__row">
                <div class="form__label">
                    <span class="form__label-text">メールアドレス</span>
                    <span class="form__label-required">※</span>
                </div>
                <div class="form__control">
                    <input class="form__text-input" type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" />
                    <div class="form__error">
                        @error('email')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__row">
                <div class="form__label">
                    <span class="form__label-text">電話番号</span>
                    <span class="form__label-required">※</span>
                </div>
                <div class="form__control">
                    <div class="form__tel-group">
                        <div class="form__field form__field--tel">
                            <input class="form__text-input form__tel-input" type="tel" name="tel1" placeholder="090" value="{{ old('tel1') }}" />
                            <div class="form__error">
                                @error('tel1')
                                {{$message}}
                                @enderror
                            </div>
                        </div>
                        <span class="form__tel-sep">-</span>
                        <div class="form__field form__field--tel">
                            <input class="form__text-input form__tel-input" type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}" />
                            <div class="form__error">
                                @error('tel2')
                                {{$message}}
                                @enderror
                            </div>
                        </div>
                        <span class="form__tel-sep">-</span>
                        <div class="form__field form__field--tel">
                            <input class="form__text-input form__tel-input" type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}" />
                            <div class="form__error">
                                @error('tel3')
                                {{$message}}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form__row">
                <div class="form__label">
                    <span class="form__label-text">住所</span>
                    <span class="form__label-required">※</span>
                </div>
                <div class="form__control">
                    <input class="form__text-input" type="text" name="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
                    <div class="form__error">
                        @error('address')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__row">
                <div class="form__label">
                    <span class="form__label-text">建物名</span>
                </div>
                <div class="form__control">
                    <input class="form__text-input" type="text" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
                    <div class="form__error">
                        @error('building')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__row">
                <div class="form__label">
                    <span class="form__label-text">お問い合わせの種類</span>
                    <span class="form__label-required">※</span>
                </div>
                <div class="form__control">
                    <select class="form__select-field" name="category_id">
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ (string) old('category_id') === (string) $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
                        @endforeach
                    </select>
                    <div class="form__error">
                        @error('category_id')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__row">
                <div class="form__label">
                    <span class="form__label-text">お問い合わせ内容</span>
                    <span class="form__label-required">※</span>
                </div>
                <div class="form__control">
                    <textarea class="form__textarea-field" name="detail" placeholder="お問い合わせ内容をご記入ください">{{ old('detail') }}</textarea>
                    <div class="form__error">
                        @error('detail')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">確認画面</button>
            </div>
    </form>
</div>
@endsection
