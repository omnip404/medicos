@extends('layouts.master')
@section('title', 'Nuevo Medico')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <i class="fas fa-user-plus me-2 text-success"></i>Nuevo Medico
        </h1>
        <a href="{{ route('medicos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('medicos.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="especialidad" class="form-label">Especialidad</label>
                        <input type="text" id="especialidad" name="especialidad" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label for="fnac" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" id="fnac" name="fnac" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label for="aniotituto" class="form-label">Año de Titulacion</label>
                        <input type="number" id="aniotituto" name="aniotituto" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" id="celular" name="celular" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="foto" class="form-label">Foto (URL)</label>
                        <input type="url" id="foto" name="foto" class="form-control" placeholder="https://ejemplo.com/foto.jpg">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
