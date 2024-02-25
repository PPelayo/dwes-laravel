<?php

namespace App\Rules;

use Closure;
use DateTime;
use Exception;
use Illuminate\Contracts\Validation\ValidationRule;

class FechaValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!isset($value)){
            $fail("La fecha no puede estar vacia");
            return;
        }

        try{
            $fechaActual = new DateTime();
            $fechaCliente = new DateTime($value);
            if($fechaCliente < $fechaActual) {
                $fail("La fecha no puede ser anterior a la actual");
            }
        } catch(Exception $ex){
            $fail('El formato de la fecha no es válido');
        }

    }
}
