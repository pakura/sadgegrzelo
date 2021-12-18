<?php

namespace App\Http\Requests;

use Cocur\Slugify\Slugify;
use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance()->after(function ($validator) {
            if (method_exists($this, 'after')) {
                $this->after($validator);
            }
        });

        if (method_exists($this, 'before')) {
            $this->before($validator);
        }

        return $validator;
    }

    /**
     * Slugify specified input value.
     *
     * @param array $input
     * @param string $key
     * @param array $altKeys
     * @return void
     */
    protected function slugifyInput(array &$input, $key, array $altKeys = [])
    {
        if (! empty($input[$key])) {
            $input[$key] = (new Slugify)->slugify($input[$key]);
        } elseif (! empty($altKeys)) {
            $keys = [];

            foreach ($altKeys as $value) {
                $keys[] = $input[$value];
            }

            $input[$key] = (new Slugify)->slugify(implode('-', $keys));
        }
    }

    /**
     * Boolify specified input values.
     *
     * @param array $input
     * @param array $params
     * @return void
     */
    protected function boolifyInput(array &$input, array $params)
    {
        foreach ($params as $param) {
            $input[$param] = (int) $this->filled($param);
        }
    }
}
