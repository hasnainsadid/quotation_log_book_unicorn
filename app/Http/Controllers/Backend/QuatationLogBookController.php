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
            ? User::where('is_active', 1)->orderBy('name')->get(['id', 'name'])
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
        return response()->json(
            QuatationLogBook::visible()->with('pqUser:id,name')->findOrFail($id)
        );
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
     * Request থেকে ডাটা বানায় এবং pq_user_id (Responsible Person) নিরাপদে ঠিক করে।
     * Status যা-ই হোক, Responsible Person ও PQ Date সবসময় সেভ হবে।
     */
    private function payload(Request $request, ?QuatationLogBook $log = null): array
    {
        $request->validate([
            'status'     => 'required|in:1,2,3',
            'pq_user_id' => 'nullable|exists:users,id',
            'pq_date'    => 'nullable|date',
        ]);

        $data = $request->except(['_token', '_method', 'pq_user_id', 'pq_taken_by']);

        if (QuatationLogBook::canViewAll()) {
            // Admin: je user select korbe sheta, na korle aager malik, tao na thakle login user
            $userId = $request->filled('pq_user_id')
                ? (int) $request->pq_user_id
                : ($log?->pq_user_id ?? auth()->id());
        } else {
            // Employee/Manager: create-e nijer nam, update-e aagerta-i thakbe
            $userId = $log?->pq_user_id ?? auth()->id();
        }

        // khali string hole date column-e error na hoy
        $data['pq_date'] = $request->filled('pq_date') ? $request->pq_date : null;

        $data['pq_user_id']  = $userId;
        $data['pq_taken_by'] = $userId
            ? User::whereKey($userId)->value('name')
            : null;

        return $data;
    }
}
