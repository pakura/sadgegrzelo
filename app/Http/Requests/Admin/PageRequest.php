<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class PageRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('page');

        return [
            'slug' => 'required|min:2|unique:pages,slug,'.$id,
            'title' => 'required|min:2',
            'short_title' => 'required|min:2',
            'type' => 'required',
            'type_id' => 'nullable|integer'
        ];
    }

    /**
     * Perform action before validation.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    protected function before(Validator $validator)
    {
        $validator->sometimes('type_id', 'required', function ($input) {
            return in_array($input->type, cms_pages('listable'));
        });
    }

    /**
     * {@inheritdoc}
     */
    public function all($keys = null)
    {
        $input = parent::all();

        if (! $this->filled('short_title')) {
            $input['short_title'] = $this->get('title');
        }

        $this->slugifyInput($input, 'slug', ['short_title']);

        $this->boolifyInput($input, ['visible']);

        return $input;
    }
}
