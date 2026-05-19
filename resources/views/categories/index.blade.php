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
        font-size:32px;
        color:#042159;
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
        flex:1;
        min-width:250px;
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

    .search-btn{
        background:#042159;
        color:white;
        border:none;
        padding:14px 18px;
        border-radius:14px;
        cursor:pointer;
        font-weight:600;
    }

    .search-btn:hover{
        opacity:0.9;
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
        min-width:800px;
    }

    thead tr{
        background:#f8fafc;
    }

    th{
        text-align:left;
        padding:16px;
        font-size:13px;
        color:#64748b;
        font-weight:600;
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

    /* STATUS */

    .status{
        display:inline-block;
        padding:6px 12px;
        border-radius:999px;
        font-size:12px;
        font-weight:600;
    }

    .active{
        background:#dcfce7;
        color:#166534;
    }

    .inactive{
        background:#fee2e2;
        color:#991b1b;
    }

    /* ACTIONS */

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

    /* EMPTY */

    .empty{
        text-align:center;
        padding:40px;
        color:#64748b;
    }

</style>

<!-- HEADER -->

<div class="page-header">

    <h2>Categories</h2>

    <a href="{{ route('categories.create') }}" class="add-btn">
        + Add Category
    </a>

</div>

<!-- SEARCH -->

<div class="search-card">

    <form class="search-form">

        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="Search category..."
               class="search-input">

        <button class="search-btn">
            Search
        </button>

    </form>

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

                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

            @forelse($categories as $category)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td><strong>{{ $category->name }}</strong></td>

                <td>{{ $category->description }}</td>

                <td>

                    @if($category->status)

                        <span class="status active">Active</span>

                    @else

                        <span class="status inactive">Inactive</span>

                    @endif

                </td>

                <td class="actions">

                    <a href="{{ route('categories.edit', $category->id) }}" class="edit-btn">
                        Edit
                    </a>

                    <form method="POST"
                          action="{{ route('categories.destroy', $category->id) }}"
                          style="display:inline;">

                        @csrf
                        @method('DELETE')

                        <button class="delete-btn"
                                onclick="return confirm('Delete category?')">

                            Delete

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="5" class="empty">
                    No categories found
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection