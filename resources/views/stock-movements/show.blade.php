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
        color:white;
        padding:12px 16px;
        border-radius:14px;
        text-decoration:none;
        font-weight:600;
        transition:0.3s ease;
    }

    .back-btn:hover{
        background:#475569;
    }

    .details-card{
        background:white;
        padding:30px;
        border-radius:24px;
        box-shadow:0 4px 20px rgba(0,0,0,0.05);
        max-width:850px;
    }

    .detail-grid{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        gap:20px;
    }

    .detail-item{
        padding:16px;
        background:#f8fafc;
        border-radius:16px;
        border:1px solid #eef2f7;
    }

    .detail-item strong{
        display:block;
        margin-bottom:8px;
        font-size:12px;
        text-transform:uppercase;
        letter-spacing:0.5px;
        color:#64748b;
    }

    .detail-value{
        font-size:15px;
        color:#1e293b;
        font-weight:600;
    }

    .full-width{
        grid-column:1 / -1;
    }

    .item-highlight{
        background:linear-gradient(135deg,#0D6EFD,#1d4ed8);
        color:white;
        border:none;
    }

    .item-highlight strong{
        color:rgba(255,255,255,0.8);
    }

    .item-highlight .detail-value{
        color:white;
        font-size:18px;
    }

    @media(max-width:768px){

        .detail-grid{
            grid-template-columns:1fr;
        }

    }

</style>

<!-- HEADER -->

<div class="page-header">

    <h2>Stock Movement Details</h2>

    <a href="{{ route('stock-movements.index') }}" class="back-btn">
        ← Back
    </a>

</div>

<!-- DETAILS CARD -->

<div class="details-card">

    <div class="detail-grid">

        <!-- ITEM -->

        <div class="detail-item item-highlight full-width">

            <strong>Inventory Item</strong>

            <div class="detail-value">
                {{ $stockMovement->inventoryItem->item_name ?? '' }}
            </div>

        </div>

        <!-- QUANTITY -->

        <div class="detail-item">

            <strong>Quantity Issued</strong>

            <div class="detail-value">
                {{ $stockMovement->quantity_issued }}
            </div>

        </div>

        <!-- ISSUED TO -->

        <div class="detail-item">

            <strong>Issued To</strong>

            <div class="detail-value">
                {{ $stockMovement->issued_to }}
            </div>

        </div>

        <!-- DEPARTMENT -->

        <div class="detail-item">

            <strong>Department</strong>

            <div class="detail-value">
                {{ $stockMovement->department }}
            </div>

        </div>

        <!-- ISSUED BY -->

        <div class="detail-item">

            <strong>Issued By</strong>

            <div class="detail-value">
                {{ $stockMovement->issuer->name ?? '' }}
            </div>

        </div>

        <!-- PURPOSE -->

        <div class="detail-item full-width">

            <strong>Purpose</strong>

            <div class="detail-value">
                {{ $stockMovement->purpose }}
            </div>

        </div>

        <!-- DATE -->

        <div class="detail-item full-width">

            <strong>Date Issued</strong>

            <div class="detail-value">
                {{ $stockMovement->issued_at }}
            </div>

        </div>

    </div>

</div>

@endsection