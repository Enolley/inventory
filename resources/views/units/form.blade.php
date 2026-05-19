<style>

    .form-group{
        margin-bottom:18px;
    }

    .form-group label{
        display:block;
        margin-bottom:8px;
        font-weight:600;
        font-size:14px;
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

</style>

<div class="form-group">

    <label>Unit Name</label>

    <input type="text"
           name="name"
           value="{{ old('name', $unit->name ?? '') }}"
           required
           class="form-control">

</div>

<div class="form-group">

    <label>Short Name</label>

    <input type="text"
           name="short_name"
           value="{{ old('short_name', $unit->short_name ?? '') }}"
           class="form-control">

</div>

<div class="form-group">

    <label>Status</label>

    <select name="status" class="form-control">

        <option value="1">Active</option>

        <option value="0"
            @selected(old('status', $unit->status ?? '') == 0)>
            Inactive
        </option>

    </select>

</div>