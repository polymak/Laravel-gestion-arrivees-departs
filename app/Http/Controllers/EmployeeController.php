<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Affiche la liste des employés avec filtrage et tri
    public function index(Request $request)
    {
        // Rechercher les employés par nom si le paramètre de recherche est fourni
        $search = $request->input('search', '');
        $employees = Employee::where('name', 'like', "%$search%")
                             ->orderBy('id', 'desc')
                             ->paginate(10);

        return view('employee.index', compact('employees'));
    }

    // Affiche le formulaire pour créer un nouvel employé
    public function create()
    {
        return view('employee.create');
    }

    // Stocke un nouvel employé dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'function' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $employee = new Employee();
        $employee->name = $request->input('name');
        $employee->phone = $request->input('phone');
        $employee->function = $request->input('function');

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $employee->photo = $photoPath;
        }

        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employé ajouté avec succès.');
    }

    // Affiche le formulaire pour modifier un employé
    public function edit(Employee $employee)
    {
        return view('employee.edit', compact('employee'));
    }

    // Met à jour les informations d'un employé
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'function' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $employee->name = $request->input('name');
        $employee->phone = $request->input('phone');
        $employee->function = $request->input('function');

        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($employee->photo && \Storage::exists('public/' . $employee->photo)) {
                \Storage::delete('public/' . $employee->photo);
            }
            $photoPath = $request->file('photo')->store('photos', 'public');
            $employee->photo = $photoPath;
        }

        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employé mis à jour avec succès.');
    }

    // Supprime un employé
    public function destroy(Employee $employee)
    {
        // Supprimer la photo si elle existe
        if ($employee->photo && \Storage::exists('public/' . $employee->photo)) {
            \Storage::delete('public/' . $employee->photo);
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employé supprimé avec succès.');
    }

    // Affiche les détails d'un employé
    public function show(Employee $employee)
    {
        return view('employee.show', compact('employee'));
    }
}
