<x-layouts.base title="Tipos de lavado">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <link href="https://cdn.datatables.net/v/dt/dt-2.0.7/datatables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/v/dt/dt-2.0.7/datatables.min.js"></script>

    <script>
        const URL_DEFAULT_DELETE = `{{ route('lavados.delete', ['id' => '_id']) }}`


        document.addEventListener('DOMContentLoaded', () => {
            const tabla = $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "lengthMenu": [5, 10, 100],
                "ajax": {
                    "url": "{{ route('lavados.getall') }}",
                    "type": "GET",
                },
                "columns": [
                    {
                        data: 'descripcion',
                        name: 'Descripción'
                    },
                    {
                        data: 'precio',
                        name: 'Precio',
                        orderable: true,
                        serchable: false
                    },
                    {
                        data: 'tiempo',
                        name: 'Tiempo',
                        orderable: true,
                        serchable: false
                    },
                    {
                        data: null,
                        name: 'Eliminar',
                        orderable: false,
                        searchable: false,
                        render : (data, type, row, meta) =>{
                            return `<button class="btn-eliminar" uuid="${row.id}">Eliminar</button>`
                        }
                    }
                ],
                'language': {
                    //Con esta url podremos descargar el archivo de idioma en español, en lugar de traducirlo manualmente
                    'url': 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                },
            });

            $('table').on('click', '.btn-eliminar', (e) => {
                const uuid = $(e.target).attr('uuid');
                 //preguntar si desea eliminar
                if(confirm('¿Estás seguro de eliminar este registro?')){
                    const url = URL_DEFAULT_DELETE.replace('_id', uuid);
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: (response) => {
                            //Forzamos la recarga de la tabla
                            tabla.ajax.reload();
                        },
                        error: (jqXHR, textStatus, errorThrown) => {
                            alert(jqXHR.responseJSON.message)
                        }
                    })
                }
            })
        })

    </script>

    <h1 style="margin:auto; text-align:center;">Tipos de Lavado</h1>

    <table id="datatable">
        <thead>
            <tr>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Tiempo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

</x-layouts.base>
