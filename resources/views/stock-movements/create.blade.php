@extends('layouts.app')

@section('content')

<style>

    .page-header{
        margin-bottom:20px;
    }

    .page-header h2{
        font-size:30px;
        color:#042159;
    }

    .form-card{
        background:white;
        padding:30px;
        border-radius:24px;
        max-width:850px;
        box-shadow:0 4px 20px rgba(0,0,0,0.05);
    }

    .alert-error{
        background:#fee2e2;
        color:#991b1b;
        border:1px solid #fecaca;
        padding:16px;
        border-radius:16px;
        margin-bottom:20px;
        font-size:14px;
    }

    .form-grid{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        gap:18px;
    }

    .form-group{
        margin-bottom:18px;
    }

    .full-width{
        grid-column:1 / -1;
    }

    label{
        display:block;
        margin-bottom:8px;
        font-size:14px;
        font-weight:600;
        color:#1e293b;
    }

    .form-control{
        width:100%;
        padding:14px 16px;
        border-radius:14px;
        border:1px solid #e2e8f0;
        background:#f8fafc;
        outline:none;
        font-size:14px;
        transition:0.3s ease;
    }

    .form-control:focus{
        border-color:#F7931E;
        background:#fff;
        box-shadow:0 0 0 4px rgba(247,147,30,0.15);
    }

    textarea.form-control{
        min-height:120px;
        resize:vertical;
    }

    .btn-submit{
        margin-top:20px;
        background:linear-gradient(135deg,#0D6EFD,#1d4ed8);
        color:white;
        border:none;
        padding:14px 22px;
        border-radius:14px;
        cursor:pointer;
        font-weight:600;
        font-size:15px;
        transition:0.3s ease;
        box-shadow:0 8px 20px rgba(13,110,253,0.25);
    }

    .btn-submit:hover{
        transform:translateY(-2px);
    }

    .back-link{
        display:inline-block;
        margin-bottom:20px;
        color:#005792;
        font-weight:600;
        text-decoration:none;
        font-size:14px;
    }

    .back-link:hover{
        text-decoration:underline;
    }

    @media(max-width:768px){

        .form-grid{
            grid-template-columns:1fr;
        }

    }

</style>

<a href="{{ route('stock-movements.index') }}" class="back-link">
    ← Back to Stock Movements
</a>

<div class="page-header">

    <h2>Issue Stock</h2>

</div>

@if(session('error'))

<div class="alert-error">
    {{ session('error') }}
</div>

@endif

<div class="form-card">

    <form method="POST" action="{{ route('stock-movements.store') }}">

        @csrf

        <div class="form-grid">

            <!-- INVENTORY -->

            <div class="form-group full-width">

                <label>Inventory Item</label>

                <select name="inventory_item_id"
                        class="form-control">

                    @foreach($items as $item)

                        <option value="{{ $item->id }}">

                            {{ $item->item_name }}
                            (Balance: {{ $item->stock_balance }})

                        </option>

                    @endforeach

                </select>

            </div>

            <!-- QUANTITY -->

            <div class="form-group">

                <label>Quantity Issued</label>

                <input type="number"
                       name="quantity_issued"
                       class="form-control"
                       required>

            </div>

            <!-- ISSUED TO -->

            <div class="form-group">

                <label>Issued To</label>

                <input type="text"
                       name="issued_to"
                       class="form-control"
                       required>

            </div>

            <!-- DEPARTMENT -->

            <div class="form-group">

                <label>Department</label>

                <input type="text"
                       name="department"
                       class="form-control">

            </div>

            <!-- PURPOSE -->

            <div class="form-group full-width">

                <label>Purpose</label>

                <textarea name="purpose"
                          class="form-control"></textarea>

            </div>

        </div>

        <button type="submit" class="btn-submit">
            Issue Stock
        </button>

    </form>

</div>

@endsection