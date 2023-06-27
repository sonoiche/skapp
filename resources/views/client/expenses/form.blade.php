<div class="form-group">
    <label for="name">Expense Name</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ $expense->name ?? '' }}">
</div>
<div class="form-group">
    <label for="amount">Propose Amount</label>
    <input type="number" name="amount" id="amount" class="form-control" value="{{ $expense->amount ?? '' }}">
</div>
<div class="form-group">
    <label for="document_file">Document File</label>
    @if (isset($expense->document_file))
    <div class="input-group mb-3">
        <input class="form-control" type="text" readonly aria-describedby="basic-addon2" value="{{ basename($expense->document_file) }}" />
        <div class="input-group-append">
            <button class="btn btn-outline-danger" type="button" onclick="removePhoto({{ $expense->id }})">Remove</button>
        </div>
    </div>
    @else
    <div>
        <input type="file" name="document_file" id="document_file">
    </div>
    @endif
</div>
<div class="form-group">
    <label for="remarks">Remarks</label>
    <textarea name="remarks" id="remarks" class="form-control" style="width: 100%; resize: none" rows="5">{{ $expense->remarks ?? '' }}</textarea>
</div>