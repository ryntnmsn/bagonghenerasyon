<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request) {

        $users = User::orderBy('created_at', 'desc')
            ->when($request->search, function($query) use ($request) {
                $query->where('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
            })->paginate(20)->withQueryString();

        return Inertia::render('Admin/Users/Users', [
            'users' => $users,
            'searchTerm' => $request->search
        ]);
    }

    public function create() {
        return Inertia::render('Admin/Users/UsersCreate');
    }


    public function show($id) {
        $user = User::find($id);
        return Inertia::render('Admin/Users/UserShow', [
            'user' => $user
        ]);
    }



    public function store(Request $request) {
        $validatedData = $request->validate([
            'first_name' => ['required', 'min:2', 'max:255'],
            'last_name' => ['required', 'min:2', 'max:255'],
            'gender' => ['required'],
            'user_type' => ['required'],
            'phone_number' => ['required','min:6'],
            'email' => ['required', 'email','min:6'],
            'birth_date' => ['required'],
            'age' => ['required'],
            'username' => ['required', 'unique:users,username','min:6'],
            'password' => ['required', 'confirmed', 'min:6'],
            'avatar' => ['image', 'mimes:jpeg,png,jpg', 'max:512']
        ]);

         if($request->hasFile('avatar')) {
            $validatedData['avatar'] = Storage::disk('public')->put('images', $request->avatar);
         }

        User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'gender' => $validatedData['gender'],
            'phone_number' => $validatedData['phone_number'],
            'email' => $validatedData['email'],
            'birth_date' => $validatedData['birth_date'],
            'age' => $validatedData['age'],
            'user_type' => $validatedData['user_type'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'avatar' => $validatedData['avatar'],
            'ip' => $request->ip()
        ]); 

        return redirect()->route('users.index')->with('success', 'New user created successfully');
    }


    public function edit($id) {
        
        $user = User::find($id);
        return Inertia::render('Admin/Users/UsersEdit', [
            'user' => array_merge(
                $user->toArray(),
                [
                    'avatar_url' => $user->avatar
                        ? asset('storage/' . $user->avatar)
                        : null,
                ]
            ),
        ]);
    }


    public function update(Request $request, $id) {

        $request->validate([
            'first_name' => ['required', 'min:2', 'max:255'],
            'last_name' => ['required', 'min:2', 'max:255'],
            'gender' => ['required'],
            'user_type' => ['required'],
            'phone_number' => ['required','min:6'],
            'email' => ['required', 'email','min:6'],
            'birth_date' => ['required'],
            'username' => ['required','min:6',  Rule::unique('users', 'username')->ignore($id)],
            'password' => ['nullable', 'confirmed', 'min:6'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:512']
        ]);

        // dd($request->avatar);

        $user = User::find($id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->birth_date = $request->birth_date;
        $user->user_type = $request->user_type;
        $user->username = $request->username;

        if($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('images', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully');

    }


    public function destroy(String $id) {

    }
}
