<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ $proposal->title ?? '' }}">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" class="form-control" style="width: 100%; resize: none" rows="5">{{ $proposal->description ?? '' }}</textarea>
</div>
<div class="form-group">
    <label for="document_file">Document File</label>
    @if (isset($proposal->document_file))
    <div class="input-group mb-3">
        <input class="form-control" type="text" readonly aria-describedby="basic-addon2" value="{{ basename($proposal->document_file) }}" />
        <div class="input-group-append">
            <button class="btn btn-outline-danger" type="button" onclick="removePhoto({{ $proposal->id }})">Remove</button>
        </div>
    </div>
    @else
    <div>
        <input type="file" name="document_file" id="document_file">
    </div>
    @endif
</div>
<div class="form-group">
    <label for="budget">Propose Budget</label>
    <input type="number" name="budget" id="budget" class="form-control" {{ (isset($proposal->status) && $proposal->status == 'Approved' && auth()->user()->committee == null) ? 'disabled' : '' }} value="{{ $proposal->budget ?? '' }}">
</div>
@if (auth()->user()->committee)
<div class="form-group">
    <label for="status">Proposal Status</label>
    <select name="status" id="status" class="custom-select">
        <option value="Pending">Pending</option>
        <option value="Approved" {{ (isset($proposal->status) && $proposal->status == 'Approved') ? 'selected' : '' }}>Approved</option>
        <option value="Declined" {{ (isset($proposal->status) && $proposal->status == 'Declined') ? 'selected' : '' }}>Declined</option>
    </select>
</div>
@endif