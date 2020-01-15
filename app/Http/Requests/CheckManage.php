<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Route;

class CheckManage extends FormRequest
{
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
        if (Route::currentRouteName() == 'admin.config.manage_edit') {
            return [
                //
                'username' => 'sometimes|required',
                'realname'  => 'sometimes|required',
                'status'  => 'sometimes|required',
            ];
        }else{
            return [
                //
                'username' => 'sometimes|required',
                'password'  => 'sometimes|required|confirmed',
                'password_confirmation' => 'sometimes|required',
                'realname'  => 'sometimes|required',
                'status'  => 'sometimes|required',
            ];
        }
    }
    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        $id = $this->route('admin_password_confirmation','password'); //获取当前需要排除的id
        return [
            'username.required' => '管理员账号不能为空',
            'password.required'  => '管理员密码不能为空',
            'password_confirmation.required'=>'确认密码不能为空',
            'password.confirmed'=>"密码与确认密码不一致",
            'realname.required'  => '管理员真实姓名不能为空',
            'status.required'  => '管理员状态不能为空',
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
