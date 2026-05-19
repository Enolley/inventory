@extends('layouts.app')

@section('content')

<style>

    .page-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:25px;
        gap:15px;
        flex-wrap:wrap;
    }

    .page-header h2{
        font-size:32px;
        color:#042159;
        margin-bottom:5px;
    }

    .page-header p{
        color:#64748b;
        font-size:14px;
    }

    .add-btn{
        background:linear-gradient(
            135deg,
            #F7931E,
            #ff8c00
        );
        color:white;
        padding:14px 22px;
        border-radius:14px;
        text-decoration:none;
        font-weight:600;
        transition:0.3s ease;
        box-shadow:0 8px 20px rgba(247,147,30,0.25);
    }

    .add-btn:hover{
        transform:translateY(-2px);
    }

    /* ALERT */

    .alert-success{
        background:#d1fae5;
        color:#065f46;
        padding:16px 18px;
        border-radius:16px;
        margin-bottom:20px;
        font-weight:500;
        box-shadow:0 4px 10px rgba(0,0,0,0.03);
    }

    /* TABLE CARD */

    .table-card{
        background:white;
        border-radius:24px;
        padding:25px;
        overflow:auto;
        box-shadow:0 4px 20px rgba(0,0,0,0.05);
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
        padding:16px;
        color:#64748b;
        font-size:13px;
        font-weight:600;
        text-transform:uppercase;
        letter-spacing:0.5px;
    }

    td{
        padding:18px 16px;
        border-bottom:1px solid #eef2f7;
        font-size:14px;
        color:#1e293b;
    }

    tbody tr{
        transition:0.3s ease;
    }

    tbody tr:hover{
        background:#f9fbff;
    }

    /* STATUS */

    .status{
        display:inline-flex;
        align-items:center;
        padding:8px 14px;
        border-radius:999px;
        font-size:13px;
        font-weight:600;
    }

    .status-active{
        background:#dcfce7;
        color:#166534;
    }

    .status-inactive{
        background:#fee2e2;
        color:#991b1b;
    }

    /* ACTIONS */

    .actions{
        display:flex;
        align-items:center;
        gap:10px;
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

    /* EMPTY STATE */

    .empty-state{
        text-align:center;
        padding:40px 20px;
        color:#64748b;
        font-size:15px;
    }

    @media(max-width:768px){

        .page-header{
            flex-direction:column;
            align-items:flex-start;
        }

    }

</style>

<!-- PAGE HEADER -->

<div class="page-header">

    <div>

        <h2>Brands</h2>

        <p>
            Manage all inventory brands
        </p>

    </div>

    <a href="{{ route('brands.create') }}" class="add-btn">
        + Add Brand
    </a>

</div>

<!-- SUCCESS MESSAGE -->

@if(session('success'))

<div class="alert-success">
    {{ session('success') }}
</div>

@endif

<!-- TABLE -->

<div class="table-card">

    <table>

        <thead>

            <tr>

                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Status</th>
                <th width="180">Actions</th>

            </tr>

        </thead>

        <tbody>

            @forelse($brands as $brand)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    <strong>{{ $brand->name }}</strong>
                </td>

                <td>
                    {{ $brand->category->name ?? 'N/A' }}
                </td>

                <td>

                    @if($brand->status)

                        <span class="status status-active">
                            Active
                        </span>

                    @else

                        <span class="status status-inactive">
                            Inactive
                        </span>

                    @endif

                </td>

                <td>

                    <div class="actions">

                        <a href="{{ route('brands.edit', $brand->id) }}"
                           class="edit-btn">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('brands.destroy', $brand->id) }}"
                              style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="delete-btn"
                                onclick="return confirm('Delete this brand?')"
                            >
                                Delete
                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="5">

                    <div class="empty-state">
                        No brands found
                    </div>

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection