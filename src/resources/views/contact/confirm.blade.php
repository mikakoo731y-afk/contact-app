@extends('layouts.app')

@section('content')
<div class="contact-app">
    <div class="contact-app__content">
        <div class="contact-app__heading">
            <h2 class="confirm__heading">Confirm</h2>
    </div>
    <form class="form" action="/thanks" method="post">
        @csrf
        <table class="confirm-table">
            <tr>
                    <th>お名前</th>
                    <td>{{ $contact['last_name'] }} {{ $contact['first_name'] }}</td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>{{ $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : 'その他') }}</td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ $contact['email'] }}</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{ $contact['tel'] }}</td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>{{ $contact['address'] }}</td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td>{{ $contact['building'] }}</td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td>{{ $category->content }}</td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td>{{ $contact['detail'] }}</td>
                </tr>
            </table>
            <div class="form__button">
                <button class="form__button-submit" type="submit">送信</button>
                <a href="/" class="form__button-back">修正</a>
            </div>
            @foreach($contact as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
        </form>
    </div>
</div>
@endsection
