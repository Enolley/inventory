<style>

    .form-group{
        margin-bottom:18px;
    }

    .form-group label{
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
        outline:none;
        font-size:14px;
        background:#f8fafc;
        transition:0.3s ease;
    }

    .form-control:focus{
        border-color:#F7931E;
        box-shadow:0 0 0 4px rgba(247,147,30,0.15);
        background:#fff;
    }

    textarea.form-control{
        min-height:120px;
        resize:vertical;
    }

</style>

<!-- CATEGORY -->

<div class="form-group">

    <label>Category</label>

    <select name="category_id"
            class="form-control"
            required>

        <option value="">-- Select Category --</option>

        @foreach($categories as $category)

            <option value="{{ $category->id }}"
                @selected(old('category_id', $brand->category_id ?? '') == $category->id)>

                {{ $category->name }}

            </option>

        @endforeach

    </select>

</div>

<!-- BRAND NAME -->

<div class="form-group">

    <label>Brand Name</label>

    <input type="text"
           name="name"
           class="form-control"
           value="{{ old('name', $brand->name ?? '') }}"
           required>

</div>

<!-- DESCRIPTION -->

<div class="form-group">

    <label>Description</label>

    <textarea name="description"
              class="form-control">{{ old('description', $brand->description ?? '') }}</textarea>

</div>

<!-- STATUS -->

<div class="form-group">

    <label>Status</label>

    <select name="status"
            class="form-control">

        <option value="1" @selected(old('status', $brand->status ?? '') == 1)>
            Active
        </option>

        <option value="0" @selected(old('status', $brand->status ?? '') == 0)>
            Inactive
        </option>

    </select>

</div>