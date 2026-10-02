<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ContributorController extends Controller
{
    public function index()
    {
        $kontributors = User::where('role', '!=', 'superadmin')
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.kontributor.index', compact('kontributors'));
    }

    public function store(Request $request)
    {
        // ✅ Hanya Admin yang bisa menambah user
        if (auth()->user()->role !== 'admin') {
            return back()->with('error', 'Hanya Admin yang dapat menambah kontributor!');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,kontributor'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'email_verified_at' => now(),
        ]);

        return back()->with('success', 'Kontributor berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // ✅ Kontributor tidak bisa mengubah role
        $roleRule = auth()->user()->role === 'admin' 
            ? ['required', 'in:admin,kontributor'] 
            : ['required', 'in:kontributor'];

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'role' => $roleRule,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        
        // ✅ Hanya Admin yang bisa mengubah role
        if (auth()->user()->role === 'admin') {
            $user->role = $validated['role'];
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Kontributor berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // ✅ HANYA ADMIN yang bisa hapus
        if (auth()->user()->role !== 'admin') {
            return back()->with('error', 'Akses ditolak! Hanya Admin yang dapat menghapus kontributor.');
        }

        $user = User::findOrFail($id);

        // Tidak bisa hapus akun sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        $user->delete();

        return back()->with('success', 'Kontributor berhasil dihapus!');
    }
}