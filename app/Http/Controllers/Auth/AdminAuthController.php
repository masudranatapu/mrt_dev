<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\AdminLoginRequest;
use App\Http\Requests\Backend\Auth\PasswordResetRequest;
use App\Http\Requests\Backend\Profile\ResetPasswordLinkRequest;
use App\Mail\SendPasswordResetTokenMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthController extends Controller
{
    public function loginView()
    {
        try {

            if (Auth::guard('admin')->check()) {
                return redirect()->route('admin.dashboard.index');
            }

            return view('auth.login');
        } catch (\Throwable $e) {
            dd($e);
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function login(AdminLoginRequest $request)
    {
        try {

            $admin = User::query()
                ->where('email', $request->email)
                ->first();

            if (!$admin) {
                return redirect()->back()->withInput()->with([
                    'alert-type' => 'error',
                    'message' => 'The provided credentials are incorrect.',
                    'code' => Response::HTTP_NOT_FOUND
                ]);
            }
            if (in_array($admin->status, ['Inactive', 'Blocked', 'Pending'])) {
                return redirect()->back()->withInput()->with([
                    'alert-type' => 'error',
                    'message' => "Your account status is currently " . Str::lower($admin->status) . ". Please contact support for further assistance.",
                    'code' => Response::HTTP_NO_CONTENT
                ]);
            }

            if (!$admin || !Hash::check($request->password, $admin->password)) {
                return redirect()->back()->withInput()->with([
                    'alert-type' => 'error',
                    'message' => 'The provided credentials are incorrect.',
                    'code' => Response::HTTP_UNAUTHORIZED
                ]);
            }

            loginLogoutTimeTracker('Login', $admin->id);

            // Web login (session)
            Auth::guard('admin')->login($admin, $request->remember_me ?? false);

            // Login tracker
            loginLogoutTimeTracker('Login', $admin->id);

            return redirect()->route('admin.dashboard.index')->with([
                'alert-type' => 'success',
                'message' => 'Admin successfully logged in',
                'code' => Response::HTTP_OK
            ]);
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function logout(Request $request)
    {
        try {

            if (!Auth::guard('admin')->check()) {
                return redirect()->route('admin.login')->with([
                    'alert-type' => 'error',
                    'message' => 'No authenticated admin user',
                    'code' => Response::HTTP_UNAUTHORIZED
                ]);
            }

            $user = Auth::guard('admin')->user();

            // Track logout time
            loginLogoutTimeTracker('Logout', $user->id);

            Auth::guard('admin')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')->with([
                'alert-type' => 'success',
                'message' => 'Admin successfully logged out',
            ]);
        } catch (\Throwable $e) {
            return redirect()->route('admin.login')->with([
                'alert-type' => 'error',
                'message' => 'Logout failed. Please try again.',
            ]);
        }
    }

    function forgotPasswordView()
    {
        try {

            return view('auth.forgot_password');
        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function forgotPassword(ResetPasswordLinkRequest $request)
    {
        try {
            $admin = User::query()
                ->select(['id', 'email', "first_name", "last_name", "reset_password_token"])
                ->where('email', $request->email)
                ->first();

            if (!$admin) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'User not found in our records.',
                    'code' => Response::HTTP_NOT_FOUND
                ]);
            }

            DB::beginTransaction();

            $admin->reset_password_token = Str::random(60);
            $admin->save();

            DB::commit();

            $details = [
                'name' => "Hi $admin->first_name $admin->last_name ",
                'token' => $admin->reset_password_token,
            ];

            Mail::to($admin->email)->send(new SendPasswordResetTokenMail($details));

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'A Reset password link successfully sent to your mail. Please check your mail to rest password.',
                'code' => Response::HTTP_OK
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function resetPasswordView(Request $request)
    {
        try {
            $token = $request->token;

            $user = User::query()
                ->select(['id', "reset_password_token"])
                ->where('reset_password_token', $token)
                ->first();

            if (!$user) {
                return redirect()->route('admin.login')->with([
                    'alert-type' => 'error',
                    'message' => 'Invalid or expired password reset token.',
                    'code' => Response::HTTP_BAD_REQUEST
                ]);
            }

            return view('auth.reset_password', compact('user'));
        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function resetPassword(PasswordResetRequest $request)
    {
        try {

            $admin = User::query()
                ->select(['id', "reset_password_token", "password", "unknown"])
                ->where('reset_password_token', $request->token)
                ->first();

            if (!$admin) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Data not found.',
                    'code' => Response::HTTP_NOT_FOUND,
                ]);
            }

            DB::beginTransaction();

            $admin->reset_password_token = null;
            $admin->unknown = base64_encode($request->password);
            $admin->password = Hash::make($request->password);
            $admin->save();

            DB::commit();

            return redirect()->route('admin.login')->with([
                'alert-type' => 'success',
                'message' => 'You have successfully reset your password.',
                'code' => Response::HTTP_OK
            ]);
        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
