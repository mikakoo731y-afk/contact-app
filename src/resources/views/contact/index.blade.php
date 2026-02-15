@extends('layouts.app')

@section('content')
<div class="contact-app">
    <div class="contact-app__content">
        <div class="contact-app__heading">
            <h2>Contact</h2>
        </div>
        <form class="form" action="/confirm" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お名前</span><span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--name">
                        <div class="form__name-unit">
                            <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                            @error('last_name') <p class="error-msg">{{ $message }}</p> @enderror
                        </div>
                        <div class="form__name-unit">
                            <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                            @error('first_name') <p class="error-msg">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">性別</span><span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--radio">
                        <input type="radio" name="gender" id="male" value="1" {{ old('gender') == '1' ? 'checked' : '' }}>
                        <label for="male">男性</label>
                        <input type="radio" name="gender" id="female" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
                        <label for="female">女性</label>
                        <input type="radio" name="gender" id="other" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>
                        <label for="other">その他</label>
                    </div>
                    <div class="form__error">
                        @error('gender')
                            <p class="error-msg">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">メールアドレス</span><span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                    <div class="form__error">
                        @error('email')
                            <p class="error-msg">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">電話番号</span><span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--tel">
                        <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}"> -
                        <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}"> -
                        <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                    </div>
                    <div class="form__error">
                        @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                            <p class="error-msg">
                                {{ $errors->first('tel1') ?: ($errors->first('tel2') ?: $errors->first('tel3')) }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">住所</span><span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                    <div class="form__error">
                        @error('address')
                            <p class="error-msg">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">建物名</span>
                </div>
                <div class="form__group-content">
                    <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせの種類</span><span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <select name="categry_id">
                        <option value="" selected disabled>選択してください</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('categry_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form__error">
                        @error('categry_id')
                            <p class="error-msg">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせ内容</span><span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください" rows="5">{{ old('detail') }}</textarea>
                    <div class="form__error">
                        @error('detail')
                            <p class="error-msg">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">確認画面へ</button>
            </div>
        </form>
    </div>
</div>
@endsection






