<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Poste</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($employees as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->position }}</td>
                <td>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <!-- Ajoutez ici un bouton de suppression si nécessaire -->
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Aucun employé trouvé.</td>
            </tr>
        @endforelse
    </tbody>
</table>
<!-- Pagination -->
<div class="mt-3">
    {{ $employees->links() }}
</div>
