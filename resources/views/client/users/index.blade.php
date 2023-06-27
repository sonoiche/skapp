@extends('layouts.app', ['page' => ['name' => 'User Lists']])
@section('content')
<div class="d-flex justify-content-end my-3">
    
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <div class="card-title"></div>
            </div>
            <div class="card-body">
                <table class="table table-striped my-4 w-100" id="user-table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Fullname</th>
                            <th>Email Address</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>{{ $item->fullname }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->role }}</td>
                            <td>{{ $item->status }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-secondary" data-toggle="dropdown">Action</button>
                                    <div class="dropdown-menu animated pulse" role="menu">
                                        <a class="dropdown-item" href="{{ url('client/users', $item->id) }}/edit">Edit</a>
                                        <a class="dropdown-item" href="javascript:;" onclick="deleteUser({{ $item->id }})">Delete</a>
                                    </div>
                                </div> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-js')
<script>
function deleteUser(id) {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this user!",
        icon: "warning",
        buttons: { cancel: !0, confirm: { text: "Yes, delete it!", value: !0, visible: !0, className: "bg-danger", closeModal: !0 } },
    }).then(function (e) {
        if(e) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('client/users') }}/"+id,
                dataType: "json",
                success: function (response) {
                    location.reload();
                }
            });
        }
    })
}
</script>
@endsection