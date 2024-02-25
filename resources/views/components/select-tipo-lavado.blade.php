<select name="tipos_lavado" id="tipos_lavado">
    @foreach ($listado as $op)
    <option value="{{ $op->id}}" @selected($selectTipo == $op->id)>
        {{ $op->descripcion}}
    </option>
    @endforeach
</select>
