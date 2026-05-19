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
    }

    .form-header p{
        font-size:14px;
        color:#64748b;
        margin-top:5px;
    }

    .btn-primary{
        width:100%;
        background:linear-gradient(135deg,#0D6EFD,#1d4ed8);
        color:white;
        padding:14px 22px;
        border:none;
        border-radius:14px;
        cursor:pointer;
        font-weight:600;
        font-size:15px;
        transition:0.3s ease;
        box-shadow:0 8px 20px rgba(13,110,253,0.25);
        margin-top:10px;
    }

    .btn-primary:hover{
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

<a href="{{ route('units.index') }}" class="back-link">
    ← Back to Units
</a>

<div class="form-card">

    <div class="form-header">

        <h2>Add Unit</h2>
        <p>Create a new measurement unit (e.g. pcs, box, kg)</p>

    </div>

    <form method="POST" action="{{ route('units.store') }}">

        @csrf

        @include('units.form')

        <button type="submit" class="btn-primary">
            Save Unit
        </button>

    </form>

</div>

@endsection