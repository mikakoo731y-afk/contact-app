<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'last_name'   => 'required|string|max:8',
            'first_name'  => 'required|string|max:8',
            'gender'      => 'required',
            'email'       => 'required|email',
            'tel1'        => 'required|regex:/^[0-9]+$/|max:5',
            'tel2'        => 'required|regex:/^[0-9]+$/|max:5',
            'tel3'        => 'required|regex:/^[0-9]+$/|max:5',
            'address'     => 'required',
            'categry_id' => 'required',
            'detail'      => 'required|max:120',
        ];
    }

    protected function prepareForValidation()
    {

        $this->merge([
            'tel' => $this->tel1 . $this->tel2 . $this->tel3,
        ]);
    }

    public function messages()
    {
        return [
            'last_name.required'   => '姓を入力してください',
            'last_name.max'        => '姓を入力してください',
            'first_name.required'  => '名を入力してください',
            'first_name.max'       => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',
            'tel1.required' => '電話番号を入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel3.required' => '電話番号を入力してください',
            'tel1.regex'    => '電話番号は 半角英数字で入力してください',
            'tel2.regex'    => '電話番号は 半角英数字で入力してください',
            'tel3.regex'    => '電話番号は 半角英数字で入力してください',
            'tel1.max'      => '電話番号は 5桁まで数字で入力してください',
            'tel2.max'      => '電話番号は 5桁まで数字で入力してください',
            'tel3.max'      => '電話番号は 5桁まで数字で入力してください',

            'address.required'     => '住所を入力してください',
            'categry_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required'      => 'お問い合わせ内容を入力してください',
            'detail.max'           => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
