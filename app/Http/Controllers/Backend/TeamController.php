<?php

namespace App\Http\Controllers\Backend;

use App\Classes\FileUploadClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TeamRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    protected $fileUpload;

    public function __construct(FileUploadClass $fileUpload)
    {
        $this->fileUpload = $fileUpload;
    }

    public function index(Request $request)
    {
        try {

            $teams = Team::query()
                ->with([
                    'designation'
                ])
                ->paginate(limit($request->par_page));

            return view('backend.team.index', compact('teams', 'departments', 'designations'));
        } catch (\Exception $e) {

            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function store(TeamRequest $request)
    {
        try {

            DB::beginTransaction();

            $team = new Team();

            $team->name = $request->name;
            $team->department_id = $request->department_id;
            $team->designation_id = $request->designation_id;

            if ($request->hasFile("avatar")) {
                $file_avatar_url = $this->fileUpload->imageUploader($request->file('avatar'), 'team', 400, 400);
                $team->avatar = $file_avatar_url;
            }

            $team->facebook_link = $request->facebook_link;
            $team->x_link = $request->x_link;
            $team->instagram_link = $request->instagram_link;
            $team->linkedin_link = $request->linkedin_link;
            $team->status = $request->status;
            $team->created_by = authAdmin()->id;

            $team->save();

            DB::commit();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Data created successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        try {

            $team = Team::query()
                ->find($id);

            if (!$team) {
                return response()->json([
                    'status' => false,
                    'data' => 'Data not found.',
                ]);
            }


            $html = view('backend.team.edit', compact('team', 'departments', 'designations'))->render();

            return response()->json([
                'status' => true,
                'data' => $html,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(TeamRequest $request, $id)
    {
        try {

            DB::beginTransaction();

            $team = Team::query()
                ->find($id);

            if (!$team) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Data not found.',
                ]);
            }

            $team->name = $request->name;
            $team->department_id = $request->department_id;
            $team->designation_id = $request->designation_id;

            if ($request->hasFile("avatar")) {
                $this->fileUpload->fileUnlink($team->avatar);
                $file_avatar_url = $this->fileUpload->imageUploader($request->file('avatar'), 'team', 400, 400);
                $team->avatar = $file_avatar_url;
            }

            $team->facebook_link = $request->facebook_link;
            $team->x_link = $request->x_link;
            $team->instagram_link = $request->instagram_link;
            $team->linkedin_link = $request->linkedin_link;
            $team->status = $request->status;
            $team->updated_by = authAdmin()->id;

            $team->save();

            DB::commit();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Data updated successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {

        try {
            DB::beginTransaction();

            $response = $this->destroyData($id);

            if ($response['status'] != true) {

                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => $response['message'],
                    'code' => $response['code'],
                ]);
            }

            DB::commit();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Data deleted successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    private function destroyData($id)
    {
        $data = Team::query()
            ->find($id);

        if (!$data) {
            return [
                'alert-type' => false,
                'message' => 'Data not found.',
            ];
        }

        $this->fileUpload->fileUnlink($data->avatar);

        $data->delete();

        return [
            'status' => true,
            'message' => 'Data deleted successfully.',
        ];
    }
}
