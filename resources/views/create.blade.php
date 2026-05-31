<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medicos</title>
</head>
<body>
    <h1>Nuevo registro</h1>
    <form action="{{ route('medicos.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="especialidad">Especialidad:</label>
        <input type="text" id="especialidad" name="especialidad" required><br><br>

        <label for="fnac">Fecha de nacimiento:</label>
        <input type="date" id="fnac" name="fnac" required><br><br>

        <label for="aniotituto">A&ntilde;o de titulacion:</label>
        <input type="number" id="aniotituto" name="aniotituto" required><br><br>

        <label for="celular">Celular:</label>
        <input type="text" id="celular" name="celular" required><br><br>

        <label for="foto">Foto (URL):</label>
        <input type="url" id="foto" name="foto" placeholder="https://ejemplo.com/foto.jpg"><br><br>

        <button type="submit">Guardar</button>
    </form>
    <br>
    <a href="{{ route('medicos.index') }}">Volver a la lista</a>
</body>
</html>
