@extends('layouts.app')

@section('content')

<style>

    .form-wrapper{
        background:#fff;
        padding:35px;
        border-radius:24px;
        max-width:720px;
        box-shadow:0 10px 30px rgba(0,0,0,0.05);
        border:1px solid #eef2f7;
    }

    .page-title{
        font-size:30px;
        font-weight:700;
        color:#042159;
        margin-bottom:25px;
    }

    .submit-btn{
        background:linear-gradient(135deg,#0D6EFD,#1d4ed8);
        color:#fff;
        border:none;
        padding:14px 24px;
        border-radius:14px;
        font-size:15px;
        font-weight:600;
        cursor:pointer;
        transition:0.3s ease;
        box-shadow:0 8px 20px rgba(13,110,253,0.25);
    }

    .submit-btn:hover{
        transform:translateY(-2px);
        opacity:0.95;
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

<a href="{{ route('users.index') }}" class="back-link">
    ← Back to Users
</a>

<div class="form-wrapper">

    <h2 class="page-title">
        Add User
    </h2>

    <form method="POST" action="{{ route('users.store') }}">

        @csrf

        @include('users.form')

        <button class="submit-btn">

            Save User

        </button>

    </form>

</div>

@endsection