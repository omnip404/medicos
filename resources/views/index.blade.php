<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medicos</title>
</head>
<body>
    <h1>Lista de Medicos</h1>
    <a href="{{ route('medicos.create') }}">Nuevo Medico</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Especialidad</th>
                <th>A&ntilde;o de Titulacion</th>
                <th>Foto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicos as $medico)
                <tr>
                    <td>{{ $medico->id }}</td>
                    <td>{{ $medico->nombre }}</td>
                    <td>{{ $medico->especialidad }}</td>
                    <td>{{ $medico->aniotituto }}</td>
                    <td>
                        @if($medico->foto)
                            <img src="{{ $medico->foto }}" alt="Foto" width="50">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('medicos.show', $medico->id) }}">Detalles</a>
                        <form action="{{ route('medicos.destroy', $medico->id) }}" method="POST" style="display: inline;">
                            @method('DELETE')
                            @csrf
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
