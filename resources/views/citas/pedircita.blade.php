<x-layouts.base title="Hola Mundo">

    <style>
        body{
            display: flex;
            flex-direction: column;
            align-items: center;
            box-sizing: content-box;
            font-family: Arial, Helvetica, sans-serif;
            background-color: rgb(182, 244, 244);
        }
        main{
            width: 100%;
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
        }
        input{
            margin-left: 5px;
        }

        #fecha {
            width: 170px;
        }

        section{
            width: 40vw;
            height: auto;
            background-color: aqua;
            padding: 5px;
            border-radius: 12px;
            border: 1px solid black;
        }

        form{
            display: flex;
            flex-direction: column;
        }

        div{
            margin-top: 5px;
            margin-bottom: 5px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding-left: 5px;
            padding-right: 5px;
        }

        div > select{
            width: 170px;
        }

        button{
            width: 200px;
            height: 30px;
            border-radius: 32px;
            background-color:blueviolet;
            margin: 10px;
            align-self: center;
            color: black;
            font-weight: 600;
            font-size: large;
        }

        .rojo{
            color: red;
            font-size: 12px;
            align-self: end;
        }

        #lavado option{
            text-align: center;
        }
    </style>

    <header>
        <h1>Limpieza de coches EL ELEFANTE AZUL</h1>
    </header>

    <main>
        <section>
            <form action="{{ route('citas.store') }}" method="post">
                @csrf
                <div><span>Nombre:</span><input type="text" name="nombre" id="nombre" value="{{old('nombre')}}"/></div>

                <div><span>Telefono:</span><input type="tel" name="telefono" id="telefono"  value="{{old('telefono')}}"/></div>

                <div><span>Marca del vehiculo:</span><input type="text" name="marca" id="marca"  value="{{old('marca')}}"/></div>

                <div><span>Modelo:</span><input type="text" name="modelo" id="modelo"  value="{{old('modelo')}}"/></div>

                <div><span>Matricula:</span><input type="text" name="matricula" id="matricula" value="{{old('matricula')}}"/></div>
                <div><span>Tipo de lavado:</span>
                    <select name="lavado" id="lavado">
                        @foreach (TiposLavado::all() as $lavado )

                        @endforeach

                    </select>
                </div>

                <div><input type="checkbox" name="llantas" id="llantas">Limpieza de llantas (15€)</input></div>

                <div><span>Fecha:</span><input type="date" name="fecha" id="fecha" value="{{old('fecha')}}"/></div>


                <button type="submit">Realizar pedido</button>
            </form>
        </section>
    </main>

</x-layouts.base>
