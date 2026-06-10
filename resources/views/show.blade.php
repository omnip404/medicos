@extends('layouts.master')
@section('title', 'Detalles de Medico')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <h1 class="h3 mb-0">
            <i class="fas fa-user-md me-2 text-info"></i>Detalles de Medico
        </h1>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('medicos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Volver
            </a>
            <form action="{{ route('medicos.destroy', $medico->id) }}" method="POST" class="d-inline">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar este medico?')">
                    <i class="fas fa-trash me-1"></i>Eliminar
                </button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center mb-3 mb-md-0">
                    @if($medico->foto)
                        <img src="{{ $medico->foto }}" alt="Foto" class="img-fluid rounded shadow-sm" style="max-height: 250px;">
                    @else
                        <i class="fas fa-user-circle fa-6x text-muted"></i>
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered mb-0">
                        <tbody>
                            <tr>
                                <th class="table-info" style="width: 35%;">Nombre</th>
                                <td>{{ $medico->nombre }}</td>
                            </tr>
                            <tr>
                                <th class="table-info">Especialidad</th>
                                <td>{{ $medico->especialidad }}</td>
                            </tr>
                            <tr>
                                <th class="table-info">Fecha de Nacimiento</th>
                                <td>{{ $medico->fnac }}</td>
                            </tr>
                            <tr>
                                <th class="table-info">Año de Titulacion</th>
                                <td>{{ $medico->aniotituto }}</td>
                            </tr>
                            <tr>
                                <th class="table-info">Celular</th>
                                <td>{{ $medico->celular }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
