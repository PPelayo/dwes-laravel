<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MatriculaValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $patron = '/^(?=.*\d{4})(?=.*[A-Za-z]{3})[A-Za-z0-9]{7}$/';
        if (!preg_match($patron, $value)) {
            $fail('La matricula no es válida.');
        }
    }
}
