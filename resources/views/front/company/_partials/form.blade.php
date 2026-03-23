<div class="section-title">Company Information</div>
<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label required">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter company name" value="{{ old('name', $company->name ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label required">Phone Number</label>
        <input type="text" class="form-control" name="phone_number" placeholder="Enter phone number" value="{{ old('phone_number', $company->phone_number ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label">GST Number</label>
        <input type="text" class="form-control" name="gstn" placeholder="GST Number" value="{{ old('gstn', $company->gst_number ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label required">Email</label>
        <input type="text" class="form-control" name="email" placeholder="example@mail.com" value="{{ old('email', $company->email ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label">Website</label>
        <input type="text" class="form-control" name="website" placeholder="www.company.com" value="{{ old('website', $company->website ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label">Address</label>
        <input type="text" class="form-control" name="address" placeholder="Enter address" value="{{ old('address', $company->address ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label">City</label>
        <input type="text" class="form-control" name="city" placeholder="City" value="{{ old('city', $company->city ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label">State</label>
        <input type="text" class="form-control" name="state" placeholder="State" value="{{ old('state', $company->state ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label">Country</label>
        <input type="text" class="form-control" name="country" placeholder="Country" value="{{ old('country', $company->country ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label">Pincode</label>
        <input type="text" class="form-control" name="pincode" placeholder="Pincode" value="{{ old('pincode', $company->pincode ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label">Company Logo</label>
        <input type="file" class="form-control" name="image">
    </div>

    <div class="col-md-6">
        <label class="form-label">Signature</label>
        <input type="file" class="form-control" name="sign">
    </div>
</div>

<hr class="my-4">

<div class="section-title">Bank Details</div>
<div class="row g-3">
    <div class="col-md-6">
        <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" value="{{ old('bank_name', optional($company->bankDetail)->bank_name ?? '') }}">
    </div>

    <div class="col-md-6">
        <input type="text" class="form-control" name="ac_no" placeholder="Account Number" value="{{ old('ac_no', optional($company->bankDetail)->account_number ?? '') }}">
    </div>

    <div class="col-md-6">
        <input type="text" class="form-control" name="isfc" placeholder="IFSC Code" value="{{ old('isfc', optional($company->bankDetail)->isfc ?? '') }}">
    </div>

    <div class="col-md-6">
        <input type="text" class="form-control" name="upi_id" placeholder="UPI ID" value="{{ old('upi_id', optional($company->bankDetail)->upi_id ?? '') }}">
    </div>
</div>

<hr class="my-4">

<div class="section-title">Invoice Settings</div>
<div class="row g-3">
    <div class="col-md-6">
        <textarea class="form-control" name="invoice_terms" rows="3" placeholder="Invoice Terms">{{ old('invoice_terms', optional($company->invoiceSetting)->invoice_terms ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <textarea class="form-control" name="invoice_remarks" rows="3" placeholder="Invoice Remarks">{{ old('invoice_remarks', optional($company->invoiceSetting)->invoice_remarks ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <input type="text" class="form-control" name="invoice_prefix" placeholder="Invoice Prefix" value="{{ old('invoice_prefix', optional($company->invoiceSetting)->invoice_prefix ?? '') }}">
    </div>

    <div class="col-md-6">
        <input type="number" class="form-control" name="invoice_counter" value="{{ old('invoice_counter', optional($company->invoiceSetting)->invoice_counter ?? 0) }}">
        <small class="text-muted">Next invoice = +1</small>
    </div>
</div>

<hr class="my-4">

<div class="section-title">Quotation Settings</div>
<div class="row g-3">
    <div class="col-md-6">
        <textarea class="form-control" name="quotation_terms" rows="3" placeholder="Quotation Terms">{{ old('quotation_terms', optional($company->quotationSetting)->quotation_terms ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <textarea class="form-control" name="quotation_remarks" rows="3" placeholder="Quotation Remarks">{{ old('quotation_remarks', optional($company->quotationSetting)->quotation_remarks ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <input type="text" class="form-control" name="quotation_prefix" placeholder="Quotation Prefix" value="{{ old('quotation_prefix', optional($company->quotationSetting)->quotation_prefix ?? '') }}">
    </div>

    <div class="col-md-6">
        <input type="number" class="form-control" name="quotation_counter" value="{{ old('quotation_counter', optional($company->quotationSetting)->quotation_counter ?? 0) }}">
        <small class="text-muted">Next quotation = +1</small>
    </div>
</div>