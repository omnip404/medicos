@extends('layouts.master')
@section('title', 'Lista de Medicos')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <h1 class="h3 mb-0">
            <i class="fas fa-user-md me-2 text-primary"></i>Lista de Medicos
        </h1>
        <a href="{{ route('medicos.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i>Nuevo Medico
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Especialidad</th>
                            <th>A&ntilde;o Titulacion</th>
                            <th>Foto</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($medicos as $medico)
                            <tr>
                                <td>{{ $medico->id }}</td>
                                <td>{{ $medico->nombre }}</td>
                                <td>{{ $medico->especialidad }}</td>
                                <td>{{ $medico->aniotituto }}</td>
                                <td>
                                    @if($medico->foto)
                                        <img src="{{ $medico->foto }}" alt="Foto" class="img-thumbnail" width="50" height="50">
                                    @else
                                        <span class="text-muted"><i class="fas fa-user-circle fa-2x"></i></span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('medicos.show', $medico->id) }}" class="btn btn-info btn-sm text-white me-1">
                                        <i class="fas fa-eye me-1"></i>Detalles
                                    </a>
                                    <form action="{{ route('medicos.destroy', $medico->id) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este medico?')">
                                            <i class="fas fa-trash me-1"></i>Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-user-md fa-2x mb-2 d-block"></i>
                                    No hay medicos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
