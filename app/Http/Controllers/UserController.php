<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Only Admins Can See the list of users

        Gate::authorize('viewAny', User::class);

        $users = User::withCount('companies')->orderBy('name','asc')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function edit(User $user)
    {
        // Only admins can change users details or reassign roles

        Gate::authorize('update', $user);

        $roles = ['admin', 'manager', 'sales_rep'];

        return view('users.edit', compact('user', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //Only admins can update Users

        Gate::authorize('update', $user);

        $user = User::findOrFail($user->id);

        $validated = $request->validate([
            'name' => ['required', 'string','max:255'],
            'email'=> ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', 'in:admin, manager, sales_rep'],
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success','User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //Only Admins can Delete but not themselves
        Gate::authorize('delete', $user);

        $user->delete();

        return redirect()->route('users.index')->with('success','User deleted Successfully');
    }
}
