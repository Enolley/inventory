@extends('layouts.app')

@section('content')

<style>

    .page-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
        flex-wrap:wrap;
        gap:10px;
    }

    .page-header h2{
        font-size:30px;
        color:#042159;
    }

    .back-btn{
        background:#64748b;
        color:#fff;
        padding:12px 16px;
        border-radius:14px;
        text-decoration:none;
        font-weight:600;
        transition:0.3s ease;
    }

    .back-btn:hover{
        background:#475569;
    }

    .card{
        background:#fff;
        padding:25px;
        border-radius:24px;
        box-shadow:0 4px 20px rgba(0,0,0,0.05);
    }

    .title{
        font-size:24px;
        font-weight:700;
        color:#042159;
        margin-bottom:10px;
    }

    hr{
        border:none;
        border-top:1px solid #eef2f7;
        margin:18px 0;
    }

    .info-grid{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        gap:12px;
    }

    .info{
        font-size:14px;
        color:#1e293b;
    }

    .info strong{
        color:#64748b;
        display:block;
        font-size:12px;
        margin-bottom:4px;
        text-transform:uppercase;
    }

    .low-stock{
        color:#dc2626;
        font-weight:700;
    }

    .section-title{
        font-size:14px;
        font-weight:700;
        color:#042159;
        margin-bottom:6px;
        margin-top:10px;
    }

    @media(max-width:768px){
        .info-grid{
            grid-template-columns:1fr;
        }
    }

</style>

<!-- HEADER -->

<div class="page-header">

    <h2>Inventory Item Details</h2>

    <a href="{{ route('inventory.index') }}" class="back-btn">
        ← Back
    </a>

</div>

<!-- CARD -->

<div class="card">

    <div class="title">
        {{ $inventory->item_name }}
    </div>

    <hr>

    <!-- BASIC INFO -->

    <div class="info-grid">

        <div class="info">
            <strong>Category</strong>
            {{ $inventory->category->name ?? '' }}
        </div>

        <div class="info">
            <strong>Brand</strong>
            {{ $inventory->brand->name ?? '' }}
        </div>

        <div class="info">
            <strong>Unit</strong>
            {{ $inventory->unit->name ?? '' }}
        </div>

        <div class="info">
            <strong>Location</strong>
            {{ $inventory->location->name ?? '' }}
        </div>

        <div class="info">
            <strong>Supplier</strong>
            {{ $inventory->supplier->name ?? '' }}
        </div>

    </div>

    <hr>

    <!-- QUANTITIES -->

    <div class="info-grid">

        <div class="info">
            <strong>Quantity Bought</strong>
            {{ $inventory->quantity_bought }}
        </div>

        <div class="info">
            <strong>Quantity Received</strong>
            {{ $inventory->quantity_received }}
        </div>

        <div class="info">
            <strong>Unit Price</strong>
            {{ $inventory->unit_price }}
        </div>

        <div class="info">
            <strong>Total Price</strong>
            {{ $inventory->total_price }}
        </div>

    </div>

    <hr>

    <!-- STOCK -->

    <div class="info">

        <strong>Stock Balance</strong>

        @if($inventory->stock_balance <= 3)

            <span class="low-stock">
                {{ $inventory->stock_balance }} (LOW STOCK)
            </span>

        @else

            {{ $inventory->stock_balance }}

        @endif

    </div>

    <hr>

    <!-- SERIALS -->

    <div class="section-title">Serial Numbers</div>
    <div class="info">{{ $inventory->serial_numbers }}</div>

    <div class="section-title">Tag Numbers</div>
    <div class="info">{{ $inventory->tag_numbers }}</div>

    <div class="section-title">Comments</div>
    <div class="info">{{ $inventory->comments }}</div>

    <hr>

    <!-- RECEIVER -->

    <div class="info-grid">

        <div class="info">
            <strong>Received By</strong>
            {{ $inventory->receiver->name ?? 'N/A' }}
        </div>

        <div class="info">
            <strong>Date Received</strong>
            {{ $inventory->date_received }}
        </div>

    </div>

</div>

@endsection