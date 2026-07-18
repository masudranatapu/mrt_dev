<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DatabaseBackup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatabaseBackupController extends Controller
{
    public function index(Request $request)
    {
        try {

            $databaseBackups = DatabaseBackup::query()
                ->orderBy('created_at', 'desc')
                ->paginate(limit($request->par_page));

            return view('backend.databasebackup.index', compact('databaseBackups'));
        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function create()
    {
        try {
            DB::beginTransaction();

            $backup = exportDatabaseAsSql();

            if (!$backup) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Failed to create backup.',
                ]);
            }
            // if live then comment out
            // $info = databaseBackupEmail();

            DB::commit();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Database backup created successfully.',
            ]);
        } catch (\Throwable $e) {
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

            $data = DatabaseBackup::find($id);

            if (!$data) {
                return redirect()->back()->with([
                    'alert-type' => 'error',
                    'message' => 'Data not found.',
                ]);
            }

            if (file_exists($data->file)) {
                unlink($data->file);
            }

            // add more condition you have here

            $data->delete();

            DB::commit();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Backup data deleted successfully.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
