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
        font-size:32px;
        color:#042159;
    }

    .btn-group{
        display:flex;
        gap:10px;
        flex-wrap:wrap;
    }

    .btn{
        padding:12px 16px;
        border-radius:14px;
        text-decoration:none;
        font-weight:600;
        font-size:14px;
        color:white;
        transition:0.3s ease;
    }

    .btn:hover{
        transform:translateY(-2px);
    }

    .btn-blue{
        background:linear-gradient(135deg,#0D6EFD,#1d4ed8);
    }

    .btn-green{
        background:linear-gradient(135deg,#198754,#16a34a);
    }

    .btn-orange{
        background:linear-gradient(135deg,#F7931E,#ff8c00);
    }

    .btn-red{
        background:linear-gradient(135deg,#dc3545,#b91c1c);
    }

    /* ALERT */

    .alert-success{
        background:#dcfce7;
        color:#166534;
        padding:16px;
        border-radius:16px;
        margin-bottom:20px;
        font-weight:500;
    }

    /* SEARCH */

    .search-card{
        background:white;
        padding:18px;
        border-radius:20px;
        margin-bottom:20px;
        box-shadow:0 4px 20px rgba(0,0,0,0.05);
    }

    .search-form{
        display:flex;
        gap:10px;
        flex-wrap:wrap;
    }

    .search-input{
        width:300px;
        padding:14px 16px;
        border-radius:14px;
        border:1px solid #e2e8f0;
        background:#f8fafc;
        outline:none;
        transition:0.3s ease;
    }

    .search-input:focus{
        border-color:#F7931E;
        box-shadow:0 0 0 4px rgba(247,147,30,0.15);
        background:white;
    }

    /* TABLE */

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
        min-width:900px;
    }

    thead tr{
        background:#f8fafc;
    }

    th{
        text-align:left;
        padding:16px;
        font-size:13px;
        color:#64748b;
        text-transform:uppercase;
    }

    td{
        padding:16px;
        border-bottom:1px solid #eef2f7;
        font-size:14px;
    }

    tbody tr:hover{
        background:#f9fbff;
    }

    .low-stock{
        color:#dc2626;
        font-weight:700;
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

    .empty{
        text-align:center;
        padding:40px;
        color:#64748b;
    }

</style>

<!-- HEADER -->

<div class="page-header">

    <h2>Inventory</h2>

    <div class="btn-group">

        <a href="{{ route('inventory.create') }}" class="btn btn-blue">
            + Add Item
        </a>

        <a href="{{ route('inventory.report') }}" target="_blank" class="btn btn-orange">
            Print Report
        </a>

        <a href="{{ route('inventory.export.csv') }}" class="btn btn-green">
            Export CSV
        </a>

        <a href="{{ route('inventory.pdf.report') }}" target="_blank" class="btn btn-red">
            PDF Report
        </a>

    </div>

</div>

<!-- SUCCESS -->

@if(session('success'))

<div class="alert-success">
    {{ session('success') }}
</div>

@endif

<!-- SEARCH -->

<div class="search-card">

    <form class="search-form" method="GET">

        <input type="text"
               name="search"
               placeholder="Search item..."
               value="{{ request('search') }}"
               class="search-input">

        <button class="btn btn-blue">
            Search
        </button>

        <a href="?low_stock=1" class="btn btn-orange">
            Low Stock
        </a>

    </form>

</div>

<!-- TABLE -->

<div class="table-card">

    <table>

        <thead>

            <tr>

                <th>Item</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Bought</th>
                <th>Received</th>
                <th>Balance</th>
                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

            @forelse($items as $item)

            <tr>

                <td><strong>{{ $item->item_name }}</strong></td>

                <td>{{ $item->category->name ?? '' }}</td>

                <td>{{ $item->brand->name ?? '' }}</td>

                <td>{{ $item->quantity_bought }}</td>

                <td>{{ $item->quantity_received }}</td>

                <td>

                    @if($item->stock_balance <= 3)

                        <span class="low-stock">
                            {{ $item->stock_balance }} (LOW)
                        </span>

                    @else

                        {{ $item->stock_balance }}

                    @endif

                </td>

                <td class="actions">

                    <a href="{{ route('inventory.edit', $item->id) }}" class="edit-btn">
                        Edit
                    </a>

                    <form method="POST"
                          action="{{ route('inventory.destroy', $item->id) }}"
                          style="display:inline;">

                        @csrf
                        @method('DELETE')

                        <button class="delete-btn"
                                onclick="return confirm('Delete item?')">

                            Delete

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="7" class="empty">
                    No inventory found
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection