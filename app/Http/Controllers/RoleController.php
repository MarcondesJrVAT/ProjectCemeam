<?php

namespace App\Http\Controllers;

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
            'search' => request()->search,
            'sort' => request()->sort ?? 'id',
            'sortDir' => request()->sortDir ?? 'asc',
            'roles' => Role::query()
                ->when(request()->search, fn($q) => $q->where('name', 'LIKE', '%' . request()->search . '%'))
                ->when(request()->sort, fn($q) => $q->orderBy(request()->sort, request()->sortDir))
                ->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Roles/Create');
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
        dd([$request, $id]);
        $role = Role::query()->find($id);
        if (!$role) {
            return Redirect::back()->with('error', 'Permissão não encontrada.!');
        }
        $role->delete();
        return  Redirect::route('roles.index')->with('success', 'Permissão excluída com sucesso.');
    }
}
