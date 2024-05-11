<?php

namespace App\Rules;

use App\Models\TiposLavado;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TipoLavadoValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(TiposLavado::where('descripcion', $value)->exists()){
            $fail('El tipo de lavado ya existe');
        }
    }
}
