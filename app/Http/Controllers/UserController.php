<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {

        $data = [
            'users' => User::where('company_id', auth()->user()->company_id)->get(),
        ];

        return view('users.index', $data)->with('title', __('Utilisateurs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('users.create')->with('title', 'Créer un nouvel utilisateur');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = 3; //Seller
        $user->company_id = Auth::user()->company_id;
        $user->password = Hash::make($request->input('password'));

        $user->save();


        return redirect(url()->previous())->with('success', __('The action ran successfully!'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', ['user' => $user, 'roles' => $roles])->with('title', $user->name);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['nullable', 'numeric'],
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role');

        if ($request->input('password') !== null) {
            $user->password = Hash::make($request->input('password'));
        }

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();

            $fileNameToStore = time() . '.' . $extension;
            $request->file('image')->storeAs(User::PROFILE_DIR, $fileNameToStore);

            $user->delete_image();
            $user->image = $fileNameToStore;
        }


        $user->update();

        return redirect(url()->previous())->with('success', __('The action ran successfully!'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(url()->previous())->with('success', __('The action ran successfully!'));

    }
}
