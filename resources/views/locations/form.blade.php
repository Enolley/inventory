<style>

    .form-group{
        margin-bottom:16px;
    }

    label{
        display:block;
        margin-bottom:8px;
        font-size:14px;
        font-weight:600;
        color:#1e293b;
    }

    .form-control{
        width:100%;
        padding:14px 16px;
        border-radius:14px;
        border:1px solid #e2e8f0;
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

    textarea.form-control{
        min-height:90px;
        resize:vertical;
    }

    .grid-2{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        gap:15px;
    }

    @media(max-width:768px){
        .grid-2{
            grid-template-columns:1fr;
        }
    }

</style>

<!-- NAME + CODE -->

<div class="grid-2">

    <div class="form-group">

        <label>Name</label>

        <input type="text"
               name="name"
               value="{{ old('name', $location->name ?? '') }}"
               required
               class="form-control">

    </div>

    <div class="form-group">

        <label>Code</label>

        <input type="text"
               name="code"
               value="{{ old('code', $location->code ?? '') }}"
               required
               class="form-control">

    </div>

</div>

<!-- ADDRESS -->

<div class="form-group">

    <label>Address</label>

    <textarea name="address"
              class="form-control">{{ old('address', $location->address ?? '') }}</textarea>

</div>

<!-- CONTACT -->

<div class="grid-2">

    <div class="form-group">

        <label>Phone</label>

        <input type="text"
               name="phone"
               value="{{ old('phone', $location->phone ?? '') }}"
               class="form-control">

    </div>

    <div class="form-group">

        <label>Email</label>

        <input type="email"
               name="email"
               value="{{ old('email', $location->email ?? '') }}"
               class="form-control">

    </div>

</div>

<!-- MANAGER -->

<div class="form-group">

    <label>Manager Name</label>

    <input type="text"
           name="manager_name"
           value="{{ old('manager_name', $location->manager_name ?? '') }}"
           class="form-control">

</div>

<!-- STATUS -->

<div class="form-group">

    <label>Status</label>

    <select name="status" class="form-control">

        <option value="1">Active</option>

        <option value="0"
            @selected(old('status', $location->status ?? '') == 0)>
            Inactive
        </option>

    </select>

</div>