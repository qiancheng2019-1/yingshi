<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckVod extends FormRequest
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
            'pid' => 'sometimes|required',
            'type' => 'sometimes|required',
            'ad' => 'sometimes|required',
            'name' => 'sometimes|required|max:60',
            'alias' => 'sometimes|required',
            'director' => 'sometimes|required',
            'to_star' => 'sometimes|required',
            'region' => 'sometimes|required',
            'language' => 'sometimes|required',
            'release_time' => 'sometimes|required|numeric',
            'film_length' => 'sometimes|required|numeric',
            'broadcast' => 'sometimes|required|numeric',
            'score' => 'sometimes|required|numeric',
            'count_score' => 'sometimes|required|numeric',
            'thumb' => 'sometimes|required',
            'desc' => 'sometimes|required',
            'domain' => 'sometimes|required',
            'play_list' => 'sometimes|required',
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
            'pid.required' => '视频分类不能为空',
            'type.required' => '类型不能为空',
            'ad.required' => '视频广告不能为空',
            'name.required' => '名称不能为空',
            'name.max' => '名称长度不能超过60个字',
            'alias.required' => '视频别名描述能为空',
            'director.required' => '导演不能为空',
            'to_star.required' => '主演不能为空',
            'region.required' => '地区不能为空',
            'language.required' => '语言不能为空',
            'release_time.required' => '上映时间不能为空',
            'release_time.numeric' => '上映时间只能是数字',
            'film_length.required' => '片长不能为空',
            'film_length.numeric' => '片长只能是数字',
            'broadcast.required' => '总播放量不能为空',
            'broadcast.numeric' => '总播放量只能是数字',
            'score.required' => '总评分数不能为空',
            'score.numeric' => '总评分数只能是数字',
            'count_score.required' => '评分次数不能为空',
            'count_score.numeric' => '评分次数只能是数字',
            'thumb.required' => '视频封面不能为空',
            'desc.required' => '剧情介绍不能为空',
            'domain.required' => '请选择资源域名',
            'play_list.required' => '播放地址不能为空',
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
