@extends('layouts.admin_default')

@section('content')
<div class="admin">
    <h2 class="admin__heading">Admin Management</h2>

    <div class="search-form">
        <form action="/search" method="get">
            <div class="search-form__inner">
                <input type="text" name="keyword" placeholder="名前やメールアドレスを入力" value="{{ request('keyword') }}">

                <select name="gender">
                    <option value="">性別</option>
                    <option value="1" @selected(request('gender') == '1')>男性</option>
                    <option value="2" @selected(request('gender') == '2')>女性</option>
                    <option value="3" @selected(request('gender') == '3')>その他</option>
                </select>

                <select name="categry_id">
                    <option value="">お問い合わせの種類</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('categry_id')== $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>

                <input type="date" name="date" value="{{ request('date') }}">

                <button type="submit" class="search-form__button">検索</button>
                <a href="/reset" class="reset-button">リセット</a>
            </div>
        </form>
    </div>

    <div class="admin__sub-actions">
        <form action="/export" method="get">
            @foreach(request()->query() as $key => $value)
                @if($key !== 'id')
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endforeach
            <button type="submit" class="export-button">エクスポート</button>
        </form>

        <div class="pagination">
            {{ $contacts->appends(request()->query())->links() }}
        </div>
    </div>

    <div class="admin-table">
        <table class="admin-table__inner">
            <tr class="admin-table__header">
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
            @foreach($contacts as $contact)
            <tr class="admin-table__row">
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content }}</td>
                <td>
                    <a href="{{ request()->fullUrlWithQuery(['id' => $contact->id]) }}" class="detail-button">詳細</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@include('admin.partials.detail-modal')
@endsection
