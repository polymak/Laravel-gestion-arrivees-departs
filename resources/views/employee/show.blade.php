@extends('layouts.app')

@section('title', 'Profil de l\'Employé')

@section('content')
    <h1>Profil de l'Employé</h1>

    <a href="{{ route('employees.index') }}" class="btn btn-primary mb-3">Retour à la Liste</a>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $employee->name }}</h5>
            <p class="card-text">Téléphone: {{ $employee->phone }}</p>
            <p class="card-text">Fonction: {{ $employee->function }}</p>
            @if($employee->photo)
                <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}" style="width: 150px; height: 150px;">
            @else
                Pas de photo
            @endif
        </div>
    </div>
@endsection
