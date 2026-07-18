<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ContactUs\ContactUsBulkDeleteRequest;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $contactUsLists = ContactUs::query()
                ->when($request->keyword, function ($q) use ($request) {
                    $q->where(function ($query) use ($request) {
                        $query->where('name', 'LIKE', '%' . $request->keyword . '%')
                            ->orWhere('email', 'LIKE', '%' . $request->keyword . '%')
                            ->orWhere('phone', 'LIKE', '%' . $request->keyword . '%')
                            ->orWhere('subject', 'LIKE', '%' . $request->keyword . '%');
                    });
                })
                ->paginate(limit($request->par_page));

            return view('backend.contact.index', compact('contactUsLists'));
        } catch (\Exception $e) {

            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function show($id)
    {
        try {

            $contact = ContactUs::query()
                ->find($id);

            if (!$contact) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data not found.',
                ]);
            }

            $html = view('backend.contact.show', compact('contact'))->render();

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

    public function bulkDestroy(ContactUsBulkDeleteRequest $request)
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
        $data = ContactUs::query()
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
