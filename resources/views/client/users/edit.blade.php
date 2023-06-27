@extends('layouts.app', ['page' => ['name' => 'Submit a Proposal']])
@section('content')
<div class="d-flex justify-content-end my-3">
    <a href="{{ url('client/users') }}" class="btn btn-outline-danger">Back</a>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
               <div class="card-title"></div>
            </div>
            <div class="card-body">
                <form action="{{ url('client/users', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="fname" class="form-control" value="{{ $user->fname ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname" class="form-control" value="{{ $user->lname ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email ?? '' }}" disabled>
                    </div>
                    @if (auth()->user()->role == 'Admin')
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="custom-select">
                            <option value="Admin" {{ (isset($user->role) && $user->role == 'Admin') ? 'selected' : '' }}>Admin</option>
                            <option value="User" {{ (isset($user->role) && $user->role == 'User') ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="custom-select">
                            <option value="Active" {{ (isset($user->status) && $user->status == 'Active') ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ (isset($user->status) && $user->status == 'Inactive') ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="checkbox c-checkbox">
                            <label>
                                <input type="checkbox" name="committee" id="committee" value="1" {{ (isset($user->committee) && $user->committee == true) ? 'checked' : '' }}>
                                <span class="fa fa-check"></span> Make this user a committee
                            </label>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-js')
{!! JsValidator::formRequest('App\Http\Requests\ProposalRequest') !!}
@endsection