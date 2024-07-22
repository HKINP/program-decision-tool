<?php

namespace Modules\Configuration\Requests\Question;

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
        return auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      
        return [
            'question' => 'required|string|max:255',
            'stage_id' => 'required|exists:stages,id',
            'thematic_area_id' => 'nullable|exists:thematic_areas,id',
            'tag_id' => 'nullable|exists:tags,id',
            'target_group_id' => 'nullable|exists:target_groups,id',
            'updated_by' => 'nullable|exists:users,id',
        ];
    }
}
