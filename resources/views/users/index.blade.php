@extends('layouts.app')

@section('content')

<style>

    .page-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        flex-wrap:wrap;
        gap:15px;
        margin-bottom:20px;
    }

    .page-header h2{
        font-size:30px;
        color:#042159;
    }

    .btn-primary{
        background:linear-gradient(135deg,#0D6EFD,#1d4ed8);
        color:white;
        padding:12px 18px;
        border-radius:14px;
        text-decoration:none;
        font-weight:600;
        transition:0.3s ease;
        box-shadow:0 6px 18px rgba(13,110,253,0.2);
    }

    .btn-primary:hover{
        transform:translateY(-2px);
    }

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
        min-width:700px;
    }

    thead tr{
        background:#f8fafc;
    }

    th{
        text-align:left;
        padding:14px;
        font-size:12px;
        text-transform:uppercase;
        letter-spacing:0.5px;
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

    .user-name{
        font-weight:600;
        color:#042159;
    }

.role-badge{
    display:inline-block;
    padding:7px 14px;
    border-radius:30px;
    font-size:12px;
    font-weight:700;
    text-transform:capitalize;
    letter-spacing:0.3px;
}

/* Admin */

.role-admin{
    background:#dbeafe;
    color:#1d4ed8;
}

/* Viewer */

.role-viewer{
    background:#ede9fe;
    color:#7c3aed;
}

/* Storekeeper */

.role-storekeeper{
    background:#dcfce7;
    color:#15803d;
}

/* Department Officer */

.role-department_officer{
    background:#fef3c7;
    color:#b45309;
}

    .actions a{
        color:#005792;
        font-weight:600;
        text-decoration:none;
    }

    .actions a:hover{
        text-decoration:underline;
    }

    .empty-state{
        text-align:center;
        padding:30px;
        color:#64748b;
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

</style>

<div class="page-header">

    <h2>Users</h2>

    <a href="{{ route('users.create') }}"
       class="add-btn">

        + Add User

    </a>

</div>

<div class="table-card">

    <table>

        <thead>

            <tr>

                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

            @forelse($users as $user)

            <tr>

                <td class="user-name">
                    {{ $user->name }}
                </td>

                <td>
                    {{ $user->email }}
                </td>

                <td>

                    <span class="role-badge role-{{ strtolower($user->role) }}">

                        {{ ucfirst($user->role) }}

                    </span>

                </td>

                <td class="actions">

                    <a href="{{ route('users.edit', $user->id) }}" class="edit-btn">
                        Edit
                    </a>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="4" class="empty-state">
                    No users found
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection