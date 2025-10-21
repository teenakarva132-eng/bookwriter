<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PdfData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Dashboard
     */
    public function dashboard(){
        $userCount = User::where('role', '!=', 'admin')->count();
        $user = Auth::user();
        if ($user->is_admin) {
            // Admin user, count all PDFs
            $bookCount = PdfData::count();
        } else {
            // Regular user, count PDFs based on user ID
            $bookCount = PdfData::where('user_id', $user->id)->count();
        }
        return view('dashboard',compact('bookCount','userCount'));
    }
    public function userList()
    {
        // Retrieve paginated users excluding those with the role 'admin'
        $totalUsersCount = User::where('role', '!=', 'admin')->count();
        $users = User::where('role', '!=', 'admin')->get();
        return view('user.list', compact('totalUsersCount','users'));
    }
    /**
     * Edit User
     */
    public function editUser($id)
    {
        $user = User::findOrFail($id);

        // Add your logic for user editing

        return view('user.update', compact('user'));
    }
    /**
     * Delete User
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('customers')->with('success', 'User deleted successfully');
    }
    /**
     * Add User Controller
     */
    public function create()
    {
        return view('user.create');
    }
    /**
     * Add New User
     */
    public function addnewuser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_img' => '',
            'role' => 'user',
            'status'=> 'active',
          ]);

        // Redirect to the user list or show page
       return redirect()->route('customers')->with('success', 'User created successfully');
    }
    /**
     * Update Users 
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
          ]);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->password),
            'role' => 'user',
            'status'=> 'active',
         ]);
        return redirect()->route('customers')->with('success', 'User updated successfully');
    }

} 