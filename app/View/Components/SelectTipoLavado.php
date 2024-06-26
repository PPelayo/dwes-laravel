<?php

namespace App\View\Components;

use App\Models\TiposLavado;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectTipoLavado extends Component
{
    /**
     * Create a new component instance.
     */

    public $selectTipo;

    public $listado;

    public function __construct($selectTipo)
    {
        $this->selectTipo = $selectTipo;
        $this->listado = TiposLavado::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-tipo-lavado');
    }
}
