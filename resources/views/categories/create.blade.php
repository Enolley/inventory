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

    .alert-errors{
        background:#fee2e2;
        border:1px solid #fecaca;
        color:#991b1b;
        padding:16px;
        border-radius:16px;
        margin-bottom:20px;
        font-size:14px;
    }

    .alert-errors ul{
        margin-left:18px;
    }

    .btn-save{
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

<a href="{{ route('categories.index') }}" class="back-link">
    ← Back to Categories
</a>

<div class="form-card">

    <div class="form-header">

        <h2>Add Category</h2>

        <p>Create and organize your inventory categories</p>

    </div>

    @if($errors->any())

        <div class="alert-errors">

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form method="POST" action="{{ route('categories.store') }}">

        @csrf

        @include('categories.form')

        <button type="submit" class="btn-save">
            Save Category
        </button>

    </form>

</div>

@endsection