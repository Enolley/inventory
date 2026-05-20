<style>

    .asset-form-card{
        background:#ffffff;
        padding:30px;
    }

    .form-grid{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:20px;
    }

    .form-group{
        margin-bottom:20px;
    }

    .form-group.full-width{
        grid-column:1 / -1;
    }

    .form-label{
        display:block;
        margin-bottom:8px;
        font-size:14px;
        font-weight:600;
        color:#334155;
    }

    .form-control{
        width:100%;
        padding:14px;
        border:1px solid #dbe3ee;
        border-radius:14px;
        background:#fff;
        font-size:14px;
        transition:0.3s ease;
    }

    .form-control:focus{
        outline:none;
        border-color:#0D6EFD;
        box-shadow:0 0 0 4px rgba(13,110,253,0.1);
    }

    .readonly-input{
        background:#f8fafc;
        color:#64748b;
        font-weight:600;
    }

    .checkbox-group{
        display:flex;
        gap:25px;
        flex-wrap:wrap;
        margin-top:10px;
    }

    .checkbox-item{
        display:flex;
        align-items:center;
        gap:10px;
        background:#f8fafc;
        padding:12px 16px;
        border-radius:14px;
    }

    .checkbox-item input{
        width:18px;
        height:18px;
        accent-color:#0D6EFD;
    }

    .checkbox-item label{
        font-size:14px;
        font-weight:500;
        color:#334155;
        cursor:pointer;
    }

    .section-title{
        font-size:16px;
        font-weight:700;
        color:#042159;
        margin-bottom:18px;
    }

    @media(max-width:768px){

        .form-grid{
            grid-template-columns:1fr;
        }

    }

</style>

<div class="asset-form-card">

    <div class="section-title">
        Asset Information
    </div>

    <div class="form-group">

        <label class="form-label">
            Asset Name
        </label>

        <input type="text"
               name="name"
               value="{{ old('name', $asset->name ?? '') }}"
               class="form-control">

    </div>

    <div class="form-grid">

        <div class="form-group">

            <label class="form-label">
                Serial Number
            </label>

            <input type="text"
                   name="serial_number"
                   value="{{ old('serial_number', $asset->serial_number ?? '') }}"
                   class="form-control">

        </div>

        <div class="form-group">

            <label class="form-label">
                Tag Number
            </label>

            <input type="text"
                   name="tag_number"
                   value="{{ old('tag_number', $asset->tag_number ?? '') }}"
                   class="form-control">

        </div>

        <div class="form-group">

            <label class="form-label">
                Buying Price
            </label>

            <input type="number"
                   step="0.01"
                   name="buying_price"
                   value="{{ old('buying_price', $asset->buying_price ?? '') }}"
                   class="form-control">

        </div>

        <div class="form-group">

            <label class="form-label">
                Depreciation Rate (%)
            </label>

            <input type="number"
                   step="0.01"
                   name="depreciation_rate"
                   value="{{ old('depreciation_rate', $asset->depreciation_rate ?? '') }}"
                   class="form-control">

        </div>

        <div class="form-group">

            <label class="form-label">
                Estimated Current Price
            </label>

            <input type="text"
                   id="currentPricePreview"
                   readonly
                   class="form-control readonly-input">

        </div>

        <div class="form-group">

            <label class="form-label">
                Date Bought
            </label>

            <input type="date"
                   name="date_bought"
                   value="{{ old('date_bought', $asset->date_bought ?? '') }}"
                   class="form-control">

        </div>

        <div class="form-group">

            <label class="form-label">
                Assigned Location
            </label>

            <select name="assigned_location_id"
                    class="form-control">

                @foreach($locations as $location)

                <option value="{{ $location->id }}"
                    @selected(old('assigned_location_id',
                    $asset->assigned_location_id ?? '') == $location->id)>

                    {{ $location->name }}

                </option>

                @endforeach

            </select>

        </div>

        <div class="form-group">

            <label class="form-label">
                Current Location
            </label>

            <select name="current_location_id"
                    class="form-control">

                @foreach($locations as $location)

                <option value="{{ $location->id }}"
                    @selected(old('current_location_id',
                    $asset->current_location_id ?? '') == $location->id)>

                    {{ $location->name }}

                </option>

                @endforeach

            </select>

        </div>

        <div class="form-group full-width">

            <label class="form-label">
                Status
            </label>

            <select name="status"
                    class="form-control">

                <option value="active"
                    @selected(old('status', $asset->status ?? '') == 'active')>
                    Active
                </option>

                <option value="repair"
                    @selected(old('status', $asset->status ?? '') == 'repair')>
                    Under Repair
                </option>

                <option value="disposed"
                    @selected(old('status', $asset->status ?? '') == 'disposed')>
                    Disposed
                </option>

            </select>

        </div>

    </div>

    <div class="checkbox-group">

        <div class="checkbox-item">

            <input type="checkbox"
                   id="is_transferred"
                   name="is_transferred"
                   value="1"
                   @checked(old('is_transferred', $asset->is_transferred ?? false))>

            <label for="is_transferred">
                Asset Transferred
            </label>

        </div>

        <div class="checkbox-item">

            <input type="checkbox"
                   id="is_faulty"
                   name="is_faulty"
                   value="1"
                   @checked(old('is_faulty', $asset->is_faulty ?? false))>

            <label for="is_faulty">
                Faulty Asset
            </label>

        </div>

    </div>

</div>

<script>

function calculateDepreciation(){

    let buyingPrice =
        parseFloat(document.querySelector(
            '[name="buying_price"]'
        ).value) || 0;

    let rate =
        parseFloat(document.querySelector(
            '[name="depreciation_rate"]'
        ).value) || 0;

    let currentPrice =
        buyingPrice - (buyingPrice * (rate / 100));

    document.getElementById(
        'currentPricePreview'
    ).value = currentPrice.toFixed(2);

}

document.querySelector(
    '[name="buying_price"]'
).addEventListener('input', calculateDepreciation);

document.querySelector(
    '[name="depreciation_rate"]'
).addEventListener('input', calculateDepreciation);

calculateDepreciation();

</script>