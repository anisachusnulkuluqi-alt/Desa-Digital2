<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ContributorController extends Controller
{
    public function index(): View
    {
        $contributors = User::query()
            ->where('role', User::ROLE_CONTRIBUTOR)
            ->orderBy('name')
            ->paginate(10);

        return view('admin.kontributor.index', compact('contributors'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $contributor = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => User::ROLE_CONTRIBUTOR,
        ]);
        $contributor->markEmailAsVerified();

        return redirect()->route('admin.kontributor.index')->with('success', 'Akun kontributor berhasil ditambahkan.');
    }

    public function edit(int $id): View
    {
        $contributor = $this->findContributor($id);

        return view('admin.kontributor.edit', compact('contributor'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $contributor = $this->findContributor($id);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($contributor->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $contributor->fill([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        if (!empty($data['password'] ?? null)) {
            $contributor->password = $data['password'];
        }

        $contributor->save();

        return redirect()->route('admin.kontributor.index')->with('success', 'Akun kontributor berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->findContributor($id)->delete();

        return redirect()->route('admin.kontributor.index')->with('success', 'Akun kontributor berhasil dihapus.');
    }

    private function findContributor(int $id): User
    {
        return User::query()
            ->where('role', User::ROLE_CONTRIBUTOR)
            ->findOrFail($id);
    }
}