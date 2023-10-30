<div class="form-group">
    <label for="title">Event Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ $event->title ?? '' }}">
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="title">Event Schedule</label>
            <div class="input-group date" id="datetimepicker1">
                <input class="form-control daterange" type="text" name="schedule" value="{{ $event->schedule_input ?? '' }}" />
                <span class="input-group-append input-group-addon">
                    <span class="input-group-text fas fa-calendar-alt"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="photo">Feature Photo</label>
            <div>
                @if(!isset($event->photo))
                <input type="file" name="photo" id="photo">
                @else
                <div class="input-group mb-3">
                    <input class="form-control" type="text" readonly aria-describedby="basic-addon2" value="{{ basename($event->photo) }}" />
                    <div class="input-group-append">
                        <button class="btn btn-outline-danger" type="button" onclick="removePhoto()">Remove</button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="description">Event Requirements</label>
    <div>
        <textarea name="description" id="description" cols="30" rows="5"></textarea>
    </div>
</div>
<div class="form-group">
    <label for="event_goal">Event Goal</label>
    <div>
        <textarea name="event_goal" id="event_goal" rows="5"></textarea>
    </div>
</div>
<div class="form-group">
    <label for="location">Location / Venue</label>
    <input type="text" name="location" id="location" class="form-control" value="{{ $event->location ?? '' }}">
</div>