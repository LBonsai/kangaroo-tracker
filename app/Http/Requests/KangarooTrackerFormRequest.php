<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\PositiveFloat;

/**
 * KangarooTrackerFormRequest
 *
 * @package App\Http\Requests
 * @author Lee Benedict Baniqued
 * @since 2023.07.07
 * @version 1.0
 */
class KangarooTrackerFormRequest extends FormRequest
{
    /**
     * authorize
     * Determine if the user is authorized to make this request.
     * @since 2023.07.07
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * rules
     * Get the validation rules that apply to the request.
     * @since 2023.07.07
     * @return array
     */
    public function rules() : array
    {
        return [
            'name'         => ['required', 'string', 'regex:/^[a-zA-Z\\s-]{1,50}$/', 'unique:kangaroo,name'],
            'nickname'     => ['nullable', 'string', 'regex:/^[a-zA-Z0-9\\s\-_]{0,20}$/'],
            'weight'       => ['required', new PositiveFloat],
            'height'       => ['required', new PositiveFloat],
            'gender'       => ['required', 'string', Rule::in('Male', 'Female')],
            'color'        => ['nullable', 'string', 'regex:/^[a-zA-Z\\s]{0,20}$/'],
            'friendliness' => ['nullable', 'string', Rule::in('friendly', 'not friendly')],
            'birthday'     => ['required', 'date', 'date_format:Y-m-d']
        ];
    }
}
