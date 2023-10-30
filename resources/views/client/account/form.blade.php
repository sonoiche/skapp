<div class="form-group">
    <label for="fname">First Name</label>
    <input type="text" name="fname" id="fname" class="form-control" value="{{ auth()->user()->fname }}">
</div>
<div class="form-group">
    <label for="lname">Last Name</label>
    <input type="text" name="lname" id="lname" class="form-control" value="{{ auth()->user()->lname }}">
</div>
<div class="form-group">
    <label for="email">Email Address</label>
    <input type="email" id="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" class="form-control">
</div>
<div class="form-group">
    <label for="password_confirmation">Confirm Password</label>
    <input type="password_confirmation" name="password_confirmation" id="password_confirmation" class="form-control">
</div>
<div class="form-group">
    <label for="mobile_number">Mobile Number</label>
    <input type="text" name="mobile_number" id="mobile_number" class="form-control" value="{{ auth()->user()->mobile_number }}">
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="birthdate">Birthdate</label>
            <input type="date" name="birthdate" id="birthdate" class="form-control" max="{{ \Carbon\Carbon::now()->subYears(17)->format('Y-m-d'); }}" value="{{ auth()->user()->birthdate }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" id="gender" class="custom-select">
                <option value="">--</option>
                <option value="Male" {{ auth()->user()->gender == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ auth()->user()->gender == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="address">Address</label>
    <input type="text" name="address" id="address" class="form-control" value="{{ auth()->user()->address }}">
</div>
<div class="row">
    <div class="col-9">
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" id="city" class="form-control" value="{{ auth()->user()->city }}">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="zip_code">Zip Code</label>
            <input type="text" name="zip_code" id="zip_code" class="form-control" value="{{ auth()->user()->zip_code }}">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="photo">Profile Photo</label>
    <div>
        @if(!isset(auth()->user()->photo))
        <input type="file" name="photo" id="photo">
        @else
        <div class="input-group mb-3">
            <input class="form-control" type="text" readonly aria-describedby="basic-addon2" value="{{ basename(auth()->user()->photo) }}" />
            <div class="input-group-append">
                <button class="btn btn-outline-danger" type="button" onclick="removePhoto()">Remove</button>
            </div>
        </div>
        @endif
    </div>
</div>