<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * PositiveFloat
 *
 * @package App\Rules
 * @author Lee Benedict Baniqued
 * @since 2023.07.07
 * @version 1.0
 */
class PositiveFloat implements Rule
{
    /**
     * passes
     * Determine if the validation rule passes.
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value) : bool
    {
        return is_numeric($value) && $value > 0 && is_float($value + 0);
    }

    /**
     * message
     * Get the validation error message.
     * @return string
     */
    public function message() : string
    {
        return 'The :attribute must be a positive float number.';
    }
}
