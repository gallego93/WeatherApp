<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            $users = User::all();
                return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $user = User::create($request->all())->assignRole('user');
            return redirect()->route('users.index', $user->id)
                ->with('success', 'Registro guardado de manera exitosa!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
            $user = User::find($id);
                return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
            $user = User::find($id);
            $roles = Role::all();
            $userRoles = $user->roles->pluck('name')->toArray();
                return view('users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $user = User::find($id);
            $user->update($request->all());
            $user->syncRoles($request->input('roles', []));

        return redirect()->route('users.edit', $user->id)
            ->with('success', 'Registro modificado de manera exitosa!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            $user = User::find($id)->delete();
            return back()->with('success', 'Registro eliminado de manera exitosa!');
    }
}
