@extends('layouts.app')

@section('content')

<style>

    .form-card{
        background:white;
        padding:30px;
        border-radius:24px;
        max-width:750px;
        box-shadow:0 4px 20px rgba(0,0,0,0.05);
    }

    .form-header{
        margin-bottom:25px;
    }

    .form-header h2{
        font-size:28px;
        color:#042159;
        margin-bottom:5px;
    }

    .form-header p{
        color:#64748b;
        font-size:14px;
    }

    .btn-update{
        width:100%;
        background:linear-gradient(135deg,#F7931E,#ff8c00);
        color:white;
        border:none;
        padding:14px 22px;
        border-radius:14px;
        cursor:pointer;
        font-weight:600;
        font-size:15px;
        transition:0.3s ease;
        box-shadow:0 8px 20px rgba(247,147,30,0.25);
        margin-top:10px;
    }

    .btn-update:hover{
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

<a href="{{ route('suppliers.index') }}" class="back-link">
    ← Back to Suppliers
</a>

<div class="form-card">

    <div class="form-header">

        <h2>Edit Supplier</h2>

        <p>Update supplier/vendor information</p>

    </div>

    <form method="POST" action="{{ route('suppliers.update', $supplier->id) }}">

        @csrf
        @method('PUT')

        @include('suppliers.form')

        <button type="submit" class="btn-update">
            Update Supplier
        </button>

    </form>

</div>

@endsection