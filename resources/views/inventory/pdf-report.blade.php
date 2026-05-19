<!DOCTYPE html>
<html>
<head>

    <title>Inventory PDF Report</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            padding: 25px;
            color: #1e293b;
        }

        h2{
            margin-bottom: 20px;
            color:#042159;
        }

        /* SUMMARY CARDS */

        .cards{
            display:flex;
            gap:15px;
            margin-bottom:25px;
        }

        .card{
            flex:1;
            padding:18px;
            border-radius:14px;
            background:#f8fafc;
            border:1px solid #e2e8f0;
        }

        .card h4{
            margin-bottom:10px;
            font-size:14px;
            color:#64748b;
        }

        .card h2{
            font-size:24px;
            color:#042159;
            margin:0;
        }

        /* TABLE */

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:10px;
        }

        th, td{
            border:1px solid #e2e8f0;
            padding:10px;
            font-size:13px;
        }

        th{
            background:#0D6EFD;
            color:white;
            text-align:left;
            font-size:12px;
            text-transform:uppercase;
            letter-spacing:0.5px;
        }

        tr:nth-child(even){
            background:#f8fafc;
        }

        .low{
            color:#dc2626;
            font-weight:700;
        }

        .footer{
            margin-top:20px;
            font-size:12px;
            color:#64748b;
            text-align:right;
        }

    </style>

</head>

<body>

<h2>Inventory Report</h2>

<div class="cards">

    <div class="card">
        <h4>Total Items</h4>
        <h2>{{ $items->count() }}</h2>
    </div>

    <div class="card">
        <h4>Low Stock</h4>
        <h2>{{ $items->where('stock_balance', '<=', 3)->count() }}</h2>
    </div>

    <div class="card">
        <h4>Total Value</h4>
        <h2>{{ number_format($items->sum('total_price'), 2) }}</h2>
    </div>

</div>

<table>

    <thead>

        <tr>

            <th>Item</th>
            <th>Category</th>
            <th>Location</th>
            <th>Balance</th>
            <th>Total Value</th>

        </tr>

    </thead>

    <tbody>

        @foreach($items as $item)

        <tr>

            <td>{{ $item->item_name }}</td>

            <td>{{ $item->category->name ?? '' }}</td>

            <td>{{ $item->location->name ?? '' }}</td>

            <td>
                @if($item->stock_balance <= 3)
                    <span class="low">{{ $item->stock_balance }}</span>
                @else
                    {{ $item->stock_balance }}
                @endif
            </td>

            <td>{{ number_format($item->total_price, 2) }}</td>

        </tr>

        @endforeach

    </tbody>

</table>

<div class="footer">
    Generated on {{ now() }}
</div>

<script>
    window.print();
</script>

</body>
</html>