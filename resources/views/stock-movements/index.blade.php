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
        font-size:14px;
        transition:0.3s ease;
        box-shadow:0 6px 18px rgba(13,110,253,0.2);
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
        min-width:850px;
    }

    thead tr{
        background:#f8fafc;
    }

    th{
        text-align:left;
        padding:16px;
        font-size:12px;
        text-transform:uppercase;
        letter-spacing:0.5px;
        color:#64748b;
    }

    td{
        padding:16px;
        border-bottom:1px solid #eef2f7;
        font-size:14px;
        color:#1e293b;
    }

    tbody tr:hover{
        background:#f9fbff;
    }

    .item-name{
        font-weight:600;
        color:#042159;
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

    .empty{
        text-align:center;
        padding:40px;
        color:#64748b;
    }

</style>

<!-- HEADER -->

<div class="page-header">

    <h2>Stock Movements</h2>

    <a href="{{ route('stock-movements.create') }}"
       class="add-btn">

        + Issue Stock

    </a>

</div>

<!-- SUCCESS -->

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

                <th>Item</th>
                <th>Qty</th>
                <th>Issued To</th>
                <th>Department</th>
                <th>Date</th>
                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

            @forelse($movements as $move)

            <tr>

                <td class="item-name">
                    {{ $move->inventoryItem->item_name ?? '' }}
                </td>

                <td>{{ $move->quantity_issued }}</td>

                <td>{{ $move->issued_to }}</td>

                <td>{{ $move->department }}</td>

                <td>{{ $move->issued_at }}</td>

                <td class="actions">

                    <a href="{{ route('stock-movements.show', $move->id) }}">
                        View
                    </a>

                    <form method="POST"
                          action="{{ route('stock-movements.destroy', $move->id) }}"
                          style="display:inline;">

                        @csrf
                        @method('DELETE')

                        <button class="delete-btn"
                                onclick="return confirm('Delete this stock movement?')">

                            Delete

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6" class="empty">
                    No stock movements found
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection