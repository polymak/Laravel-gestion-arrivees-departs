<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Modifier un Employé</h1>

        <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $employee->name }}" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Téléphone</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ $employee->phone }}" required>
            </div>
            <div class="mb-3">
                <label for="function" class="form-label">Fonction</label>
                <input type="text" id="function" name="function" class="form-control" value="{{ $employee->function }}" required>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                @if($employee->photo)
                    <img src="{{ asset('storage/' . $employee->photo) }}" alt="Photo" width="100">
                @endif
                <input type="file" id="photo" name="photo" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Mettre à Jour</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
