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
        outline:none;
        font-size:14px;
        transition:0.3s ease;
    }

    .form-control:focus{
        border-color:#F7931E;
        background:#fff;
        box-shadow:0 0 0 4px rgba(247,147,30,0.15);
    }

    textarea.form-control{
        min-height:110px;
        resize:vertical;
    }

</style>

<div class="form-group">

    <label>Supplier Name</label>

    <input type="text"
           name="name"
           value="{{ old('name', $supplier->name ?? '') }}"
           required
           class="form-control">

</div>

<div class="form-group">

    <label>Phone</label>

    <input type="text"
           name="phone"
           value="{{ old('phone', $supplier->phone ?? '') }}"
           class="form-control">

</div>

<div class="form-group">

    <label>Email</label>

    <input type="email"
           name="email"
           value="{{ old('email', $supplier->email ?? '') }}"
           class="form-control">

</div>

<div class="form-group">

    <label>Address</label>

    <textarea name="address"
              class="form-control">{{ old('address', $supplier->address ?? '') }}</textarea>

</div>

<div class="form-group">

    <label>Contact Person</label>

    <input type="text"
           name="contact_person"
           value="{{ old('contact_person', $supplier->contact_person ?? '') }}"
           class="form-control">

</div>

<div class="form-group">

    <label>Status</label>

    <select name="status" class="form-control">

        <option value="1">Active</option>

        <option value="0"
            @selected(old('status', $supplier->status ?? '') == 0)>
            Inactive
        </option>

    </select>

</div>