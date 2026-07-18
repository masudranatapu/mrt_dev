<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Project\ProjectStatusBulkDeleteRequest;
use App\Http\Requests\Backend\Project\ProjectStatusRequest;
use App\Models\ProjectStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectStatusController extends Controller
{
    public function index(Request $request)
    {
        try {
            $projectStatus = ProjectStatus::query()
                ->when($request->keyword, function ($q) use ($request) {
                    $q->where(function ($query) use ($request) {
                        $query->where('name', 'LIKE', '%' . $request->keyword . '%')
                            ->orWhere('color', 'LIKE', '%' . $request->keyword . '%');
                    });
                })
                ->when($request->status && $request->status != 'All', fn($q) => $q->where('status', $request->status))
                ->withCount([
                    'projects',
                ])
                ->paginate(limit($request->par_page));

            return view('backend.project.status.index', compact('projectStatus'));
        } catch (\Exception $e) {

            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function store(ProjectStatusRequest $request)
    {
        try {

            DB::beginTransaction();

            $projectStatus = new ProjectStatus();

            $projectStatus->name = $request->name;
            $projectStatus->color = $request->color;
            $projectStatus->status = $request->status;

            $projectStatus->save();

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

            $projectStatus = ProjectStatus::query()
                ->find($id);

            if (!$projectStatus) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data not found.',
                ]);
            }

            $html = view('backend.project.status.edit', compact('projectStatus'))->render();

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

    public function update(ProjectStatusRequest $request, $id)
    {
        try {

            DB::beginTransaction();

            $projectStatus = ProjectStatus::query()
                ->find($id);

            if (!$projectStatus) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Data not found.',
                ]);
            }

            $projectStatus->name = $request->name;
            $projectStatus->color = $request->color;
            $projectStatus->status = $request->status;

            $projectStatus->save();

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
                ]);
            }

            DB::commit();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => $response['message'],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function bulkDestroy(ProjectStatusBulkDeleteRequest $request)
    {
        try {
            DB::beginTransaction();

            $results = ['success' => [], 'errors' => []];

            foreach ($request->bulk_ids as $id) {
                $response = $this->destroyData($id);
                if ($response['status']) {
                    $results['success'][] = $id;
                } else {
                    $results['errors'][$id] = $response['message'];
                }
            }

            DB::commit();

            if (empty($results['errors'])) {

                return redirect()->back()->with([
                    'alert-type' => 'success',
                    'message' => 'Bulk selected data deleted successfully.',
                ]);
            } else {

                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Partial success: ' . count($results['success']) . ' deleted, ' . count($results['errors']) . ' failed',
                    'data' => $results,
                ]);
            }
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
        $data = ProjectStatus::query()
            ->withCount([
                'projects',
            ])
            ->find($id);

        if (!$data) {
            return [
                'status' => false,
                'message' => 'Data not found.',
            ];
        }

        if ($data->projects_count > 0) {
            return [
                'status' => false,
                'message' => 'This project status is currently assigned to project. Please remove those projects before deleting.',
            ];
        }

        $data->delete();

        return [
            'status' => true,
            'message' => 'Data deleted successfully.',
        ];
    }
}
