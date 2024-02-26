<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        request()->validate([
            'sortDir' => ['nullable', 'in:asc,desc'],
            'sort' => ['nullable', 'in:id,name,email'],
        ]);
        return Inertia::render('Roles/Index', [
            'sort' => request()->sort ?? 'id',
            'sortDir' => request()->sortDir ?? 'asc',
            'roles' => Role::all(),
            'abilities' => Ability::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Página de criação de Permissões";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $role = Role::query()->find($id);

        if (!$role) {
            return Redirect::back()->with('error', 'Permissão não encontrada.');
        }

        $role->delete();

        return Redirect::route('roles.index')->with('success', 'Permissão excluído com sucesso.');
    }
}
