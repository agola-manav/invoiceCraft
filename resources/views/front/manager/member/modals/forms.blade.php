@if($member)
<form action="{{ route('member.update', \App\Helpers\Helper::encryptor($member->id, 'encrypt')) }}" id="memberForm" class="mb-0" method="POST" enctype="multipart/form-data">
@else
<form action="{{ route('member.store') }}" id="memberForm" class="mb-0" method="POST" enctype="multipart/form-data">
@endif
    @csrf
    <div class="form-group">
        <label class="form-lable pb-2">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $member ? $member->name : '' }}">
    </div>
    <div class="form-group pt-2">
        <label class="form-lable pb-2">Email</label>
        <input type="text" class="form-control" name="email" id="email" value="{{ $member ? $member->email : '' }}">
    </div>
    <div class="form-group pt-2">
        <label class="form-lable pb-2">Phone</label>
        <input type="text" class="form-control" name="phone" id="phone" value="{{ $member ? $member->phone : '' }}">
    </div>
    <div class="form-group pt-2">
        <label class="form-lable pb-2">Password</label>
        <input type="password" class="form-control" name="password" id="password" @if(!$member) required @endif>
    </div>

    @if($member)
        <div class="form-group pt-2">
            <label class="form-label mb-0 pb-2">Status</label>
            <select class="form-select" name="is_status">
                <option value="">Select status</option>
                <option value="1" {{ $member->is_status == 1 ? 'selected' : '' }} >Active</option>
                <option value="0" {{ $member->is_status == 0 ? 'selected' : '' }} >InActive</option>
            </select>
        </div>
    @endif

    <div class="text-end mt-3">
        <button class="btn btn-primary btn-sm ms-auto" type="submit" name="submit">Submit</button>
    </div>
</form>