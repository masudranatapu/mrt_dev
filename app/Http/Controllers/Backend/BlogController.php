<?php

namespace App\Http\Controllers\Backend;

use App\Classes\FileUploadClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Blog\BlogBulkDeleteRequest;
use App\Http\Requests\Backend\Blog\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    protected $fileUpload;

    public function __construct(FileUploadClass $fileUpload)
    {
        $this->fileUpload = $fileUpload;
    }

    public function index(Request $request)
    {
        try {
            $blogs = Blog::query()
                ->paginate(limit($request->par_page));

            return view('backend.blog.index', compact('blogs'));
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

            return view('backend.blog.create');
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function store(BlogRequest $request)
    {
        try {

            DB::beginTransaction();

            $blog = new Blog();

            $blog->title = $request->title;
            $blog->slug = Str::slug($request->title);
            $blog->description = $request->description;

            if ($request->hasFile("thumbnail")) {
                $file_thumbnail_url = $this->fileUpload->imageUploader($request->file('thumbnail'), 'blog', 400, 400);
                $blog->thumbnail = $file_thumbnail_url;
            }

            $blog->status = $request->status;
            $blog->created_by = authAdmin()->id;
            $blog->save();

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

            $blog = Blog::query()
                ->findOrFail($id);

            if (!$blog) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Data not found.',
                ]);
            }

            return view('backend.blog.edit', compact('blog'));
        } catch (\Exception $e) {

            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(BlogRequest $request, $id)
    {
        try {

            DB::beginTransaction();

            $blog = Blog::query()
                ->find($id);

            if (!$blog) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Data not found.',
                ]);
            }

            $blog->title = $request->title;
            $blog->slug = Str::slug($request->title);
            $blog->description = $request->description;

            if ($request->hasFile("thumbnail")) {
                $this->fileUpload->fileUnlink($blog->thumbnail);
                $file_thumbnail_url = $this->fileUpload->imageUploader($request->file('thumbnail'), 'blog', 400, 400);
                $blog->thumbnail = $file_thumbnail_url;
            }

            $blog->status = $request->status;
            $blog->updated_by = authAdmin()->id;
            $blog->save();

            DB::commit();

            return redirect()->route('admin.blogs.index')->with([
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

            return redirect()->route('admin.blogs.index')->with([
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

    public function bulkDestroy(BlogBulkDeleteRequest $request)
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
        $data = Blog::query()
            ->find($id);

        if (!$data) {
            return [
                'status' => false,
                'message' => 'Data not found.',
            ];
        }

        // unlink
        $this->fileUpload->fileUnlink($data->thumbnail);

        $data->delete();

        return [
            'status' => true,
            'message' => 'Data deleted successfully.',
        ];
    }
}

