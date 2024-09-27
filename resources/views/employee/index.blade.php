@extends('layouts.app')

@section('title', 'Liste des Employés')

@section('content')
    <h1>Liste des Employés</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulaire de recherche -->
    <form action="{{ route('employees.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par nom" value="{{ request()->input('search') }}">
            <button class="btn btn-primary" type="submit">Rechercher</button>
        </div>
    </form>

    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Ajouter un Employé</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Fonction</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->function }}</td>
                    <td>
                        @if($employee->photo)
                        <img src="{{ asset('storage/' . $employee->photo) }}" alt="Photo de l'employé" style="width: 50px; height: 50px;">
                    @else
                        Pas de photo
                    @endif
                    
                    </td>
                    <td>
                        <!-- Bouton Voir le Profil -->
                        <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">Voir le Profil</a>
                        <!-- Boutons Modifier et Supprimer -->
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucun employé trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Affichage des liens de pagination -->
    {{ $employees->links() }}
@endsection
