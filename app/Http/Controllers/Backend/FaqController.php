<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Faq\FaqBulkDeleteRequest;
use App\Http\Requests\Backend\Faq\FaqRequest;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        try {
            $faqs = Faq::query()
                ->when($request->keyword, fn($q) => $q->where('question', 'LIKE', '%' . $request->keyword . '%'))
                ->when($request->status && $request->status != 'All', fn($q) => $q->where('status', $request->status))
                ->with([
                    'createdBy' => fn($q) => $q->select(['id', 'first_name', 'last_name', 'avatar']),
                    'updatedBy' => fn($q) => $q->select(['id', 'first_name', 'last_name', 'avatar']),
                ])
                ->paginate(limit($request->par_page));

            return view('backend.faq.index', compact('faqs'));
        } catch (\Exception $e) {

            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function store(FaqRequest $request)
    {
        try {

            DB::beginTransaction();

            $faq = new Faq();

            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->status = $request->status;
            $faq->created_by = authAdmin()->id;

            $faq->save();

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

            $faq = Faq::query()
                ->find($id);

            if (!$faq) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Data not found.',
                ]);
            }

            $html = view('backend.faq.edit', compact('faq'))->render();

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

    public function update(FaqRequest $request, $id)
    {
        try {

            DB::beginTransaction();

            $faq = Faq::query()
                ->find($id);

            if (!$faq) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Data not found.',
                ]);
            }
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->status = $request->status;

            $faq->updated_by = authAdmin()->id;

            $faq->save();

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

    public function bulkDestroy(FaqBulkDeleteRequest $request)
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
        $data = Faq::query()
            ->find($id);

        if (!$data) {
            return [
                'status' => false,
                'message' => 'Data not found.',
            ];
        }

        $data->delete();

        return [
            'status' => true,
            'message' => 'Data deleted successfully.',
        ];
    }
}
