<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar User";
        $users = User::where('role', 'pengelola')->paginate(5);
        return view('dashboard.pengaturan.pengguna.index', [
            'title' => $title,
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah User';
        return view('dashboard.pengaturan.pengguna.create', [
            'title' => $title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pengelola',
            'status' => 'active,'
        ]);

        toastr()->success('Data berhasil disimpan!');
        return redirect()->route('user.index')->with('Success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title = 'Edit User';
        return view('dashboard.pengaturan.pengguna.edit', [
            'title' => $title,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            toastr()->success('Data berhasil dihapus!');
            return redirect()->route('user.index')->with('Success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            toastr()->error('Data gagal disimpan!');
            return redirect()->route('user.index')->with('Success', 'Data berhasil dihapus');
        }
    }
}
