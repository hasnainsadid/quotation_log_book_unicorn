<?php
namespace App\Http\Controllers\Backend;

use App\DataTables\QuatationLogBookDataTable;
use App\Http\Controllers\Controller;
use App\Models\QuatationLogBook;
use App\Models\User;
use Illuminate\Http\Request;

class QuatationLogBookController extends Controller
{
    public function index(QuatationLogBookDataTable $dataTable)
    {
        $users = QuatationLogBook::canViewAll()
            ? User::orderBy('name')->get(['id', 'name'])
            : collect();

        return $dataTable->render('backend.pages.quatation-log-books.index', compact('users'));
    }

    public function store(Request $request)
    {
        QuatationLogBook::create($this->payload($request));

        notify()->success('Quotation log has been created successfully.');
        return back();
    }

    public function edit(string $id)
    {
        return response()->json(QuatationLogBook::visible()->findOrFail($id));
    }

    public function update(Request $request, string $id)
    {
        $log = QuatationLogBook::visible()->findOrFail($id);
        $log->update($this->payload($request, $log));

        notify()->success('Quotation log has been updated successfully.');
        return back();
    }

    public function destroy(string $id)
    {
        QuatationLogBook::visible()->findOrFail($id)->delete();

        notify()->success('Quotation log has been deleted successfully.');
        return back();
    }

    public function recycleBin()
    {
        $logs = QuatationLogBook::visible()->with('pqUser')
            ->onlyTrashed()->latest('deleted_at')->get();

        return view('backend.pages.recycle.quatation-log-book', compact('logs'));
    }

    public function restore($id)
    {
        QuatationLogBook::visible()->onlyTrashed()->findOrFail($id)->restore();

        notify()->success('Quotation log has been restored successfully.');
        return back();
    }

    public function forceDelete($id)
    {
        QuatationLogBook::visible()->onlyTrashed()->findOrFail($id)->forceDelete();

        notify()->success('Quotation log has been permanently deleted.');
        return back();
    }

    /**
     * Request থেকে ডাটা বানায় এবং pq_user_id নিরাপদে ঠিক করে।
     */
    private function payload(Request $request, ?QuatationLogBook $log = null): array
    {
        $request->validate([
            'status' => 'required|in:1,2,3',
        ]);

        $data    = $request->except(['_token', '_method', 'pq_user_id', 'pq_taken_by']);
        $needsPq = in_array((int) $request->status, [2, 3], true);

        if (QuatationLogBook::canViewAll()) {
            if ($needsPq) {
                $request->validate(['pq_user_id' => 'required|exists:users,id']);
                $userId = (int) $request->pq_user_id;
            } else {
                // Received Data: notun hole khali, edit hole aager malik thakbe
                // (nahole oi Employee nijer entry-ta dekhte pabe na)
                $userId = $log?->pq_user_id;
            }
        } else {
            // Employee/Manager: create-e nijer nam, update-e aagerta-i thakbe.
            // Status 1 hole-o malik thakbe, tai entry-ta nijer list-e thakbe.
            $userId = $log?->pq_user_id ?? auth()->id();
        }

        if (! $needsPq) {
            $data['pq_date'] = null;
        }

        $data['pq_user_id']  = $userId;
        $data['pq_taken_by'] = ($needsPq && $userId)
            ? User::whereKey($userId)->value('name')
            : null;

        return $data;
    }
}
