@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="page-heading">
        <h2 class="page-heading__title">Confirm</h2>
    </div>
    <form class="form" action="/thanks" method="post">
        @csrf
        <table class="confirm-table">
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お名前</th>
                <td class="confirm-table__cell">
                    <span class="confirm-table__value">{{ $contact['last_name'] }} {{ $contact['first_name'] }}</span>
                    <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}" />
                    <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">性別</th>
                <td class="confirm-table__cell">
                    <span class="confirm-table__value">{{ $contact['gender_label'] }}</span>
                    <input type="hidden" name="gender" value="{{ $contact['gender'] }}" />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">メールアドレス</th>
                <td class="confirm-table__cell">
                    <input class="confirm-table__value" type="email" name="email" value="{{ $contact['email'] }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">電話番号</th>
                <td class="confirm-table__cell">
                    <input class="confirm-table__value" type="tel" name="tel" value="{{ $contact['tel'] }}" readonly />
                    <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}" />
                    <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}" />
                    <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}" />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">住所</th>
                <td class="confirm-table__cell">
                    <input class="confirm-table__value" type="text" name="address" value="{{ $contact['address'] }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">建物名</th>
                <td class="confirm-table__cell">
                    <input class="confirm-table__value" type="text" name="building" value="{{ $contact['building'] }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせの種類</th>
                <td class="confirm-table__cell">
                    <span class="confirm-table__value">{{ $contact['category'] ?? '' }}</span>
                    <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせ内容</th>
                <td class="confirm-table__cell">
                    <textarea class="confirm-table__value" name="detail" readonly>{{ $contact['detail'] }}</textarea>
                </td>
            </tr>
        </table>
        <div class="form__actions">
            <button class="form__button-submit" type="submit">送信</button>
            <button class="form__button-modify" type="submit" name="action" value="back" formaction="/confirm">修正</button>
        </div>
    </form>
</div>
@endsection
