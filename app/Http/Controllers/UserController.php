<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Alert;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('role', 'asc')->orderBy('name', 'asc')->get();
        $jumlah = $users->count();

        if ($jumlah == 0) {
            Alert::info('Data Kosong', 'Data users masih kosong');
        }
        return view('user.index', ['users' => $users]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\Models\User,email'],
            'role' => ['required', 'string',],
            'password' => ['required', 'confirmed', 'min:8',],
            'nim' => ['max:14', ],
            'jurusan' => ['max:255'],
            'kelas' => ['max:5',],
            'fakultas' => ['max:255'],
            'nidn' => ['max:10', ],
        ]
        );

        // Pengiriman data
        $user = new User;
        $hash_password = Hash::make($request->password);

        $nama_baru = ucwords(strtolower($request->name));
        $jurusan_baru = ucwords(strtolower($request->jurusan));
        $kelas_baru = strtoupper($request->kelas);
        $fakultas_baru = ucwords(strtolower($request->fakultas));


        $user->name = $nama_baru;
        $user->email = $request->email;
        $user->role = strtolower($request->role);
        $user->password = $hash_password;
        $user->nim = $request->nim;


        if ($request->role == 'dosen') {
            $user->slug = $request->nidn;
        } else {
            $user->slug = $request->nim;
        }

        $user->jurusan = $jurusan_baru;
        $user->kelas = $kelas_baru;
        $user->fakultas = $fakultas_baru;
        $user->nidn = $request->nidn;

        $user->save();

        toast('User ' . $user->name . ' berhasil ditambahkan', 'success');

        return redirect('/users');
    }

    public function show(User $user)
    {
        return view('user.profile', ['user' => $user]);
    }

    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'jurusan' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:5', 'min:5'],
            'fakultas' => ['required', 'string', 'max:255']
        ]);


        $nama_baru = ucwords(strtolower($request->name));
        $jurusan_baru = ucwords(strtolower($request->jurusan));
        $kelas_baru = strtoupper($request->kelas);
        $fakultas_baru = ucwords(strtolower($request->fakultas));
        $user->name = $nama_baru;
        $user->jurusan = $jurusan_baru;
        $user->kelas= $kelas_baru;
        $user->fakultas = $fakultas_baru;
        $user->update();

        toast('Profile berhasil diupdate', 'success');

        return redirect('/users/'.$user->nim);
    }

    public function destroy(User $user)
    {
        $user->delete();
        toast('User ' . $user->name . ' berhasil dihapus', 'success');
        return redirect('/users');
    }
}
