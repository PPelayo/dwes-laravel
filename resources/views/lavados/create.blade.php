<x-layouts.base title="Crear Lavado">
    <style>
        h1{
            width: 100%;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: aqua;
            width: fit-content;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid black;
            margin: auto;
            gap: 10px;
        }

        .div-form{
            display: flex;
            flex-flow: column nowrap
        }

        button {
            padding: 8px;
            border-radius: 12px;
            background: #00ceca;
            color: black;
            border: 1px solid black;
            font-size: 1rem;
            cursor: pointer;
        }
        .error{
            grid-column: span 2;
            font-size: 1rem;
            color: red;
            font-style: italic;
            margin-bottom: 10px;
        }

    </style>


    <script>
        const $ = (selector) => document.querySelector(selector);
        const $$ = (selector) => Array.from(document.querySelectorAll(selector));

        function marcarErrores(data){
            if(data.isValid){
                document.getElementById('error-nombre').textContent = '';
                document.getElementById('error-precio').textContent = '';
                document.getElementById('error-tiempo').textContent = '';
                return;
            }

            document.getElementById('error-nombre').textContent = data.errors.nombre ? data.errors.nombre[0] : '';
            document.getElementById('error-precio').textContent = data.errors.precio ? data.errors.precio[0] : '';
            document.getElementById('error-tiempo').textContent = data.errors.tiempo ? data.errors.tiempo[0] : '';
        }

        function validarCampos(){
            const form = $('#form-lavados')

            const formData = new FormData(form);
                fetch("{{ route('lavados.validate') }}", {
                    method: 'POST',
                    body: formData
                }).then(res => res.json())
                .then(data => {

                    marcarErrores(data)
                    console.log(data)
                    if(data.isValid){
                        //Las validaciones son validas, por lo que podemos intentar crear un lavado
                        fetch("{{ route('lavados.store') }}", {
                            method: 'POST',
                            body: formData
                        })
                        .then(async res => res.json())
                        .then(tryCreate => {
                            marcarErrores(tryCreate)
                            if(tryCreate.isValid){
                                //El lavado a sido creado
                                // window.location.href = "";
                            }
                        })
                    }
                })

        }

        document.addEventListener('DOMContentLoaded', () => {
            const form = $('#form-lavados');

            form.addEventListener('submit', (event) => {
                event.preventDefault();
                validarCampos();
            })

            $$('input').forEach(input => {
                input.addEventListener('input', () => {
                    validarCampos()
                })
             })
        })



    </script>

    <h1>Crear lavado</h1>

    <form id="form-lavados" action="{{ route('lavados.store') }}" method="POST">
        <div class="div-form">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}">
            <span id="error-nombre" class="error"></span>
        </div>

        <div class="div-form">
            <label for="precio">Precio</label>
            <input type="number" min="0" name="precio" id="precio" value="{{ old('precio') }}">
            <span id="error-precio" class="error"></span>


        </div>

        <div class="div-form">
            <label for="tiempo">Tiempo</label>

            <input type="number" min="0" name="tiempo" id="tiempo" value="{{ old('tiempo') }}">
            <span id="error-tiempo" class="error"></span>


        </div>


        <button type="submit">Crear Lavado</button>

    </form>

</x-layouts.base>
