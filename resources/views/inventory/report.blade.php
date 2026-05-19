<!DOCTYPE html>
<html>
<head>

    <title>Inventory Report</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            padding: 30px;
            color: #1e293b;
        }

        h2{
            color:#042159;
            margin-bottom:20px;
        }

        /* TABLE */

        table{
            width:100%;
            border-collapse:collapse;
            font-size:14px;
        }

        th, td{
            border:1px solid #e2e8f0;
            padding:12px;
            text-align:left;
        }

        th{
            background:#0D6EFD;
            color:white;
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

        .header-bar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:15px;
        }

        .tag{
            font-size:12px;
            color:#64748b;
        }

    </style>

</head>

<body>

<div class="header-bar">

    <h2>Inventory Report</h2>

    <div class="tag">
        Generated: {{ now() }}
    </div>

</div>

<table>

    <thead>

        <tr>

            <th>Item</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Location</th>
            <th>Balance</th>

        </tr>

    </thead>

    <tbody>

        @foreach($items as $item)

        <tr>

            <td><strong>{{ $item->item_name }}</strong></td>

            <td>{{ $item->category->name ?? '' }}</td>

            <td>{{ $item->brand->name ?? '' }}</td>

            <td>{{ $item->location->name ?? '' }}</td>

            <td>
                @if($item->stock_balance <= 3)
                    <span class="low">{{ $item->stock_balance }}</span>
                @else
                    {{ $item->stock_balance }}
                @endif
            </td>

        </tr>

        @endforeach

    </tbody>

</table>

<script>
    window.print();
</script>

</body>
</html>