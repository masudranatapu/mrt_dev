<?php

namespace App\Http\Controllers\Backend;

use App\Classes\FileUploadClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Project\ProjectBulkDeleteRequest;
use App\Http\Requests\Backend\Project\ProjectExportRequest;
use App\Http\Requests\Backend\Project\ProjectFollowUpDateRequest;
use App\Http\Requests\Backend\Project\ProjectRequest;
use App\Http\Requests\Backend\Project\ProjectStatusChangeRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectGallery;
use App\Models\ProjectStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    protected $fileUpload;

    public function __construct(FileUploadClass $fileUpload)
    {
        $this->fileUpload = $fileUpload;
    }

    public function index(Request $request)
    {
        try {
            $projects = Project::query()
                ->with(['projectStatus', 'client'])
                ->when($request->keyword, function ($q) use ($request) {
                    $q->where(function ($query) use ($request) {
                        $query->where('name', 'LIKE', '%' . $request->keyword . '%')
                            ->orWhere('unique_code', 'LIKE', '%' . $request->keyword . '%');
                    });
                })
                ->when($request->status && $request->status != 'All', fn($q) => $q->where('status', $request->status))
                ->when($request->project_status_id, fn($q) => $q->where('project_status_id', $request->project_status_id))
                ->latest()
                ->paginate(limit($request->par_page));

            return view('backend.project.index', compact('projects'));
        } catch (\Exception $e) {

            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function create()
    {
        try {

            $projectStatuses = ProjectStatus::query()->where('status', 'Active')->get();
            $clients = Client::query()->where('status', 'Active')->get();
            $users = User::query()->get();

            return view('backend.project.create', compact('projectStatuses', 'clients', 'users'));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function store(ProjectRequest $request)
    {
        try {

            DB::beginTransaction();

            $project = new Project();

            $project->unique_code = $this->generateUniqueCode();
            $project->project_status_id = $request->project_status_id;
            $project->client_id = $request->client_id;
            $project->name = $request->name;
            $project->slug = Str::slug($request->name) . '-' . Str::lower(Str::random(5));
            $project->description = $request->description;

            if ($request->hasFile("project_thumbnail")) {
                $project->project_thumbnail = $this->fileUpload->imageUploader($request->file('project_thumbnail'), 'project', 800, 600);
            }

            if ($request->hasFile("project_document")) {
                $project->project_document = $this->fileUpload->pdfUploader($request->file('project_document'), 'project');
            }

            $project->start_date = $request->start_date;
            $project->end_date = $request->end_date;
            $project->followup_date = $request->followup_date;
            $project->technology = $this->parseTagInput($request->technology);
            $project->key_features = $this->parseTagInput($request->key_features);
            $project->tags = $this->parseTagInput($request->tags);
            $project->team_ids = $request->assignee_ids ?? [];
            $project->status = $request->status;
            $project->created_by = authAdmin()->id;

            $project->save();

            $this->storeGalleryImages($project, $request);

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

    public function show($id)
    {
        try {

            $project = Project::query()
                ->with(['projectStatus', 'client', 'galleries', 'createdBy', 'updatedBy'])
                ->find($id);

            if (!$project) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Data not found.',
                ]);
            }

            $projectStatuses = ProjectStatus::query()->where('status', 'Active')->get();

            return view('backend.project.show', compact('project', 'projectStatuses'));
        } catch (\Exception $e) {

            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        try {

            $project = Project::query()
                ->with(['galleries'])
                ->find($id);

            if (!$project) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Data not found.',
                ]);
            }

            $projectStatuses = ProjectStatus::query()->where('status', 'Active')->get();
            $clients = Client::query()->where('status', 'Active')->get();
            $users = User::query()->get();

            return view('backend.project.edit', compact('project', 'projectStatuses', 'clients', 'users'));
        } catch (\Exception $e) {

            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(ProjectRequest $request, $id)
    {
        try {

            DB::beginTransaction();

            $project = Project::query()->find($id);

            if (!$project) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Data not found.',
                ]);
            }

            $project->project_status_id = $request->project_status_id;
            $project->client_id = $request->client_id;
            $project->name = $request->name;
            $project->description = $request->description;

            if ($request->hasFile("project_thumbnail")) {
                $this->fileUpload->fileUnlink($project->project_thumbnail);
                $project->project_thumbnail = $this->fileUpload->imageUploader($request->file('project_thumbnail'), 'project', 800, 600);
            }

            if ($request->hasFile("project_document")) {
                $this->fileUpload->fileUnlink($project->project_document);
                $project->project_document = $this->fileUpload->pdfUploader($request->file('project_document'), 'project');
            }

            $project->start_date = $request->start_date;
            $project->end_date = $request->end_date;
            $project->followup_date = $request->followup_date;
            $project->technology = $this->parseTagInput($request->technology);
            $project->key_features = $this->parseTagInput($request->key_features);
            $project->tags = $this->parseTagInput($request->tags);
            $project->team_ids = $request->assignee_ids ?? [];
            $project->status = $request->status;
            $project->updated_by = authAdmin()->id;

            $project->save();

            $this->storeGalleryImages($project, $request);

            DB::commit();

            return redirect()->route('admin.project.index')->with([
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

            return redirect()->route('admin.project.index')->with([
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

    public function bulkDestroy(ProjectBulkDeleteRequest $request)
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

    public function statusChange(ProjectStatusChangeRequest $request)
    {
        try {

            DB::beginTransaction();

            $project = Project::query()->find($request->project_id);

            if (!$project) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Data not found.',
                ]);
            }

            $project->project_status_id = $request->project_status_id;
            $project->updated_by = authAdmin()->id;
            $project->save();

            DB::commit();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Project status updated successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function followUpDate(ProjectFollowUpDateRequest $request)
    {
        try {

            DB::beginTransaction();

            $project = Project::query()->find($request->project_id);

            if (!$project) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Data not found.',
                ]);
            }

            $project->followup_date = $request->followup_date;
            $project->updated_by = authAdmin()->id;
            $project->save();

            DB::commit();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Follow-up date updated successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function exportData(ProjectExportRequest $request)
    {
        try {

            $projects = Project::query()
                ->with(['projectStatus', 'client'])
                ->latest()
                ->get();

            $fileName = 'projects-' . date('Y-m-d-H-i-s') . '.csv';

            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ];

            $callback = function () use ($projects) {
                $file = fopen('php://output', 'w');

                fputcsv($file, ['Unique Code', 'Name', 'Client', 'Project Status', 'Start Date', 'End Date', 'Status']);

                foreach ($projects as $project) {
                    fputcsv($file, [
                        $project->unique_code,
                        $project->name,
                        $project->client?->name,
                        $project->projectStatus?->name,
                        $project->start_date,
                        $project->end_date,
                        $project->status,
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    private function storeGalleryImages(Project $project, Request $request)
    {
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $image = $this->fileUpload->imageUploader($file, 'project-gallery', 1000, 750);

                ProjectGallery::create([
                    'project_id' => $project->id,
                    'image' => $image,
                ]);
            }
        }
    }

    private function generateUniqueCode(): string
    {
        do {
            $code = 'PRJ-' . strtoupper(Str::random(8));
        } while (Project::where('unique_code', $code)->exists());

        return $code;
    }

    private function parseTagInput($value): array
    {
        if (!$value) {
            return [];
        }

        if (is_array($value)) {
            return array_values(array_filter($value));
        }

        $decoded = json_decode($value, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return array_values(array_filter(array_map(fn($item) => is_array($item) ? ($item['value'] ?? null) : $item, $decoded)));
        }

        return array_values(array_filter(array_map('trim', explode(',', $value))));
    }

    private function destroyData($id)
    {
        $data = Project::query()
            ->with(['galleries'])
            ->find($id);

        if (!$data) {
            return [
                'status' => false,
                'message' => 'Data not found.',
            ];
        }

        $this->fileUpload->fileUnlink($data->project_thumbnail);
        $this->fileUpload->fileUnlink($data->project_document);

        foreach ($data->galleries as $gallery) {
            $this->fileUpload->fileUnlink($gallery->image);
            $gallery->delete();
        }

        $data->delete();

        return [
            'status' => true,
            'message' => 'Data deleted successfully.',
        ];
    }
}
