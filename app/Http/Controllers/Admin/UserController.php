<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Ви не можете видалити самі себе.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Користувача видалено.');
    }
}
