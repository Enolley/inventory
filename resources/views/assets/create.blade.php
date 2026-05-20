@extends('layouts.app')

@section('content')

<style>

    .page-header{
        margin-bottom:25px;
    }

    .page-header h2{
        font-size:28px;
        color:#042159;
        font-weight:700;
    }

    .form-card{
        background:white;
        padding:30px;
        border-radius:24px;
        max-width:850px;
        box-shadow:0 4px 20px rgba(0,0,0,0.05);
    }

    .save-btn{
        background:linear-gradient(135deg,#0D6EFD,#1d4ed8);
        color:white;
        border:none;
        padding:14px 24px;
        border-radius:14px;
        font-weight:600;
        cursor:pointer;
        transition:0.3s ease;
        box-shadow:0 8px 20px rgba(13,110,253,0.25);
    }

    .save-btn:hover{
        transform:translateY(-2px);
    }

</style>

<div class="page-header">

    <h2>
        Add Asset
    </h2>

</div>

<div class="form-card">

    <form method="POST"
          action="{{ route('assets.store') }}">

        @csrf

        @include('assets.form')

        <button class="save-btn">

            Save Asset

        </button>

    </form>

</div>

@endsection