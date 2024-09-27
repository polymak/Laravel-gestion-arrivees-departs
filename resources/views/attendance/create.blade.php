<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrer une Présence</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Enregistrer une Présence</h1>

        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="employee_id" class="form-label">Employé</label>
                <select id="employee_id" name="employee_id" class="form-select" required>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="arrival_time" class="form-label">Heure d'Arrivée</label>
                <input type="time" id="arrival_time" name="arrival_time" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="departure_time" style="display: none;" class="form-label" style="dis">Heure de Départ</label>
                <input type="time" id="departure_time" style="display: none;" name="departure_time" class="form-control">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
