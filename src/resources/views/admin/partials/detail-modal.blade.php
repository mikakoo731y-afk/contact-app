
@if($selectedContact)
<div id="detailModal" class="modal" style="display: block;">
    <div class="modal__inner">
        <a href="{{ request()->fullUrlWithQuery(['id' => null]) }}" class="modal__close">×</a>

        <table class="modal__table">
            <tr><th>お名前</th><td>{{ $selectedContact->last_name }} {{ $selectedContact->first_name }}</td></tr>
            <tr><th>性別</th><td>{{ $selectedContact->gender == 1 ? '男性' : ($selectedContact->gender == 2 ? '女性' : 'その他') }}</td></tr>
            <tr><th>メールアドレス</th><td>{{ $selectedContact->email }}</td></tr>
            <tr><th>電話番号</th><td>{{ $selectedContact->tel }}</td></tr>
            <tr><th>住所</th><td>{{ $selectedContact->address }}</td></tr>
            <tr><th>建物名</th><td>{{ $selectedContact->building }}</td></tr>
            <tr><th>お問い合わせの種類</th><td>{{ $selectedContact->category->content }}</td></tr>
            <tr><th>お問い合わせ内容</th><td>{{ nl2br(e($selectedContact->detail)) }}</td></tr>
        </table>
        <form action="/delete" method="post" class="modal__delete-form">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $selectedContact->id }}">
            <button type="submit" class="modal__delete-button">削除</button>
        </form>
    </div>
</div>
@endif