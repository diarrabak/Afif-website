<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //We can get all users with User::get() or we can use the paginate function specify the number of objects per page
        $users = User::paginate(20);  //Get all users (20 per page)
        return view('users.index')
            ->with('users', $users);  //Send the users to the users/index view for browser rendering
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get()->pluck('name', 'id');
        return view('users.create')
            ->with('roles', $roles)
            ->with('user', (new User()));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Validation of all the fields of a user before registration
        $validatedUser = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'title' => ['required', 'string', 'max:255'],
            'biography' => ['required', 'string'],
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        //Use the validated inputs for registration in the database

        $fileName = $validatedUser['picture']->getClientOriginalName(); //$request->picture->getClientOriginalName();
        $validatedUser['picture']->storeAs('images', $fileName, 'public');  //$request->picture->storeAs('images', $fileName, 'public');  //Store the user picture and use the path for display
        $user = new User([  //Passing the form data to the user object
            "name" => $validatedUser['name'], //$request->get('name'),
            "email" => $validatedUser['email'], //$request->get('email'),
            "title" => $validatedUser['title'], //$request->get('title'),
            "biography" => $validatedUser['biography'], //$request->get('biography'),
            "picture" => $fileName,
            'password' => Hash::make($validatedUser['password']), //),

        ]);

        $user->save(); // Finally, save the user.
        $user->roles()->attach($request->get('roles'));

        return redirect()->action([UserController::class, 'index']); //Redirect to the index page
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //Pass the current element to the show view for rendering
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //Get all departments and academic groups in key pairs of name and id
        $roles = Role::get()->pluck('name', 'id');
        $currentRoles = $user->roles;
        $ids = [];
        foreach ($currentRoles as $role) {
            $ids[] = $role->id;
        }

        // The above data are sent to the edit view
        return view('users.edit')
            ->with('roles', $roles)
            ->with('ids', $ids)
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //Validate all the required field as at the creation
        $validatedUser = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,:id'],  //We could use 'unique:users,'.$this->id
            'title' => ['required', 'string', 'max:255'],
            'biography' => ['required', 'string'],
        ]);

        //Validate the picture field only if it is not empty. Use the saved picture otherwise
        if ($request->has('picture') && !empty($request->picture)) {
            $validatedImg = $request->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);

            $fileName = $validatedImg['picture']->getClientOriginalName(); //$request->picture->getClientOriginalName();
            $validatedImg['picture']->storeAs('images', $fileName, 'public');  //$request->picture->storeAs('images', 
        }
        //Validate the password field only if it is not empty. Use the saved password otherwise
        if ($request->has('password') && !empty($request->password)) {
            $validatedPwd = $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }


        //Transfer the form data to the current user
        // $user->fill($request->input());
        $user->fill(array(
            "name" => $validatedUser['name'], //$request->get('name'),
            "email" => $validatedUser['email'], //$request->get('email'),
            "title" => $validatedUser['title'], //$request->get('title'),
            "biography" => $validatedUser['biography'], //$request->get('biography'),
            "picture" => $request->has('picture') ?  $fileName : $user->picture,
            'password' => ($request->has('password') && !empty($request->password)) ? Hash::make($validatedPwd['password']) : $user->password, //
        ));
        //Save the user and go to index page
        $user->save();
        $user->roles()->detach();
        $user->roles()->attach($request->get('roles'));

        return redirect()->action([UserController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::where('id', $user->id)->delete();
        return redirect()->action([UserController::class, 'index']);
    }
}
