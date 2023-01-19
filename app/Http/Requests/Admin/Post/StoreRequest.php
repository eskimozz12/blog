<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=> 'required|string',
            'content'=> 'required|string',
            'category_id'=> 'required|integer|exists:categories,id',
            'tag_ids'=> 'nullable|array',
            'tag_ids.*'=> 'nullable|integer|exists:tags,id'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Поле необходимо для заполнения',
            'title.string' => 'Поле должно являться строкой',
            'content.required' => 'Поле необходимо для заполнения',
            'content.string' => 'Поле должно являться строкой',
            'category_id.required' => 'Поле необходимо для заполнения',
            'category_id.integer' => 'Id категории должно быть числом',
            'category_id.exists' => 'Выбранной категории нет в базе данных',
            'tag.ids' => 'Поле необходимо для заполнения',
        ];
    }
}
