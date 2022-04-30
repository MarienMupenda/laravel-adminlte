<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Currency;
use App\Models\User;
use App\Models\Company;
use App\Models\Contact;
use Hash;
use Auth;

class AuthController extends Controller
{
    //
    public function login()
    {
        return view('auth.login');
    }
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (auth()->user()) {

                if (auth()->user()->isSuperAdmin()) {
                    return redirect()->route('admin');
                } elseif (auth()->user()->hasActiveCompany()) {
                    return redirect()->route('dashboard');
                }
                return redirect()->route('dashboard')->with('error', Company::MESSAGE_NOT_ACTIVE);
            }

            return redirect()->route('login');
        }
        return redirect()->back()->with('error', 'Email ou mot de passe incorrect');
    }

    public function register()
    {
        $businesses = Business::orderBy('name')->get();
        $currencies = Currency::orderBy('name')->get();

        return view('auth.register-company', compact('businesses', 'currencies'));
    }


    public function postRegister(Request $request)
    {

        $data = $request->validate([
            'company' => ['required', 'string', 'max:255', 'unique:companies,name'],
            'name' => ['required', 'string', 'max:255'],
            'currency_id' => 'required|numeric',
            'phone' => 'required|string',
            'business_id' => 'required|numeric',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $company = new Company();
        $company->name = $data['company'];
        $company->currency_id = $data['currency_id'];
        $company->business_id = $data['business_id'];
        $company->save();

        $contact = new  Contact();
        $contact->whatsapp = $data['phone'];
        $contact->company_id = $company->id;
        $contact->save();


        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role_id = User::ADMIN;
        $user->company_id = $company->id;
        $user->password = Hash::make($data['password']);
        $user->save();

        $company->user_id = $user->id;
        $company->update();

        if ($user) {
            Auth::login($user);
            return redirect()->route('dashboard');
        }
        return redirect()->back()->with('error', 'Une erreur est survenue');
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
