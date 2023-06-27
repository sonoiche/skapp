<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ $task->title ?? '' }}">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" class="form-control" style="width: 100%; resize: none" rows="5">{{ $task->description ?? '' }}</textarea>
</div>
<div class="form-group">
    <label for="document_file">Document File</label>
    @if (isset($task->document_file))
    <div class="input-group mb-3">
        <input class="form-control" type="text" readonly aria-describedby="basic-addon2" value="{{ basename($task->document_file) }}" />
        <div class="input-group-append">
            <button class="btn btn-outline-danger" type="button" onclick="removePhoto({{ $task->id }})">Remove</button>
        </div>
    </div>
    @else
    <div>
        <input type="file" name="document_file" id="document_file">
    </div>
    @endif
</div>
<div class="form-group">
    <label for="assigned_user">Assigned User</label>
    <select name="assigned_user" id="assigned_user" class="custom-select">
        <option value="">--</option>
        @foreach ($users as $item)
        <option value="{{ $item->id }}" {{ (isset($task->assigned_user) && $task->assigned_user == $item->id) ? 'selected' : '' }}>{{ $item->fullname }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="due_date">Due Date</label>
    <input type="date" name="due_date" id="due_date" class="form-control" min="{{ date('Y-m-d') }}" value="{{ $task->due_date ?? '' }}">
</div>