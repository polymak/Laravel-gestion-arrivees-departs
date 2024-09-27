@extends('layouts.app')

@section('title', 'Liste des Présences')

@section('content')
    <h1>Liste des Présences</h1>

    <!-- Formulaire de recherche par nom -->
    <form method="GET" action="{{ route('attendances.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par nom d'employé" value="{{ request()->get('search') }}">
            <button class="btn btn-primary" type="submit">Rechercher</button>
        </div>
    </form>

    <!-- Formulaire de filtrage par date -->
    <form method="GET" action="{{ route('attendances.index') }}" class="mb-3">
        <div class="input-group">
            <input type="date" name="date" class="form-control" value="{{ request()->get('date') }}">
            <button class="btn btn-primary" type="submit">Filtrer par Date</button>
        </div>
    </form>

    <a href="{{ route('attendances.create') }}" class="btn btn-primary mb-3">Ajouter une Présence</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Employé</th>
                <th>Heure d'Arrivée</th>
                <th>Heure de Départ</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $attendance)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}</td>
                    <td>{{ $attendance->employee->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($attendance->arrival_time)->format('H:i') }}</td>
                    <td>{{ $attendance->departure_time ? \Carbon\Carbon::parse($attendance->departure_time)->format('H:i') : 'Non défini' }}</td>
                    <td>
                        <!-- Boutons Modifier et Supprimer -->
                        <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <!-- Formulaire de suppression -->
                        <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucune présence trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $attendances->links() }}
@endsection
