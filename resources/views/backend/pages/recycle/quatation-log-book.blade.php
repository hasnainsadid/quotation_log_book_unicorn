@extends('backend.layouts.app')
@section('title', 'Quotation Log Book Recycle Bin')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Quotation Log Book: Recycle Bin</h5>
                <a href="{{ route('quatation-log-books.index') }}" class="btn btn-secondary btn-sm mx-5">Back</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Project Name</th>
                            <th>Address</th>
                            <th>PQ Taken By</th>
                            <th>Deleted At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->project_name }}</td>
                                <td>{{ $log->project_address }}</td>
                                <td>{{ $log->pqUser?->name ?? $log->pq_taken_by }}</td>
                                <td>{{ $log->deleted_at->diffForHumans() }}</td>
                                <td>
                                    <form action="{{ route('quatation-log-books.restore', $log->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                    </form>

                                    <form action="{{ route('quatation-log-books.forceDelete', $log->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Permanently delete? This cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete Forever</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Recycle bin is empty</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection