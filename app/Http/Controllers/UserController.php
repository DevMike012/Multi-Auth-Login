<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }
    public function index()
    {
        $user = auth()->user();
        
        if ($user->is_admin) {
            $users = User::withTrashed()->get();
            return view('admin.dashboard', compact('users'));
        }
        
        return view('user.dashboard', compact('user'));
    }
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            
            if ($user->id === auth()->id()) {
                return redirect()->route('admin.dashboard')->with('error', 'You cannot delete your own account.');
            }

            $user->deleted_by = auth()->id();
            $user->save();
            $user->delete();

            // Log the delete activity
            Activity::create([
                'user_id' => auth()->id(),
                'target_id' => $user->id,
                'type' => 'deleted',
                'description' => auth()->user()->name . ' deleted user ' . $user->name
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'User not found or could not be deleted.');
        }
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        // Log the restore activity
        Activity::create([
            'user_id' => auth()->id(),
            'target_id' => $user->id,
            'type' => 'restored',
            'description' => auth()->user()->name . ' restored user ' . $user->name
        ]);

        return redirect()->back()->with('success', 'User restored successfully.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        
        // Log the update activity
        Activity::create([
            'user_id' => auth()->id(),
            'target_id' => $user->id,
            'type' => 'updated',
            'description' => auth()->user()->name . ' updated user ' . $user->name
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully.');
    }
}