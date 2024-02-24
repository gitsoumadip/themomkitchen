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
use Illuminate\Support\Facades\Hash;
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

    public function userSignup(Request $request)
    {
        $this->setPageTitle('User Signup');
        if ($request->post()) {
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);
            DB::beginTransaction();
            try {
                $isCreate = User::create([
                    'name' => $request->name,
                    'mobile_number' => $request->phone,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                if ($isCreate) {
                    DB::commit();
                    return $this->responseRedirect('user.login', 'Signup Successfully', 'success');
                } else {
                    return $this->responseRedirectBack('Something went wrong ', 'false');
                }
            } catch (\Exception $e) {
                DB::rollback();
                logger($e->getMessage() . ' -- ' . $e->getLine() . ' -- ' . $e->getFile());
                return $this->responseRedirectBack('Something went wrong', 'error', true);
            }
        }
    }


    public function userLogin(Request $request)
    {
        $this->setPageTitle('User Login');
        if ($request->isMethod('post')) { // Checking if the request method is POST
            $request->validate([
                'phone' => 'required|exists:users,mobile_number', // Validation for phone number existence
                'password' => 'required' // Validation for password presence
            ]);

            DB::beginTransaction(); // Starting a database transaction
            try {
                $user = User::where('mobile_number', $request->phone)->first(); // Retrieving user by phone number

                if ($user) { // Checking if user exists
                    if ($user && Hash::check($request->password, $user->password)) {
                    //     dd($credentials);
                    // if ($credentials) { // Attempting to authenticate user
                        Auth::login($user);

                        DB::commit(); // Committing the transaction
                        return $this->responseRedirect('home', 'Login Successfully', 'success');
                    } else {
                        return $this->responseRedirectBack('Invalid phone number or password', 'error');
                    }
                } else {
                    return $this->responseRedirectBack('User does not exist', 'error');
                }
            } catch (\Exception $e) {
                DB::rollback(); // Rolling back the transaction in case of an exception
                logger($e->getMessage() . ' -- ' . $e->getLine() . ' -- ' . $e->getFile()); // Logging the exception
                return $this->responseRedirectBack('Something went wrong', 'error', true);
            }
            // }

        }
        // return view('user.auth.login');


        return view('frontend.auth.login');
    }

    // public function userLogin(Request $request)
    // {
    //     $this->setPageTitle('User Login');
    //     if ($request->post()) {
    //         dd($request->all());
    //         $request->validate([
    //             // 'email' => 'required|email|exists:users,email',
    //             'phone' => 'required',
    //             'password' => 'required'
    //         ]);
    //         DB::beginTransaction();
    //         try {
    //             $isExits = User::where('email', $request->email)->first();
    //             if ($isExits != null) {
    //                 $userData = $request->only('email', 'password');
    //                 $login = auth()->attempt($userData, true);
    //                 if ($login) {
    //                     DB::commit();
    //                     // return $this->responseRedirectBack('Login Successfully', 'success');
    //                     // return $this->responseRedirect('user.dashboard.index', 'Login Successfully', 'success');
    //                     return $this->responseRedirect('home', 'Login Successfully', 'success');
    //                 } else {
    //                     return $this->responseRedirectBack('Something went wrong ', 'false');
    //                 }
    //             } else {
    //                 return $this->responseRedirectBack('Something went wrong ', 'false');
    //             }
    //         } catch (\Exception $e) {
    //             DB::rollback();
    //             logger($e->getMessage() . ' -- ' . $e->getLine() . ' -- ' . $e->getFile());
    //             return $this->responseRedirectBack('Something went wrong', 'error', true);
    //         }
    //     }
    //     // return view('user.auth.login');


    //     return view('frontend.auth.login');
    // }
    // "name" => "admin"
    // "phone" => "1234567890"
    // "email" => "soumadiphazra00@gmail.com"
    // "password" => "123456"                                          

    // $this->setPageTitle('User Login');
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

    // if ($request->isMethod('post')) { // Checking if it's a POST request
    //     $request->validate([
    //         'mobile_number' => 'required|exists:users,mobile_number' // Validation rules for mobile_number
    //     ]);
    //     try {
    //         $user = User::where('mobile_number', $request->mobile_number)->first(); // Retrieving user by mobile number
    //         if ($user) {
    //             // Authenticate user without password
    //             auth()->login($user);
    //             if (auth()->check()) { // Check if user is authenticated
    //                 if (auth()->user()->type == 'user') { // Checking user type
    //                     return $this->responseRedirect('home', 'Login Successfully', 'success');
    //                 }
    //             } else {
    //                 return $this->responseRedirectBack('Authentication failed', 'error');
    //             }
    //         } else {
    //             return $this->responseRedirectBack('User not found', 'error');
    //         }
    //     } catch (\Exception $e) {
    //         logger($e->getMessage() . ' -- ' . $e->getLine() . ' -- ' . $e->getFile());
    //         return $this->responseRedirectBack('Something went wrong', 'error', true);
    //     }
    // }



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
