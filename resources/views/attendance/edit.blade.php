<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Présence</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Modifier une Présence</h1>

        <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="employee_id" class="form-label">Employé</label>
                <select id="employee_id" name="employee_id" class="form-select" required>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $attendance->employee_id == $employee->id ? 'selected' : '' }}>
                            {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="arrival_time" class="form-label" style="display: none;">Heure d'Arrivée</label>
                <input type="time"  id="arrival_time" style="display: none;" name="arrival_time" class="form-control" value="{{ $attendance->arrival_time->format('H:i') }}" required>
            </div>
            <div class="mb-3">
                <label for="departure_time" class="form-label">Heure de Départ</label>
                <input type="time" id="departure_time" name="departure_time" class="form-control" value="{{ $attendance->departure_time ? $attendance->departure_time->format('H:i') : '' }}">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" id="date" name="date" class="form-control" value="{{ $attendance->date->format('Y-m-d') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à Jour</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
