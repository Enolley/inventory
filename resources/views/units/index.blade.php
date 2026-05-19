@extends('layouts.app')

@section('content')

<style>

    .page-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        flex-wrap:wrap;
        gap:15px;
        margin-bottom:20px;
    }

    .page-header h2{
        font-size:30px;
        color:#042159;
    }

    .btn-primary{
        background:linear-gradient(135deg,#0D6EFD,#1d4ed8);
        color:white;
        padding:12px 18px;
        border-radius:14px;
        text-decoration:none;
        font-weight:600;
        box-shadow:0 6px 18px rgba(13,110,253,0.2);
        transition:0.3s ease;
    }

    .btn-primary:hover{
        transform:translateY(-2px);
    }

    .alert-success{
        background:#dcfce7;
        color:#166534;
        padding:16px;
        border-radius:16px;
        margin-bottom:20px;
        font-weight:500;
    }

    .table-card{
        background:white;
        padding:20px;
        border-radius:24px;
        box-shadow:0 4px 20px rgba(0,0,0,0.05);
        overflow:auto;
    }

    table{
        width:100%;
        border-collapse:collapse;
        min-width:700px;
    }

    thead tr{
        background:#f8fafc;
    }

    th{
        text-align:left;
        padding:14px;
        font-size:12px;
        text-transform:uppercase;
        letter-spacing:0.5px;
        color:#64748b;
    }

    td{
        padding:14px;
        border-bottom:1px solid #eef2f7;
        font-size:14px;
        color:#1e293b;
    }

    tbody tr:hover{
        background:#f9fbff;
    }

    .status-active{
        background:#dcfce7;
        color:#166534;
        padding:6px 12px;
        border-radius:30px;
        font-size:12px;
        font-weight:600;
    }

    .status-inactive{
        background:#fee2e2;
        color:#991b1b;
        padding:6px 12px;
        border-radius:30px;
        font-size:12px;
        font-weight:600;
    }

    .actions a{
        color:#005792;
        font-weight:600;
        text-decoration:none;
        margin-right:10px;
    }

    .actions a:hover{
        text-decoration:underline;
    }

    .add-btn{
        background:linear-gradient(135deg,#F7931E,#ff8c00);
        color:white;
        padding:14px 22px;
        border-radius:14px;
        text-decoration:none;
        font-weight:600;
        box-shadow:0 8px 20px rgba(247,147,30,0.25);
        transition:0.3s ease;
    }

    .add-btn:hover{
        transform:translateY(-2px);
    }

    .edit-btn{
        text-decoration:none;
        background:#e0f2fe;
        color:#0369a1;
        padding:8px 14px;
        border-radius:10px;
        font-size:13px;
        font-weight:600;
        transition:0.3s ease;
    }

    .edit-btn:hover{
        background:#bae6fd;
    }

    .delete-btn{
        border:none;
        background:#fee2e2;
        color:#b91c1c;
        padding:8px 14px;
        border-radius:10px;
        font-size:13px;
        font-weight:600;
        cursor:pointer;
        transition:0.3s ease;
    }

    .delete-btn:hover{
        background:#fecaca;
    }


</style>

<div class="page-header">

    <h2>Units</h2>

    <a href="{{ route('units.create') }}" class="add-btn">
        + Add Unit
    </a>

</div>

@if(session('success'))

<div class="alert-success">
    {{ session('success') }}
</div>

@endif

<div class="table-card">

    <table>

        <thead>

            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Short Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

        </thead>

        <tbody>

            @forelse($units as $unit)

            <tr>

                <td>{{ $loop->iteration }}</td>
                <td><strong>{{ $unit->name }}</strong></td>
                <td>{{ $unit->short_name }}</td>

                <td>
                    @if($unit->status)
                        <span class="status-active">Active</span>
                    @else
                        <span class="status-inactive">Inactive</span>
                    @endif
                </td>

                <td class="actions">

                    <a href="{{ route('units.edit', $unit->id) }}" class="edit-btn">
                        Edit
                    </a>

                    <form method="POST"
                          action="{{ route('units.destroy', $unit->id) }}"
                          style="display:inline;">

                        @csrf
                        @method('DELETE')

                        <button class="delete-btn"
                                onclick="return confirm('Delete unit?')">

                            Delete

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>
                <td colspan="5" style="text-align:center;padding:30px;color:#64748b;">
                    No units found
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection