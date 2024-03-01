<x-layouts.base title="Citas Index">

<style>
body{
    font-family: Arial, Helvetica, sans-serif;
    background-color: rgb(182, 244, 244);
}

header{
    display: flex;
    margin: 10px;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

header form{
    justify-self: center;
    align-self: flex-end;
}

h1{
    flex: 1;
    align-self: center;
    font-style: italic;
    text-align: center;
}

.table-sect{
    display: flex;
    align-items: center;
    justify-content: center;
}

table, td, th{
    border: 1px solid black;
    padding: 10px;
    text-align: center;
}

table{
    border-collapse: collapse;
    padding: 10px;
    border-radius: 12px;
    border: 2px solid black;

}

th{
    background-color: aqua;
}

tr:nth-child(even){
    background-color: rgb(189, 255, 255);
}

tr:nth-child(odd){
    background-color: white;
}

tr div{
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    gap: 3px;
}

img{
    width: 24px;
    height: 24px;
}


</style>


<main>
    <section class="table-sect">
        <table>
            <thead>
                <tr>
                    <th>Entrada</th>
                    <th>Salida</th>
                    <th>Coche</th>
                    <th>Tipo Lavado</th>
                    <th>Precio</th>
                    <th>Contacto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citas as $cita)
                    <tr>
                        <td>{{$cita->entrada}}</td>
                        <td>{{$cita->salida}}</td>
                        <td>{{$cita->coche}}</td>
                        <td><div>
                            <span>{{$cita->tipoLavado->descripcion}}</span>
                            @if ($cita->llantas == 1)
                                <img src="{{asset('images/llantas.png')}}" alt="Lavado de llantas">
                            @endif
                        </div></td>
                        <td>{{$cita->precio}}</td>
                        <td>{{$cita->telefono}}</td>
                    </tr>


                @endforeach

                {{-- <?php
                //Renderizamos cada fila de la tabla
                // foreach($datos as $dato){
                //     echo '<tr>';
                //     echo '<td>'.$dato['fecha']. '</td>';
                //     echo '<td>'.$dato['entrada']. '</td>';
                //     echo '<td>'.$dato['salida']. '</td>';
                //     echo '<td><div><span>'.$dato['tipo_lavado'].'</span>'. $dato['rueda'] . '</div></td>';
                //     echo '<td>'.$dato['precio']. '</td>';
                //     echo '<td>'.$dato['contacto']. '</td>';
                //     echo '</tr>';
                // }
                ?> --}}
            </tbody>
        </table>
    </section>
</main>
</x-layouts.base>
