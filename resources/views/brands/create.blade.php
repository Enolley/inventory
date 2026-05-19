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

    .form-group{
        margin-bottom:18px;
    }

    label{
        display:block;
        margin-bottom:8px;
        font-size:14px;
        font-weight:600;
        color:#1e293b;
    }

    input, select{
        width:100%;
        padding:14px 16px;
        border-radius:14px;
        border:1px solid #e2e8f0;
        outline:none;
        font-size:14px;
        transition:0.3s ease;
        background:#f8fafc;
    }

    input:focus, select:focus{
        border-color:#F7931E;
        box-shadow:0 0 0 4px rgba(247,147,30,0.15);
        background:white;
    }

    .btn-save{
        background:linear-gradient(135deg,#F7931E,#ff8c00);
        color:white;
        padding:14px 22px;
        border:none;
        border-radius:14px;
        font-weight:600;
        cursor:pointer;
        transition:0.3s ease;
        box-shadow:0 8px 20px rgba(247,147,30,0.25);
        width:100%;
        font-size:15px;
    }

    .btn-save:hover{
        transform:translateY(-2px);
    }

    .back-link{
        display:inline-block;
        margin-bottom:20px;
        color:#005792;
        text-decoration:none;
        font-weight:600;
        font-size:14px;
    }

    .back-link:hover{
        text-decoration:underline;
    }

</style>

<a href="{{ route('brands.index') }}" class="back-link">
    ← Back to Brands
</a>

<div class="form-card">

    <div class="form-header">

        <h2>Add Brand</h2>

        <p>Create a new brand for your inventory system</p>

    </div>

    <form method="POST" action="{{ route('brands.store') }}">

        @csrf

        @include('brands.form')

        <button type="submit" class="btn-save">
            Save Brand
        </button>

    </form>

</div>

@endsection