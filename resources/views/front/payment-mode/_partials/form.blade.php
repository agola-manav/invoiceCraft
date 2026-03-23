<div class="row g-3">
    <div class="col-md-12">
        <label class="form-label required">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ $paymente && $paymente->name != '' ? $paymente->name : '' }}">
    </div>
</div>