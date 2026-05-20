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
    font-size:28px;
    color:#042159;
}

.add-btn{
    background:linear-gradient(135deg,#0D6EFD,#1d4ed8);
    color:#fff;
    padding:12px 18px;
    border-radius:14px;
    text-decoration:none;
    font-weight:600;
    box-shadow:0 6px 18px rgba(13,110,253,0.2);
    transition:0.3s ease;
}

.add-btn:hover{
    transform:translateY(-2px);
}

.table-card{
    background:#fff;
    border-radius:24px;
    padding:20px;
    box-shadow:0 4px 20px rgba(0,0,0,0.05);
    overflow:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    min-width:800px;
}

thead tr{
    background:#f8fafc;
}

th{
    text-align:left;
    padding:14px;
    font-size:12px;
    text-transform:uppercase;
    color:#64748b;
}

td{
    padding:16px 14px;
    border-bottom:1px solid #eef2f7;
    font-size:14px;
    color:#1e293b;
}

tbody tr:hover{
    background:#f9fbff;
}

.badge{
    display:inline-block;
    padding:6px 12px;
    border-radius:30px;
    font-size:12px;
    font-weight:700;
}

.badge-ok{
    background:#dcfce7;
    color:#166534;
}

.badge-faulty{
    background:#fee2e2;
    color:#991b1b;
}

.actions a{
    text-decoration:none;
    font-weight:600;
    color:#0D6EFD;
    margin-right:8px;
}

.actions a:hover{
    text-decoration:underline;
}

.actions form{
    display:inline;
}

.actions button{
    border:none;
    background:none;
    color:#dc2626;
    cursor:pointer;
    font-weight:600;
}

</style>

<div class="page-header">

    <h2>
        <i class="fa-solid fa-boxes-stacked"></i>
        Assets
    </h2>

    <a href="{{ route('assets.create') }}" class="add-btn">
        + Add Asset
    </a>

</div>

<div class="table-card">

<table>

    <thead>

        <tr>

            <th>Name</th>
            <th>Tag</th>
            <th>Current Price</th>
            <th>Location</th>
            <th>Status</th>
            <th>Actions</th>

        </tr>

    </thead>

    <tbody>

        @forelse($assets as $asset)

        <tr>

            <td>
                <strong>{{ $asset->name }}</strong>
            </td>

            <td>{{ $asset->tag_number }}</td>

            <td>
                {{ number_format($asset->current_price, 2) }}
            </td>

            <td>
                {{ $asset->currentLocation->name ?? 'N/A' }}
            </td>

            <td>

                @if($asset->is_faulty)

                    <span class="badge badge-faulty">
                        Faulty
                    </span>

                @else

                    <span class="badge badge-ok">
                        {{ ucfirst($asset->status) }}
                    </span>

                @endif

            </td>

            <td class="actions">

                <a href="{{ route('assets.show', $asset->id) }}">
                    View
                </a>

                <a href="{{ route('assets.edit', $asset->id) }}">
                    Edit
                </a>

                <form method="POST"
                      action="{{ route('assets.destroy', $asset->id) }}">

                    @csrf
                    @method('DELETE')

                    <button onclick="return confirm('Delete asset?')">
                        Delete
                    </button>

                </form>

            </td>

        </tr>

        @empty

        <tr>
            <td colspan="6" style="text-align:center;color:#64748b;padding:30px;">
                No assets found
            </td>
        </tr>

        @endforelse

    </tbody>

</table>

</div>

@endsection