@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- Welcome --}}
        <div class="card mb-6">
            <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h4 class="mb-1">Welcome back, {{ auth()->user()->name }}</h4>
                    <p class="mb-0 text-body-secondary">
                        {{ auth()->user()->designation ?? auth()->user()->roles->pluck('name')->first() }}
                        · {{ now()->format('l, d F Y') }}
                    </p>
                </div>
                @if ($showQuotations && hasPermission(['quatation-log-books.create']))
                    <a href="{{ route('quatation-log-books.index') }}" class="btn btn-primary">
                        <i class="icon-base ti tabler-plus me-1"></i> New Quotation
                    </a>
                @endif
            </div>
        </div>

        {{-- Stat cards --}}
        <div class="row g-6 mb-6">
            @if ($showUsers)
                <div class="col-xl-4 col-sm-6">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 text-body-secondary">Total Users</p>
                                <h3 class="mb-0">{{ number_format($stats['users']) }}</h3>
                            </div>
                            <span class="badge bg-label-primary p-3 rounded">
                                <i class="icon-base ti tabler-users icon-26px"></i>
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            @if ($showRoles)
                <div class="col-xl-4 col-sm-6">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 text-body-secondary">Total Roles</p>
                                <h3 class="mb-0">{{ number_format($stats['roles']) }}</h3>
                            </div>
                            <span class="badge bg-label-info p-3 rounded">
                                <i class="icon-base ti tabler-shield-lock icon-26px"></i>
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            @if ($showQuotations)
                <div class="col-xl-4 col-sm-6">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 text-body-secondary">{{ $canViewAll ? 'Total Quotations' : 'My Quotations' }}</p>
                                <h3 class="mb-0">{{ number_format($quotation['total']) }}</h3>
                                <small class="text-success">+{{ $quotation['this_month'] }} this month</small>
                            </div>
                            <span class="badge bg-label-success p-3 rounded">
                                <i class="icon-base ti tabler-file-invoice icon-26px"></i>
                            </span>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-xl-3 col-sm-6">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 text-body-secondary">Total Lifts Quoted</p>
                                <h3 class="mb-0">{{ number_format($quotation['lifts']) }}</h3>
                                <small class="text-body-secondary">{{ $quotation['trashed'] }} in recycle bin</small>
                            </div>
                            <span class="badge bg-label-warning p-3 rounded">
                                <i class="icon-base ti tabler-building-skyscraper icon-26px"></i>
                            </span>
                        </div>
                    </div>
                </div> --}}
            @endif
        </div>

        @if ($showQuotations)
            <div class="row g-6 mb-6">
                {{-- Monthly chart --}}
                <div class="col-lg-7">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="mb-1">Quotations Overview</h5>
                            <p class="card-subtitle mb-0">Last 6 months</p>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-end justify-content-between gap-3" style="height:220px;">
                                @foreach ($quotation['months'] as $m)
                                    @php $h = $m['total'] ? max(6, round($m['total'] / $quotation['max'] * 100)) : 2; @endphp
                                    <div class="d-flex flex-column align-items-center justify-content-end flex-fill h-100">
                                        <small class="fw-medium mb-1">{{ $m['total'] }}</small>
                                        <div class="bg-primary rounded-top w-100"
                                            style="height: {{ $h }}%; max-width:56px; opacity:.85;"></div>
                                        <small class="text-body-secondary mt-2">{{ $m['label'] }}</small>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PQ takers (admin) / Recent (others) --}}
                <div class="col-lg-5">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="mb-1">{{ $canViewAll ? 'Quotations by PQ Taker' : 'Recent Quotations' }}</h5>
                            <p class="card-subtitle mb-0">{{ $canViewAll ? 'Top 5 people' : 'Your latest 5' }}</p>
                        </div>
                        <div class="card-body">
                            @if ($canViewAll)
                                @forelse ($quotation['by_user'] as $row)
                                    @php $pct = round($row->total / max(1, $quotation['total']) * 100); @endphp
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span>{{ $row->pqUser?->name ?? 'Unknown' }}</span>
                                            <span class="fw-medium">{{ $row->total }}</span>
                                        </div>
                                        <div class="progress" style="height:6px">
                                            <div class="progress-bar" style="width: {{ $pct }}%"></div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted mb-0">No data yet.</p>
                                @endforelse
                            @else
                                @forelse ($quotation['recent'] as $q)
                                    <div class="d-flex justify-content-between border-bottom py-2">
                                        <span>{{ \Illuminate\Support\Str::limit($q->project_name, 28) }}</span>
                                        <small class="text-body-secondary">{{ $q->created_at?->diffForHumans() ?? '-' }}</small>
                                    </div>
                                @empty
                                    <p class="text-muted mb-0">No quotations yet.</p>
                                @endforelse
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent quotations table (admin only) --}}
            @if ($canViewAll)
                <div class="card mb-6">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recent Quotations</h5>
                        <a href="{{ route('quatation-log-books.index') }}" class="btn btn-sm btn-outline-primary">View all</a>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Project</th>
                                    <th>Address</th>
                                    <th>PQ Taken By</th>
                                    <th>PQ Date</th>
                                    <th>Added</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($quotation['recent'] as $q)
                                    <tr>
                                        <td>{{ $q->project_name }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($q->project_address, 30) }}</td>
                                        <td>{{ $q->pqUser?->name ?? $q->pq_taken_by }}</td>
                                        <td>{{ $q->pq_date?->format('d/m/y') }}</td>
                                        <td>{{ $q->created_at?->diffForHumans() }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No quotations yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endif

        @if ($showUsers)
            <div class="row g-6">
                {{-- Users by role --}}
                <div class="col-lg-5">
                    <div class="card h-100">
                        <div class="card-header"><h5 class="mb-0">Users by Role</h5></div>
                        <div class="card-body">
                            @forelse ($roleBreakdown as $role)
                                @php $pct = $stats['users'] ? round($role->users_count / $stats['users'] * 100) : 0; @endphp
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>{{ $role->name }}</span>
                                        <span class="fw-medium">{{ $role->users_count }}</span>
                                    </div>
                                    <div class="progress bg-primary" style="height:6px">
                                        <div class="progress-bar bg-info" style="width: {{ $pct }}%"></div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted mb-0">No roles yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Newest users --}}
                <div class="col-lg-7">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Newest Users</h5>
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-primary">View all</a>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentUsers as $u)
                                        <tr>
                                            <td>{{ $u->name }}</td>
                                            <td>{{ $u->designation ?? '-' }}</td>
                                            <td>
                                                <span class="badge bg-label-primary">
                                                    {{ $u->roles->pluck('name')->first() ?? '-' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection