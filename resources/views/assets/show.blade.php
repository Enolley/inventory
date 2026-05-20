@extends('layouts.app')

@section('content')

<style>

    .page-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        flex-wrap:wrap;
        gap:15px;
        margin-bottom:25px;
    }

    .page-header h2{
        font-size:30px;
        color:#042159;
        font-weight:700;
    }

    .back-btn{
        background:#64748b;
        color:white;
        padding:12px 18px;
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
        border-radius:26px;
        padding:30px;
        box-shadow:0 4px 20px rgba(0,0,0,0.05);
    }

    .asset-title{
        display:flex;
        justify-content:space-between;
        align-items:center;
        flex-wrap:wrap;
        gap:15px;
        margin-bottom:25px;
    }

    .asset-title h3{
        font-size:28px;
        color:#042159;
        font-weight:700;
    }

    .status-badge{
        display:inline-flex;
        align-items:center;
        padding:8px 16px;
        border-radius:30px;
        font-size:13px;
        font-weight:600;
    }

    .status-active{
        background:#dcfce7;
        color:#166534;
    }

    .status-repair{
        background:#fef3c7;
        color:#b45309;
    }

    .status-disposed{
        background:#fee2e2;
        color:#b91c1c;
    }

    .status-faulty{
        background:#fee2e2;
        color:#dc2626;
    }

    .info-grid{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:25px;
        margin-bottom:25px;
    }

    .info-card{
        background:#f8fafc;
        border-radius:20px;
        padding:22px;
    }

    .info-card h4{
        margin-bottom:18px;
        font-size:16px;
        color:#042159;
        font-weight:700;
    }

    .info-item{
        margin-bottom:16px;
    }

    .info-item:last-child{
        margin-bottom:0;
    }

    .info-label{
        font-size:13px;
        color:#64748b;
        margin-bottom:4px;
        font-weight:500;
    }

    .info-value{
        font-size:15px;
        color:#1e293b;
        font-weight:600;
    }

    .transfer-box{
        background:#fff7ed;
        border:1px solid #fed7aa;
        padding:20px;
        border-radius:18px;
        margin-bottom:25px;
    }

    .transfer-box h4{
        color:#c2410c;
        margin-bottom:10px;
    }

    .edit-btn{
        display:inline-flex;
        align-items:center;
        gap:10px;
        background:linear-gradient(135deg,#F7931E,#ff8c00);
        color:white;
        padding:14px 22px;
        border-radius:14px;
        text-decoration:none;
        font-weight:600;
        transition:0.3s ease;
        box-shadow:0 8px 20px rgba(247,147,30,0.25);
    }

    .edit-btn:hover{
        transform:translateY(-2px);
    }

    @media(max-width:768px){

        .info-grid{
            grid-template-columns:1fr;
        }

        .asset-title{
            align-items:flex-start;
        }

    }

</style>

<div class="page-header">

    <h2>
        Asset Details
    </h2>

    <a href="{{ route('assets.index') }}"
       class="back-btn">

        ← Back

    </a>

</div>

<div class="details-card">

    <div class="asset-title">

        <h3>
            {{ $asset->name }}
        </h3>

        @if($asset->is_faulty)

            <span class="status-badge status-faulty">
                Faulty Asset
            </span>

        @else

            <span class="status-badge status-{{ $asset->status }}">
                {{ ucfirst($asset->status) }}
            </span>

        @endif

    </div>

    <div class="info-grid">

        <div class="info-card">

            <h4>
                Basic Information
            </h4>

            <div class="info-item">

                <div class="info-label">
                    Serial Number
                </div>

                <div class="info-value">
                    {{ $asset->serial_number ?? 'N/A' }}
                </div>

            </div>

            <div class="info-item">

                <div class="info-label">
                    Tag Number
                </div>

                <div class="info-value">
                    {{ $asset->tag_number }}
                </div>

            </div>

            <div class="info-item">

                <div class="info-label">
                    Date Bought
                </div>

                <div class="info-value">
                    {{ $asset->date_bought }}
                </div>

            </div>

        </div>

        <div class="info-card">

            <h4>
                Financial Information
            </h4>

            <div class="info-item">

                <div class="info-label">
                    Buying Price
                </div>

                <div class="info-value">
                    {{ number_format($asset->buying_price, 2) }}
                </div>

            </div>

            <div class="info-item">

                <div class="info-label">
                    Depreciation Rate
                </div>

                <div class="info-value">
                    {{ $asset->depreciation_rate }}%
                </div>

            </div>

            <div class="info-item">

                <div class="info-label">
                    Current Price
                </div>

                <div class="info-value">
                    {{ number_format($asset->current_price, 2) }}
                </div>

            </div>

        </div>

    </div>

    <div class="info-grid">

        <div class="info-card">

            <h4>
                Assigned Location
            </h4>

            <div class="info-value">
                {{ $asset->assignedLocation->name ?? 'N/A' }}
            </div>

        </div>

        <div class="info-card">

            <h4>
                Current Location
            </h4>

            <div class="info-value">
                {{ $asset->currentLocation->name ?? 'N/A' }}
            </div>

        </div>

    </div>

    <div class="transfer-box">

        <h4>
            Transfer Status
        </h4>

        @if($asset->is_transferred)

            <p>
                This asset has been transferred from its assigned location.
            </p>

        @else

            <p>
                This asset has not been transferred.
            </p>

        @endif

    </div>

    <a href="{{ route('assets.edit', $asset->id) }}"
       class="edit-btn">

        ✏ Edit Asset

    </a>

</div>

@endsection