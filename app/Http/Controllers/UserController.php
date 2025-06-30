<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Manajemen User',
            'user' => User::all()
        ];
        return view('user.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Manajemen User',

        ];
        return view('user.tambah', $data);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    if ($request->hasFile('foto')) {
        $validated['foto'] = $request->file('foto')->store('profil', 'public');
    }

    $validated['password'] = bcrypt($validated['password']);
    $validated['role'] = 1;

    User::create($validated);

    return redirect()->route('user.index')->with('success', 'Data berhasil disimpan!');
}


    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Manajemen User',
            'user' => User::where('id', $id)->get()
        ];

        return view('user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
    
        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::delete($user->foto);
            }
            $file = $request->file('foto');
            $path = $file->store('profil', 'public');
        } else {
            $path = $user->foto;
        }
    
        $password = $request->password;
    
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'foto' => $path,
        ];
    
        if ($password != null) {
            $data['password'] = Hash::make($password);
        } else {
            $data['password'] = $user->password;
        }
    
        User::where('id', $id)->update($data);
    
        return redirect()->route('user.index')->with('success', 'Data berhasil disimpan!');
    }
    

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('user.index')->with('success', 'Data berhasil disimpan!');
    }
}
