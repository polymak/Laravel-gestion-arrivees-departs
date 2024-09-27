<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Attendance::query()->with('employee');

        if ($request->filled('search')) {
            $query->whereHas('employee', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        // Trier par date et heure d'arrivée en ordre décroissant
        $attendances = $query->orderBy('date', 'desc')->orderBy('arrival_time', 'desc')->paginate(10);

        return view('attendances.index', compact('attendances'));
    }


    public function create()
    {
        $employees = Employee::all();
        return view('attendance.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'arrival_time' => 'required|date_format:H:i',
            'departure_time' => 'nullable|date_format:H:i',
            'date' => 'required|date',
        ]);
    
        Attendance::create($validatedData);
    
        return redirect()->route('attendances.index')->with('success', 'Présence ajoutée avec succès.');
    }
    

    public function edit(Attendance $attendance)
    {
        $employees = Employee::all();
        $attendance->date = Carbon::parse($attendance->date);
        $attendance->arrival_time = Carbon::parse($attendance->arrival_time);
        if ($attendance->departure_time) {
            $attendance->departure_time = Carbon::parse($attendance->departure_time);
        }

        return view('attendance.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'arrival_time' => 'required|date_format:H:i',
            'departure_time' => 'nullable|date_format:H:i',
            'date' => 'required|date',
        ]);
    
        $attendance->update($validatedData);
    
        return redirect()->route('attendances.index')->with('success', 'Présence mise à jour avec succès.');
    }
    
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendances.index')->with('success', 'Présence supprimée avec succès.');
    }
}
