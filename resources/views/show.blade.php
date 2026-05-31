<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medicos</title>
</head>
<body>
    <h1>Detalles de Medico</h1>
    <table border="1">
        <tr>
            <th>Foto</th>
            <td>
                @if($medico->foto)
                    <img src="{{ $medico->foto }}" alt="Foto" width="200">
                @endif
            </td>
        </tr>
        <tr>
            <th>Nombre</th>
            <td>{{ $medico->nombre }}</td>
        </tr>
        <tr>
            <th>Especialidad</th>
            <td>{{ $medico->especialidad }}</td>
        </tr>
        <tr>
            <th>Fecha de Nacimiento</th>
            <td>{{ $medico->fnac }}</td>
        </tr>
        <tr>
            <th>A&ntilde;o de Titulacion</th>
            <td>{{ $medico->aniotituto }}</td>
        </tr>
        <tr>
            <th>Celular</th>
            <td>{{ $medico->celular }}</td>
        </tr>
    </table>
    <br>
    <a href="{{ route('medicos.index') }}">Volver a la lista</a>
    <form action="{{ route('medicos.destroy', $medico->id) }}" method="POST" style="display: inline;">
        @method('DELETE')
        @csrf
        <button type="submit">Eliminar</button>
    </form>
</body>
</html>
