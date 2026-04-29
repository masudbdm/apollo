@extends('admin::layouts.adminMaster')

@section('title')
    | Contact Messages
@endsection

@section('content')
    @php
        $user = auth()->user();
        $canDelete = $user && method_exists($user, 'hasAnyPermission')
            ? $user->hasAnyPermission(['contact-message-delete'])
            : false;
    @endphp

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Contact Messages</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Contact Messages</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-6">
                            <form method="GET" action="{{ route('admin.contactMessages.index') }}" class="d-flex">
                                <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Search name/email/subject/phone/message">
                                <button class="btn btn-primary ms-2" type="submit">Search</button>
                            </form>
                        </div>
                        <div class="col-md-6 text-md-end mt-2 mt-md-0">
                            @if($canDelete)
                                <button type="button" class="btn btn-danger" id="bulkDeleteBtn" disabled>Bulk Delete</button>
                            @endif
                            <button type="button" class="btn btn-secondary" id="bulkPrintBtn" disabled>Bulk Print</button>
                        </div>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <form id="bulkForm" method="POST" action="{{ route('admin.contactMessages.bulkDestroy') }}">
                        @csrf
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 40px;">
                                        <input type="checkbox" id="checkAll">
                                    </th>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Time</th>
                                    <th style="width: 120px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($messages as $m)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="row-check" name="ids[]" value="{{ $m->id }}">
                                        </td>
                                        <td>{{ $m->id }}</td>
                                        <td>{{ $m->full_name }}</td>
                                        <td>{{ $m->email }}</td>
                                        <td>{{ $m->number }}</td>
                                        <td>{{ $m->subject }}</td>
                                        <td style="max-width: 520px; white-space: normal;">
                                            {{ \Illuminate\Support\Str::limit($m->message, 220) }}
                                        </td>
                                        <td>{{ optional($m->created_at)->format('Y-m-d h:i A') }}</td>
                                        <td>
                                            @if($canDelete)
                                                <form method="POST" action="{{ route('admin.contactMessages.destroy', $m->id) }}" onsubmit="return confirm('Delete this message?')">
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center p-4">No messages found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </form>
                </div>

                @if(method_exists($messages, 'links'))
                    <div class="card-footer">
                        {{ $messages->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>

    <form id="printForm" method="POST" action="{{ route('admin.contactMessages.print') }}" target="_blank" style="display:none;">
        @csrf
        <div id="printIds"></div>
    </form>
@endsection

@push('scripts')
    <script>
        (function () {
            const checkAll = document.getElementById('checkAll');
            const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
            const bulkPrintBtn = document.getElementById('bulkPrintBtn');

            function getChecks() {
                return Array.from(document.querySelectorAll('.row-check'));
            }

            function getSelectedIds() {
                return getChecks().filter(c => c.checked).map(c => c.value);
            }

            function refreshButtons() {
                const hasAny = getSelectedIds().length > 0;
                if (bulkDeleteBtn) bulkDeleteBtn.disabled = !hasAny;
                bulkPrintBtn.disabled = !hasAny;
            }

            if (checkAll) {
                checkAll.addEventListener('change', function () {
                    getChecks().forEach(c => c.checked = checkAll.checked);
                    refreshButtons();
                });
            }

            document.addEventListener('change', function (e) {
                if (e.target && e.target.classList.contains('row-check')) {
                    const checks = getChecks();
                    const allChecked = checks.length > 0 && checks.every(c => c.checked);
                    if (checkAll) checkAll.checked = allChecked;
                    refreshButtons();
                }
            });

            if (bulkDeleteBtn) {
                bulkDeleteBtn.addEventListener('click', function () {
                    if (!confirm('Delete selected messages?')) return;
                    document.getElementById('bulkForm').submit();
                });
            }

            bulkPrintBtn.addEventListener('click', function () {
                const ids = getSelectedIds();
                const container = document.getElementById('printIds');
                container.innerHTML = '';
                ids.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'ids[]';
                    input.value = id;
                    container.appendChild(input);
                });
                document.getElementById('printForm').submit();
            });

            refreshButtons();
        })();
    </script>
@endpush

