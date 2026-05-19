@extends('layouts.app')

@section('content')

<style>

    .page-header{
        margin-bottom:25px;
    }

    .page-header h2{
        font-size:32px;
        color:#042159;
        margin-bottom:5px;
    }

    .page-header p{
        color:#64748b;
    }

    /* STAT CARDS */

    .stats-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
        gap:20px;
        margin-bottom:30px;
    }

    .stat-card{
        position:relative;
        overflow:hidden;
        border-radius:22px;
        padding:24px;
        color:white;
        min-height:150px;
        box-shadow:0 10px 30px rgba(0,0,0,0.08);
        transition:0.3s ease;
    }

    .stat-card:hover{
        transform:translateY(-5px);
    }

    .stat-card::before{
        content:'';
        position:absolute;
        width:120px;
        height:120px;
        border-radius:50%;
        background:rgba(255,255,255,0.08);
        top:-40px;
        right:-30px;
    }

    .stat-card h4{
        font-size:15px;
        font-weight:500;
        margin-bottom:18px;
        opacity:0.9;
    }

    .stat-card h2{
        font-size:38px;
        font-weight:700;
    }

    .card-blue{
        background:linear-gradient(135deg,#005792,#0077B6);
    }

    .card-orange{
        background:linear-gradient(135deg,#F7931E,#ff8c00);
    }

    .card-green{
        background:linear-gradient(135deg,#198754,#20c997);
    }

    .card-purple{
        background:linear-gradient(135deg,#6f42c1,#8b5cf6);
    }

    /* CONTENT GRID */

    .grid-2{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(400px,1fr));
        gap:25px;
        margin-bottom:25px;
    }

    .card h3{
        margin-bottom:20px;
        color:#042159;
        font-size:20px;
    }

    .danger-title{
        color:#dc2626 !important;
    }

    /* TABLE */

    table{
        width:100%;
        border-collapse:collapse;
    }

    thead tr{
        background:#f8fafc;
    }

    th{
        text-align:left;
        padding:14px;
        font-size:13px;
        color:#64748b;
        font-weight:600;
    }

    td{
        padding:15px 14px;
        border-bottom:1px solid #f1f5f9;
        font-size:14px;
    }

    tbody tr:hover{
        background:#f8fbff;
    }

    .low-stock{
        color:#dc2626;
        font-weight:700;
    }

    .chart-card{
        background:white;
        padding:25px;
        border-radius:22px;
        box-shadow:0 4px 20px rgba(0,0,0,0.05);
    }

    .chart-card h3{
        margin-bottom:20px;
        color:#042159;
    }

    @media(max-width:768px){

        .grid-2{
            grid-template-columns:1fr;
        }

    }

</style>

<!-- PAGE HEADER -->

<div class="page-header">

    <h2>Dashboard</h2>

    <p>
        Inventory analytics and stock overview
    </p>

</div>

<!-- STAT CARDS -->

<div class="stats-grid">

    <div class="stat-card card-blue">

        <h4>Total Items</h4>

        <h2>{{ $totalItems }}</h2>

    </div>

    <div class="stat-card card-orange">

        <h4>Low Stock Items</h4>

        <h2>{{ $lowStockItems->count() }}</h2>

    </div>

    <div class="stat-card card-green">

        <h4>Total Inventory Value</h4>

        <h2>{{ number_format($totalInventoryValue, 2) }}</h2>

    </div>

    <div class="stat-card card-purple">

        <h4>Accounts</h4>

        <h2>{{ $totalAccounts }}</h2>

    </div>

</div>

<!-- TABLES -->

<div class="grid-2">

    <!-- LOW STOCK -->

    <div class="card">

        <h3 class="danger-title">
            Low Stock Alerts
        </h3>

        <table>

            <thead>

                <tr>

                    <th>Item</th>
                    <th>Balance</th>

                </tr>

            </thead>

            <tbody>

                @forelse($lowStockItems as $item)

                <tr>

                    <td>{{ $item->item_name }}</td>

                    <td class="low-stock">
                        {{ $item->stock_balance }}
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="2">
                        No low stock items
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- RECENT MOVEMENTS -->

    <div class="card">

        <h3>
            Recent Stock Movements
        </h3>

        <table>

            <thead>

                <tr>

                    <th>Item</th>
                    <th>Qty</th>
                    <th>Date</th>

                </tr>

            </thead>

            <tbody>

                @forelse($recentMovements as $move)

                <tr>

                    <td>
                        {{ $move->inventoryItem->item_name ?? '' }}
                    </td>

                    <td>
                        {{ $move->quantity_issued }}
                    </td>

                    <td>
                        {{ $move->issued_at }}
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="3">
                        No stock movements
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<!-- CHART -->

<div class="chart-card">

    <h3>
        Inventory by Category
    </h3>

    <canvas id="inventoryChart"></canvas>

</div>

@endsection

@push('scripts')

<script>

const ctx = document.getElementById('inventoryChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: @json($categoryLabels),

        datasets: [{

            label: 'Items',

            data: @json($categoryCounts),

            borderRadius: 10,

            backgroundColor: [
                '#005792',
                '#0077B6',
                '#F7931E',
                '#20c997',
                '#8b5cf6'
            ]

        }]

    },

    options: {

        responsive:true,

        plugins: {

            legend: {
                display:false
            }

        },

        scales: {

            y: {

                beginAtZero:true,

                grid: {
                    color:'#eef2f7'
                }

            },

            x: {

                grid: {
                    display:false
                }

            }

        }

    }

});

</script>

@endpush