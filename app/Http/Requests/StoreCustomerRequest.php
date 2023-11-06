<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'unique:customers,email'],
            'address' => ['required'],
            'phonenumber' => ['required'],
            'name' => ['required'],
            'password' => ['required', 'min:6']
        ];
    }

    public function messages() {
        return [
            'email.required' => 'Email không được để trống!',
            'email.unique' => 'Email đã tồn tại!',
            'address.required' => 'Địa chỉ không được để trống!',
            'phonenumber.required' => 'Số điện thoại không được để trống!',
            'name.required' => 'Tên không được để trống!',
            'password.required' => 'Mật khẩu không được để trống!',
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự!'
        ];
    }
}
