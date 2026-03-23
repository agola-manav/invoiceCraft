<div class="row g-3">
    <div class="col-md-12">
        <label class="form-label required">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ $expenseCategory && $expenseCategory->name != '' ? $expenseCategory->name : '' }}">
    </div>
</div>