<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use function Laravel\Prompts\search;

class UserController extends Controller
{

    public function index()
    {
        request()->validate([
           'sortDir' => ['nullable', 'in:asc,desc'],
           'sort' => ['nullable', 'in:id,name,email'],
        ]);

        return Inertia::render('Users/Index', [
            'search' => request()->search,
            'sort' => request()->sort ?? 'id',
            'sortDir' => request()->sortDir ?? 'asc',
            'users' => User::query()
            ->when(request()->search, fn($q) => $q->where('name', 'LIKE', '%' . request()->search . '%'))
            ->when(request()->sort, fn($q) => $q->orderBy(request()->sort, request()->sortDir))
            ->paginate(10),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Users/Create');
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
        $user = User::query()->find($id);

        if (!$user) {
            return Redirect::back()->with('error', 'Usuário não encontrado.');
        }

        $user->delete();

        return Redirect::route('users.index')->with('success', 'Usuário excluído com sucesso.');
    }
}
