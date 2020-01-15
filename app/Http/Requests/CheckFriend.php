<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckFriend extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'admin_name' => 'sometimes|required',
            'admin_password'  => 'sometimes|required',
            'admin_realname'  => 'sometimes|required',
            'admin_status'  => 'sometimes|required',
        ];
    }
    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'admin_name.required' => '管理员账号不能为空',
            'admin_password.required'  => '管理员密码不能为空',
            'admin_realname.required'  => '管理员真实姓名不能为空',
            'admin_status'  => '管理员状态不能为空',
        ];
    }
//    ajax返回
    public function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(response()->json([
            'code' => 500,
            'msg' => $validator->errors()->first(),
        ], 200)));
    }
}
