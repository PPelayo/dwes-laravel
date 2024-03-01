<x-layouts.base title="Confirmación">
    <style>
        .ticket-header{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .separator{
            width: 100%;
        }

        .ticket-title{
            margin: 5px;
        }

        .ticket {
            margin: auto;
            display: flex;
            background-color: aqua;
            width: 400px;
            height: auto;
            flex-direction: column;
            justify-content: start;
            align-items: center;
            padding: 5px;
            border: 1px solid black;
            border-radius: 32px;
            box-shadow: 5px 5px 10px gray;
        }

        .ticket-info{
            padding: 2px;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
            width: 100%;
        }

        .ticket-info-linea {
            display: flex;
            width: 100%;
            height: auto;
            justify-content: space-between;
            padding: 2px;
            box-sizing: border-box;
            gap: 10px;
        }

        .rueda{
            width: 24px;
            height: 24px;
        }

        .tipo-lavado{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            gap: 2px;
        }

        @media  (max-width: 550px) {
            .ticket {
                width: 80vw;
            }
        }

        @media (max-width: 375px) {
            .ticket{
                width: 300px;
            }
        }
    </style>

    <section class="ticket">
        <header class="ticket-header"><h2 class="ticket-title">Información</h2></header>
        <hr>

        <article class="ticket-info">
            <div class="ticket-info-linea">
                <strong>Hora de entrada:</strong><span>{{$cita->entrada}}</span>
            </div>
            <div class="ticket-info-linea">
                <strong>Hora de salida:</strong><span>{{$cita->salida}}</span>
            </div>

            <div class="ticket-info-linea">
                <strong>Nombre:</strong><span>{{$cita->nombre}}</span>
            </div>
            <div class="ticket-info-linea">
                <strong>Telefono:</strong><span>{{$cita->telefono}}</span>
            </div>
            <div class="ticket-info-linea">
                <strong>Coche:</strong><span>{{$cita->coche}}</span>
            </div>
            <div class="ticket-info-linea">
                <strong>Matricula:</strong><span>{{$cita->matricula}}</span>
            </div>
            <div class="ticket-info-linea">
                <strong>Tipo Lavado:</strong>
                <div class="tipo-lavado">
                    <span>{{$cita->tipoLavado->descripcion}}</span>
                </div>
            </div>
        </article>
        <hr class="separator">
        <footer>
            <h2>Total: <span>{{$cita->precio}}€</span></h2>
        </footer>
    </section>

</x-layouts.base>
