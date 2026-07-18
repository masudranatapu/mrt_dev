<?php

namespace App\Http\Controllers\Backend;

use App\Classes\FileUploadClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Setting\PageMetaSeoRequest;
use App\Models\PageMetaSeo;
use Illuminate\Support\Facades\DB;

class PageMetaSeoController extends Controller
{
    protected $fileUpload;

    public function __construct(FileUploadClass $fileUpload)
    {
        $this->fileUpload = $fileUpload;
    }

    public function index()
    {
        try {
            $pageSeo = PageMetaSeo::query()
                ->first();

            return view('backend.pageseo.index', compact('pageSeo'));
        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(PageMetaSeoRequest $request)
    {
        try {
            DB::beginTransaction();
            $pageType = $request->page_type;

            $pageSeo = PageMetaSeo::firstOrCreate();

            $fields = ['description', 'keywords', 'robots', 'canonical_url'];

            foreach ($fields as $field) {
                $column = $pageType . '_' . $field;

                if ($request->has($column)) {
                    $pageSeo->$column = $request->$column;
                }
            }

            if ($pageType === 'common') {

                $commonFields = [
                    'author',
                    'og_title',
                    'og_description',
                    'og_type',
                    'og_url',
                    'og_site_name',
                    'twitter_card',
                    'twitter_title',
                    'twitter_description',
                ];

                foreach ($commonFields as $field) {
                    if ($request->has($field)) {
                        $pageSeo->$field = $request->$field;
                    }
                }

                if ($request->hasFile("og_image")) {

                    $this->fileUpload->fileUnlink($pageSeo->og_image);

                    $pageSeo->og_image = $this->fileUpload->imageUploader($request->file('og_image'), 'page_seo', 1200, 630);
                }

                if ($request->hasFile("twitter_image")) {
                    $this->fileUpload->fileUnlink($pageSeo->twitter_image);
                    $pageSeo->twitter_image = $this->fileUpload->imageUploader($request->file('twitter_image'), 'page_seo', 1200, 630);
                }
            }

            $pageSeo->save();

            DB::commit();

            return back()->with([
                'alert-type' => 'success',
                'message' => ucfirst($pageType) . ' SEO updated successfully.',
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}

