<style>

    .form-group{
        margin-bottom:20px;
    }

    .form-group label{
        display:block;
        margin-bottom:8px;
        font-size:14px;
        font-weight:600;
        color:#042159;
    }

    .form-control{
        width:100%;
        padding:14px 16px;
        border:1px solid #e2e8f0;
        border-radius:14px;
        background:#f8fafc;
        font-size:14px;
        outline:none;
        transition:0.3s ease;
    }

    .form-control:focus{
        border-color:#F7931E;
        background:#fff;
        box-shadow:0 0 0 4px rgba(247,147,30,0.15);
    }

    .password-hint{
        margin-top:6px;
        font-size:12px;
        color:#64748b;
    }

</style>

<div class="form-group">

    <label>Name</label>

    <input type="text"
           name="name"
           value="{{ old('name', $user->name ?? '') }}"
           class="form-control"
           required>

</div>

<div class="form-group">

    <label>Email</label>

    <input type="email"
           name="email"
           value="{{ old('email', $user->email ?? '') }}"
           class="form-control"
           required>

</div>

<div class="form-group">

    <label>Password</label>

    <input type="password"
           name="password"
           class="form-control">

    <div class="password-hint">
        Leave blank if you do not want to change the password
    </div>

</div>

<div class="form-group">

    <label>Role</label>

    <select name="role"
            class="form-control">

        <option value="admin"
            @selected(old('role', $user->role ?? '') == 'admin')>
            Admin
        </option>

        <option value="storekeeper"
            @selected(old('role', $user->role ?? '') == 'storekeeper')>
            Storekeeper
        </option>

        <option value="viewer"
            @selected(old('role', $user->role ?? '') == 'viewer')>
            Viewer
        </option>

        <option value="department_officer"
            @selected(old('role', $user->role ?? '') == 'department_officer')>

            Department Officer

        </option>

    </select>

</div>