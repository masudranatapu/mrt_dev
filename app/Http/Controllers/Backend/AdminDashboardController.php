<?php

namespace App\Http\Controllers\Backend;

use App\Classes\FileUploadClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminProfileUpdateRequest;
use App\Http\Requests\Backend\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AdminDashboardController extends Controller
{

    protected $fileUpload;

    public function __construct(FileUploadClass $fileUpload)
    {
        $this->fileUpload = $fileUpload;
    }


    public function profile()
    {
        try {

            $admin = User::query()
                ->with([
                    'role',
                    'projectAssignees',
                    'customerAssignees',
                    'supportTicketAssignees',
                    'taskAssignees',
                    'invoiceAssignees',
                    'todos',
                    'supportTicketMessages',
                    'attendances',
                    'leaveRequests',
                    'activityLogs' => fn($q) => $q->latest(),
                ])
                ->findOrFail(authAdmin()->id);

            return view('backend.profile.index', compact('admin'));
        } catch (\Exception $e) {

            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ]);
        }
    }

    public function profileEdit()
    {
        try {

            $admin = Auth::guard('admin')->user();

            return view('backend.profile.edit', compact('admin'));
        } catch (\Exception $e) {

            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ]);
        }
    }

    public function profileUpdate(AdminProfileUpdateRequest $request)
    {
        try {

            DB::beginTransaction();

            $admin = User::query()
                ->find(authAdmin()->id);

            if (!$admin) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Data not found',
                    'code' => Response::HTTP_NOT_FOUND,
                ]);
            }

            $admin->designation_id = $request->designation_id;
            $admin->department_id = $request->department_id;
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->username = $request->username;
            $admin->present_address = $request->present_address;
            $admin->permanent_address = $request->permanent_address;

            if ($request->hasFile("avatar")) {

                $this->fileUpload->fileUnlink($admin->avatar);

                $file_avatar_url = $this->fileUpload->imageUploader($request->file('avatar'), 'avatar', 400, 400);
                $admin->avatar = $file_avatar_url;
            }

            $admin->country = $request->country;
            $admin->emergency_contact_person_name = $request->emergency_contact_person_name;
            $admin->emergency_contact_person_address = $request->emergency_contact_person_address;
            $admin->emergency_contact = $request->emergency_contact;
            $admin->language = $request->language;

            if ($request->hasFile("signature")) {
                $this->fileUpload->fileUnlink($admin->signature);
                $file_signature_url = $this->fileUpload->imageUploader($request->file('signature'), 'signature', 400, 400);
                $admin->signature = $file_signature_url;
            }

            if ($request->hasFile("nid")) {

                $this->fileUpload->fileUnlink($admin->nid);

                $file_nid_url = $this->fileUpload->imageUploader($request->file('nid'), 'nid', 400, 400);
                $admin->nid = $file_nid_url;
            }

            $admin->nid_no = $request->nid_no;
            $admin->gender = $request->gender;
            $admin->date_of_birth = $request->date_of_birth;
            $admin->bio = $request->bio;
            $admin->updated_by = authAdmin()->id;
            $admin->save();

            DB::commit();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Data updated successfully.',
                'code' => Response::HTTP_OK,
            ]);
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ]);
        }
    }

    public function checkUser(Request $request)
    {
        try {

            DB::beginTransaction();

            $usernameExists = User::query()
                ->where($request->type, $request->value)
                ->where('id', '!=', authAdmin()->id)
                ->get();

            if ($usernameExists->count() > 0) {
                return response()->json([
                    'alert-type' => 'error',
                    'message' => Str::ucfirst($request->type) . " already taken.",
                    'code' => Response::HTTP_CONFLICT,
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => Str::ucfirst($request->type) . " available.",
                'code' => Response::HTTP_OK,
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ]);
        }
    }

    public function profileSetting()
    {

        try {

            return view('backend.profile.profile_setting');
        } catch (\Throwable $e) {

            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ]);
        }
    }
    public function changePassword(ChangePasswordRequest $request)
    {

        try {
            DB::beginTransaction();

            $admin = User::find(authAdmin()->id);

            if (!$admin) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Data not found',
                    'code' => Response::HTTP_NOT_FOUND,
                ]);
            }

            if (!Hash::check($request->old_password, $admin->password)) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Password not match',
                    'code' => Response::HTTP_OK,
                ]);
            }

            $admin->unknown = base64_encode($request->password);
            $admin->password = Hash::make($request->password);

            $admin->save();

            DB::commit();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Password updated successfully.',
                'code' => Response::HTTP_OK,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ]);
        }
    }

}
