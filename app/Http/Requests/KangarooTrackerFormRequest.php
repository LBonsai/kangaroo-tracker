<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

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
            'id'           => ['sometimes', 'integer'],
            'name'         => ['required', 'string', 'regex:/^[a-zA-Z\\s\-]{1,50}$/', 'unique:kangaroo,name,' . (int)Route::current()->parameter('id')],
            'nickname'     => ['nullable', 'string', 'regex:/^[a-zA-Z0-9\\s\-_]{0,20}$/'],
            'weight'       => ['required', 'regex:/^\\d{0,5}\\.\\d{1,2}$/'],
            'height'       => ['required', 'regex:/^\\d{0,5}\\.\\d{1,2}$/'],
            'gender'       => ['required', 'string', Rule::in('Male', 'Female')],
            'color'        => ['nullable', 'string', 'regex:/^[a-zA-Z\\s]{0,20}$/'],
            'friendliness' => ['nullable', 'string', Rule::in('friendly', 'not friendly')],
            'birthday'     => ['required', 'date', 'date_format:Y-m-d']
        ];
    }

    /**
     * messages
     * Set custom messages for input fields errors
     * @since 2023.07.08
     * @return array
     */
    public function messages() : array
    {
        return [
            'name.required'        => 'Please fill out this field.',
            'name.regex'           => 'Name should only contain letters, spaces, and hyphens. It must be between 1 and 50 characters long.',
            'name.unique'          => 'Name you entered already exists. Please choose a different name.',
            'nickname.regex'       => 'Nickname should only contain letters, numbers, spaces, hyphens, and underscores. It must be between 1 and 20 characters long.',
            'weight.required'      => 'Please fill out this field.',
            'weight.regex'         => 'Weight should be a positive float number with up to 5 digits before the decimal and up to 2 digits after the decimal.',
            'height.required'      => 'Please fill out this field.',
            'height.regex'         => 'Height should be a positive float number with up to 5 digits before the decimal and up to 2 digits after the decimal.',
            'gender.required'      => 'Please select an option from the dropdown menu.',
            'color.regex'          => 'Color should only contain letters and spaces. It must be between 1 and 20 characters long.',
            'birthday.required'    => 'Please choose a date from the calendar.',
            'birthday.date'        => 'The selected date is not a valid date.',
            'birthday.date_format' => 'Birthday must be in the format "YYYY-MM-DD".'
        ];
    }
}
