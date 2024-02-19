<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Auth\AuthContract;
use App\Contracts\Clinic\ClinicContract;
use App\Contracts\Doctor\DoctorContract;
use App\Contracts\Patient\PatientContract;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AuthController extends BaseController
{
    private $AuthContract;
    public function __construct(AuthContract $AuthContract)
    {
        $this->AuthContract = $AuthContract;
    }

    public function login(Request $request)
    {
        $this->setPageTitle('Admin Login');
        if ($request->post()) {
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required'
            ]);
            DB::beginTransaction();
            try {
                $isExits = User::where('email', $request->email)->first();
                if ($isExits != null) {
                    $userData = $request->only('email', 'password');
                    $login = auth()->attempt($userData, true);
                    if ($login) {
                        if (auth()->user()->type == 'super-admin' || auth()->user()->type == 'admin') {
                            DB::commit();
                            return $this->responseRedirect('admin.dashboard.dashboard', 'Login Successfully', 'success');
                        }
                    } else {
                        return $this->responseRedirectBack('Something went wrong ', 'false');
                    }
                } else {
                    return $this->responseRedirectBack('Something went wrong ', 'false');
                }
            } catch (\Exception $e) {
                DB::rollback();
                logger($e->getMessage() . ' -- ' . $e->getLine() . ' -- ' . $e->getFile());
                return $this->responseRedirectBack('Something went wrong', 'error', true);
            }
        }
        return view('admin.auth.login');
    }

    public function userLogin(Request $request)
    {
        $this->setPageTitle('User Login');
        // if ($request->post()) {
        //     $request->validate([
        //         'mobile_number' => 'required|exists:users,mobile_number'
        //     ]);
        //     DB::beginTransaction();
        //     try {
        //         $isExits = User::where('mobile_number', $request->mobile_number)->first();
        //         if ($isExits != null) {
        //             $login = auth()->attempt($request->mobile_number, true);
        //             if ($login) {
        //                 if (auth()->user()->type == 'user') {
        //                     DB::commit();
        //                     return $this->responseRedirect('home', 'Login Successfully', 'success');
        //                 }
        //             } else {
        //                 return $this->responseRedirectBack('Something went wrong ', 'false');
        //             }
        //         } else {
        //             return $this->responseRedirectBack('Something went wrong ', 'false');
        //         }
        //     } catch (\Exception $e) {
        //         DB::rollback();
        //         logger($e->getMessage() . ' -- ' . $e->getLine() . ' -- ' . $e->getFile());
        //         return $this->responseRedirectBack('Something went wrong', 'error', true);
        //     }
        // }
        if ($request->isMethod('post')) { // Checking if it's a POST request
            $request->validate([
                'mobile_number' => 'required|exists:users,mobile_number' // Validation rules for mobile_number
            ]);
            try {
                $user = User::where('mobile_number', $request->mobile_number)->first(); // Retrieving user by mobile number
                if ($user) {
                    // Authenticate user without password
                    auth()->login($user);
                    if (auth()->check()) { // Check if user is authenticated
                        if (auth()->user()->type == 'user') { // Checking user type
                            return $this->responseRedirect('home', 'Login Successfully', 'success');
                        }
                    } else {
                        return $this->responseRedirectBack('Authentication failed', 'error');
                    }
                } else {
                    return $this->responseRedirectBack('User not found', 'error');
                }
            } catch (\Exception $e) {
                logger($e->getMessage() . ' -- ' . $e->getLine() . ' -- ' . $e->getFile());
                return $this->responseRedirectBack('Something went wrong', 'error', true);
            }
        }

        return view('frontend.auth.login');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $this->responseRedirect('login', 'You have logged out successfully!', 'success');
        // return redirect()->route('login')
        //     ->withSuccess('You have logged out successfully!');
    }
}
