@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header__button')
<nav>
    <form action="/logout" method="post">
        @csrf
        <button class="header-action header-action--logout" type="submit">logout</button>
    </form>
</nav>
@endsection

@section('content')
<div class="admin__content">
    <div class="page-heading">
        <h2 class="page-heading__title">Admin</h2>
    </div>
    <div class="search-bar">
        <form class="search-bar__form" action="/search" method="get">
            <input class="search-bar__text" type="text" name="search_word" placeholder="名前やメールアドレスを入力してください">
            <select class="search-bar__select search-bar__select--gender" name="gender">
                <option disabled>性別</option>
                <option value="">全て</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
            </select>
            <select class="search-bar__select search-bar__select--category" name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->content }}</option>
                @endforeach
            </select>
            <input class="search-bar__date" name="date" type="date">
            <button class="btn btn--search" name="search_button" type="submit">検索</button>
        </form>
        <form action="/reset" method="get">
            <button class="btn btn--reset" type="submit">リセット</button>
        </form>
    </div>
    <div class="admin__toolbar">
        <form class="export" action="/export" method="post">
            @csrf
            <input type="hidden" name="search_word" value="{{ request('search_word') }}">
            <input type="hidden" name="gender" value="{{ request('gender') }}">
            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
            <input type="hidden" name="date" value="{{ request('date') }}">
            <button class="btn btn--export" type="submit">エクスポート</button>
        </form>
        @if ($contacts->lastPage() > 1)
        <div class="pagination">
            <a class="pagination__item {{ $contacts->onFirstPage() ? 'is-disabled' : '' }}" href="{{ $contacts->previousPageUrl() ?? '#' }}">&lt;</a>
            @for ($i = 1; $i <= $contacts->lastPage(); $i++)
                <a class="pagination__item {{ $contacts->currentPage() === $i ? 'is-active' : '' }}" href="{{ $contacts->url($i) }}">{{ $i }}</a>
                @endfor
                <a class="pagination__item {{ $contacts->hasMorePages() ? '' : 'is-disabled' }}" href="{{ $contacts->nextPageUrl() ?? '#' }}">&gt;</a>
        </div>
        @endif
    </div>
    <table class="contacts-table">
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th></th>
        </tr>
        @forelse($contacts as $contact)
        <tr>
            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
            <td>{{ $contact->gender_label }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category->content ?? '' }}</td>
            <td><a class="btn btn--detail" href="#contact-{{ $contact->id }}">詳細</a></td>
        </tr>
        @empty
        <tr>
            <td class="contacts-table__empty" colspan="5">表示できるお問い合わせはありません</td>
        </tr>
        @endforelse
    </table>
    @foreach($contacts as $contact)
    <div id="contact-{{ $contact->id }}" class="modal">
        <div class="modal__content">
            <a href="#" class="modal__close" >×</a>
            <dl class="modal__list">
                <dt>お名前</dt>
                <dd>{{ $contact->last_name }} {{ $contact->first_name }}</dd>
                <dt>性別</dt>
                <dd>{{ $contact->gender_label }}</dd>
                <dt>メールアドレス</dt>
                <dd>{{ $contact->email }}</dd>
                <dt>電話番号</dt>
                <dd>{{ $contact->tel }}</dd>
                <dt>住所</dt>
                <dd>{{ $contact->address }}</dd>
                <dt>建物名</dt>
                <dd>{{ $contact->building }}</dd>
                <dt>お問い合わせの種類</dt>
                <dd>{{ $contact->category->content ?? '' }}</dd>
                <dt>お問い合わせ内容</dt>
                <dd>{{ $contact->detail }}</dd>
            </dl>
            <form class="modal__actions" action="/delete" method="post">
                @csrf
                @method('DELETE')
                <input type="hidden" name="contact_id" value="{{ $contact->id }}">
                <button class="btn btn--delete" type="submit">削除</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
