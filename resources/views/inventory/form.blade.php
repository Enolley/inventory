<style>

    .form-section{
        background:#fff;
        padding:22px;
        border-radius:24px;
    }

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

    .divider{
        margin:25px 0;
        border:0;
        border-top:1px solid #eef2f7;
    }

    @media(max-width:768px){
        .grid-2{
            grid-template-columns:1fr;
        }
    }

</style>

<div class="form-section">

    <!-- ITEM NAME -->

    <div class="form-group">

        <label>Item Name</label>

        <input type="text"
               name="item_name"
               class="form-control"
               value="{{ old('item_name', $inventory->item_name ?? '') }}"
               required>

    </div>

    <!-- DROPDOWNS -->

    <div class="grid-2">

        <div class="form-group">

            <label>Category</label>

            <select name="category_id" class="form-control">

                @foreach($categories as $cat)

                    <option value="{{ $cat->id }}"
                        @selected(old('category_id', $inventory->category_id ?? '') == $cat->id)>
                        {{ $cat->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <div class="form-group">

            <label>Brand</label>

            <select name="brand_id" class="form-control">

                @foreach($brands as $brand)

                    <option value="{{ $brand->id }}"
                        @selected(old('brand_id', $inventory->brand_id ?? '') == $brand->id)>
                        {{ $brand->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <div class="form-group">

            <label>Unit</label>

            <select name="unit_id" class="form-control">

                @foreach($units as $unit)

                    <option value="{{ $unit->id }}"
                        @selected(old('unit_id', $inventory->unit_id ?? '') == $unit->id)>
                        {{ $unit->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <div class="form-group">

            <label>Location</label>

            <select name="location_id" class="form-control">

                @foreach($locations as $loc)

                    <option value="{{ $loc->id }}"
                        @selected(old('location_id', $inventory->location_id ?? '') == $loc->id)>
                        {{ $loc->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <div class="form-group">

            <label>Supplier</label>

            <select name="supplier_id" class="form-control">

                @foreach($suppliers as $sup)

                    <option value="{{ $sup->id }}"
                        @selected(old('supplier_id', $inventory->supplier_id ?? '') == $sup->id)>
                        {{ $sup->name }}
                    </option>

                @endforeach

            </select>

        </div>

    </div>

    <hr class="divider">

    <!-- QUANTITIES + PRICES -->

    <div class="grid-2">

        <div class="form-group">

            <label>Quantity Bought</label>

            <input type="number"
                   name="quantity_bought"
                   class="form-control"
                   value="{{ old('quantity_bought', $inventory->quantity_bought ?? 0) }}">

        </div>

        <div class="form-group">

            <label>Quantity Received</label>

            <input type="number"
                   name="quantity_received"
                   class="form-control"
                   value="{{ old('quantity_received', $inventory->quantity_received ?? 0) }}">

        </div>

        <div class="form-group">

            <label>Unit Price</label>

            <input type="number"
                   step="0.01"
                   name="unit_price"
                   class="form-control"
                   value="{{ old('unit_price', $inventory->unit_price ?? 0) }}">

        </div>

        <div class="form-group">

            <label>Total Price (auto-calculated)</label>

            <input type="number"
                   step="0.01"
                   readonly
                   class="form-control"
                   value="{{ old('total_price', $inventory->total_price ?? 0) }}"
                   style="background:#f1f5f9;">

        </div>

    </div>

    <hr class="divider">

    <!-- SERIALS -->

    <div class="form-group">

        <label>Serial Numbers (comma separated)</label>

        <textarea name="serial_numbers"
                  class="form-control">{{ old('serial_numbers', $inventory->serial_numbers ?? '') }}</textarea>

    </div>

    <div class="form-group">

        <label>Tag Numbers (asset tags)</label>

        <textarea name="tag_numbers"
                  class="form-control">{{ old('tag_numbers', $inventory->tag_numbers ?? '') }}</textarea>

    </div>

    <div class="form-group">

        <label>Comments</label>

        <textarea name="comments"
                  class="form-control">{{ old('comments', $inventory->comments ?? '') }}</textarea>

    </div>

</div>