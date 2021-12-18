<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class SadgegrzeloRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('sadgegrzeloebi');

        return [
//            'slug' => 'required|min:2|unique:sadgegrzeloebi,slug,'.$id,
            'title' => 'required|min:2',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function all($keys = null)
    {
        $input = parent::all();

        $this->slugifyInput($input, 'slug', ['title']);

        $this->boolifyInput($input, ['visible']);

        if (! $this->filled('created_at')) {
            unset($input['created_at']);
        }

        return $input;
    }
}
