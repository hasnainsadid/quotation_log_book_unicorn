@extends('backend.layouts.app')
@section('title', 'Quotation Log Book')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        @php
            $canExport = auth()->user()?->hasAnyRole(\App\Models\QuatationLogBook::EXPORT_ROLES);
        @endphp
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">All Quotation Logs</h5>
                <div class="mx-5 d-flex align-items-center gap-2">
                    @if ($canExport)
                        <div id="exportButtons" class="d-flex gap-2"></div>
                    @endif

                    @if (hasPermission(['quatation-log-books.create']))
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#logAddModal">Add
                            New</button>
                    @endif
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                {!! $dataTable->table(['class' => 'table'], true) !!}
            </div>
        </div>

        {{-- Add Modal --}}
        <div class="modal fade" id="logAddModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Quotation Log</h5>
                        <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addLogForm" action="{{ route('quatation-log-books.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Project Name</label>
                                    <input type="text" name="project_name" class="form-control"
                                        placeholder="Enter Project Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Project Address</label>
                                    <input type="text" name="project_address" class="form-control"
                                        placeholder="Enter Address">
                                </div>

                                <div class="col-12">
                                    <div class="d-flex justify-content-between mb-2">
                                        <label class="form-label mb-0">Contact Number & Person</label>
                                        <button type="button" class="btn btn-sm btn-outline-primary add-contact"
                                            data-target="#add_contacts">+ Add</button>
                                    </div>
                                    <div id="add_contacts"></div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Lift Size (1400x1000)</label>
                                    <input type="text" name="lift_size" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Capacity (kg)</label>
                                    <input type="number" name="capacity_kg" class="form-control" min="0">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Passengers</label>
                                    <input type="number" name="passengers" class="form-control" min="0">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Floors</label>
                                    <input type="number" name="floors" class="form-control" min="0">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Lift Quantity</label>
                                    <input type="number" name="lift_quantity" class="form-control" min="1"
                                        value="1">
                                </div>

                                <div class="col-12">
                                    <div class="d-flex justify-content-between mb-2">
                                        <label class="form-label mb-0">Lift Brand & Given Price</label>
                                        <button type="button" class="btn btn-sm btn-outline-primary add-offer"
                                            data-target="#add_offers">+ Add</button>
                                    </div>
                                    <div id="add_offers"></div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Sub-station (315 KVA)</label>
                                    <input type="text" name="sub_station" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Generator</label>
                                    <input type="text" name="generator" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">PQ Taken By</label>
                                    @if ($users->isNotEmpty())
                                        <select name="pq_user_id" class="form-select" required>
                                            <option value="">-- Select User --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="text" class="form-control" value="{{ auth()->user()->name }}"
                                            readonly>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">PQ Date</label>
                                    <input type="date" name="pq_date" class="form-control">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Remarks</label>
                                    <textarea name="remarks" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Edit Modal --}}
        <div class="modal fade" id="logEditModal" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <form id="editLogForm">
                    @csrf
                    @method('PUT')

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Edit Quotation Log</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" id="edit_id">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Project Name</label>
                                    <input type="text" name="project_name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Project Address</label>
                                    <input type="text" name="project_address" class="form-control">
                                </div>

                                <div class="col-12">
                                    <div class="d-flex justify-content-between mb-2">
                                        <label class="form-label mb-0">Contact Number & Person</label>
                                        <button type="button" class="btn btn-sm btn-outline-primary add-contact"
                                            data-target="#edit_contacts">+ Add</button>
                                    </div>
                                    <div id="edit_contacts"></div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Lift Size (1400x1000)</label>
                                    <input type="text" name="lift_size" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Capacity (kg)</label>
                                    <input type="number" name="capacity_kg" class="form-control" min="0">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Passengers</label>
                                    <input type="number" name="passengers" class="form-control" min="0">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Floors</label>
                                    <input type="number" name="floors" class="form-control" min="0">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Lift Quantity</label>
                                    <input type="number" name="lift_quantity" class="form-control" min="1">
                                </div>

                                <div class="col-12">
                                    <div class="d-flex justify-content-between mb-2">
                                        <label class="form-label mb-0">Lift Brand & Given Price</label>
                                        <button type="button" class="btn btn-sm btn-outline-primary add-offer"
                                            data-target="#edit_offers">+ Add</button>
                                    </div>
                                    <div id="edit_offers"></div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Sub-station (315 KVA)</label>
                                    <input type="text" name="sub_station" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Generator</label>
                                    <input type="text" name="generator" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">PQ Taken By</label>
                                    @if ($users->isNotEmpty())
                                        <select name="pq_user_id" class="form-select" required>
                                            <option value="">-- Select User --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="text" class="form-control" value="{{ auth()->user()->name }}"
                                            readonly>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">PQ Date</label>
                                    <input type="date" name="pq_date" class="form-control">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Remarks</label>
                                    <textarea name="remarks" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Excel / PDF export (library + button + function) --}}
    @include('backend.layouts.partials.datatable_export', ['exportTitle' => 'Quotation Log Book'])

    {{-- DataTable চালু (লাইব্রেরির পরে) --}}
    {!! $dataTable->scripts() !!}

    <script>
        $(document).ready(function() {
            const fields = ['project_name', 'project_address', 'lift_size', 'capacity_kg', 'passengers',
                'floors', 'lift_quantity', 'sub_station', 'generator',
                'pq_user_id', 'pq_date', 'remarks'
            ];

            let offerIndex = 0;

            function contactRow(number = '', person = '') {
                return `
                <div class="row g-2 mb-2 dyn-row">
                    <div class="col-md-5"><input type="text" name="contact_numbers[]" class="form-control" placeholder="Contact Number" value="${number}"></div>
                    <div class="col-md-5"><input type="text" name="contact_persons[]" class="form-control" placeholder="Contact Person" value="${person}"></div>
                    <div class="col-md-2"><button type="button" class="btn btn-outline-danger w-100 remove-row">×</button></div>
                </div>`;
            }

            function offerRow(brand = '', price = '') {
                const i = offerIndex++;
                return `
                <div class="row g-2 mb-2 dyn-row">
                    <div class="col-md-5"><input type="text" name="offers[${i}][brand]" class="form-control" placeholder="Lift Brand" value="${brand}"></div>
                    <div class="col-md-5"><input type="number" step="0.01" name="offers[${i}][price]" class="form-control" placeholder="Given Price" value="${price}"></div>
                    <div class="col-md-2"><button type="button" class="btn btn-outline-danger w-100 remove-row">×</button></div>
                </div>`;
            }

            function resetRows(type) {
                $('#' + type + '_contacts').html(contactRow());
                $('#' + type + '_offers').html(offerRow());
            }

            function removeEmptyRows($form) {
                $form.find('.dyn-row').each(function() {
                    let empty = $(this).find('input').toArray().every(i => !i.value.trim());
                    if (empty) $(this).remove();
                });
            }

            // Reset form when the Add modal opens
            $('#logAddModal').on('show.bs.modal', function() {
                $('#addLogForm')[0].reset();
                resetRows('add');
            });

            // Row add / remove
            $(document).on('click', '.add-contact', function() {
                $($(this).data('target')).append(contactRow());
            });
            $(document).on('click', '.add-offer', function() {
                $($(this).data('target')).append(offerRow());
            });
            $(document).on('click', '.remove-row', function() {
                $(this).closest('.dyn-row').remove();
            });

            // Remove empty rows before the Add form submits
            $('#addLogForm').on('submit', function() {
                removeEmptyRows($(this));
            });

            // Edit
            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('quatation-log-books.edit', ':id') }}".replace(':id', id),
                    type: 'GET',
                    success: function(res) {
                        $('#edit_id').val(res.id);
                        $('#editLogForm')[0].reset();
                        resetRows('edit');

                        fields.forEach(f => {
                            let val = res[f] ?? '';
                            if (f === 'pq_date' && val) val = val.substring(0, 10);
                            $('#editLogForm [name="' + f + '"]').val(val);
                        });

                        let numbers = res.contact_numbers ?? [];
                        let persons = res.contact_persons ?? [];
                        let total = Math.max(numbers.length, persons.length);
                        if (total) {
                            $('#edit_contacts').html('');
                            for (let i = 0; i < total; i++) {
                                $('#edit_contacts').append(contactRow(numbers[i] ?? '', persons[
                                    i] ?? ''));
                            }
                        }

                        if ((res.offers ?? []).length) {
                            $('#edit_offers').html('');
                            res.offers.forEach(o => $('#edit_offers').append(offerRow(o.brand ??
                                '', o.price ?? '')));
                        }

                        $('#logEditModal').modal('show');
                    },
                    error: function() {
                        alert('Unable to fetch data');
                    }
                });
            });

            // Update (AJAX)
            $('#editLogForm').submit(function(e) {
                e.preventDefault();

                let $form = $(this);
                removeEmptyRows($form);
                let id = $('#edit_id').val();

                $.ajax({
                    url: "{{ route('quatation-log-books.update', ':id') }}".replace(':id', id),
                    type: 'POST',
                    data: $form.serialize(), // includes _token and _method=PUT
                    success: function() {
                        $('#logEditModal').modal('hide');
                        $('.dataTable').DataTable().ajax.reload(null, false);
                    },
                    error: function() {
                        alert('Unable to update data');
                    }
                });
            });
        });
    </script>
@endpush
