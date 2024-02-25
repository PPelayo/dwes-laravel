<?php

namespace App\View\Components;

use App\Models\Citas;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TicketConfirmacion extends Component
{
    /**
     * Create a new component instance.
     */

    public $cita;

    public function __construct($idCita)
    {
        $this->cita = Citas::findOrFail($idCita);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ticket-confirmacion');
    }
}
