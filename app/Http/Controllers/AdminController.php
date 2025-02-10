<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;
// use Illuminate\Container\Attributes\Auth::user();
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $dataUser = User::whereNot('id', auth()->user()->id)->get();
        return view('admin.user.index', [
            'dataUser' => $dataUser
        ]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:subscriber,author,admin'
        ]);

        User::create($request->all());
        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:subscriber,author'
        ]);

        $user = User::find($id);
        $user->update($request->all());
        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diubah');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil dihapus');
    }

    public function trash()
    {
        $userTrash = User::onlyTrashed()->get();
        return view('admin.user.trash', [
            'userTrash' => $userTrash
        ]);
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->where('id', $id);
        $user->restore();
        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil direstore');
    }

    public function destroy($id)
    {
        $user = User::onlyTrashed()->where('id', $id);
        $user->forceDelete();
        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil dihapus permanen');
    }
}
