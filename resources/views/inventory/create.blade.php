@extends('layouts.app')

@section('content')

<style>

    .form-card{
        background:white;
        padding:30px;
        border-radius:24px;
        max-width:850px;
        box-shadow:0 4px 20px rgba(0,0,0,0.05);
    }

    .form-header{
        margin-bottom:25px;
    }

    .form-header h2{
        font-size:30px;
        color:#042159;
        margin-bottom:5px;
    }

    .form-header p{
        color:#64748b;
        font-size:14px;
    }

    .btn-save{
        width:100%;
        margin-top:15px;
        background:linear-gradient(135deg,#F7931E,#ff8c00);
        color:white;
        padding:14px 22px;
        border:none;
        border-radius:14px;
        font-weight:600;
        font-size:15px;
        cursor:pointer;
        box-shadow:0 8px 20px rgba(247,147,30,0.25);
        transition:0.3s ease;
    }

    .btn-save:hover{
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

</style>

<a href="{{ route('inventory.index') }}" class="back-link">
    ← Back to Inventory
</a>

<div class="form-card">

    <div class="form-header">

        <h2>Add Inventory Item</h2>

        <p>Create and manage stock items in your inventory system</p>

    </div>

    <form method="POST" action="{{ route('inventory.store') }}">

        @csrf

        @include('inventory.form')

        <button type="submit" class="btn-save">
            Save Item
        </button>

    </form>

</div>

@endsection