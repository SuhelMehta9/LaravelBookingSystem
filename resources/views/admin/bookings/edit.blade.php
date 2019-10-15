@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.booking.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.bookings.update", [$booking->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('select_location_id') ? 'has-error' : '' }}">
                <label for="select_location">{{ trans('cruds.booking.fields.select_location') }}*</label>
                <select name="select_location_id" id="select_location" class="form-control select2" required>
                    @foreach($select_locations as $id => $select_location)
                        <option value="{{ $id }}" {{ (isset($booking) && $booking->select_location ? $booking->select_location->id : old('select_location_id')) == $id ? 'selected' : '' }}>{{ $select_location }}</option>
                    @endforeach
                </select>
                @if($errors->has('select_location_id'))
                    <p class="help-block">
                        {{ $errors->first('select_location_id') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                <label for="start_date">{{ trans('cruds.booking.fields.start_date') }}*</label>
                <input type="text" id="start_date" name="start_date" class="form-control date" value="{{ old('start_date', isset($booking) ? $booking->start_date : '') }}" required>
                @if($errors->has('start_date'))
                    <p class="help-block">
                        {{ $errors->first('start_date') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.start_date_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                <label for="start_time">{{ trans('cruds.booking.fields.start_time') }}*</label>
                <input type="text" id="start_time" name="start_time" class="form-control timepicker" value="{{ old('start_time', isset($booking) ? $booking->start_time : '') }}" required>
                @if($errors->has('start_time'))
                    <p class="help-block">
                        {{ $errors->first('start_time') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.start_time_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                <label for="end_date">{{ trans('cruds.booking.fields.end_date') }}*</label>
                <input type="text" id="end_date" name="end_date" class="form-control date" value="{{ old('end_date', isset($booking) ? $booking->end_date : '') }}" required>
                @if($errors->has('end_date'))
                    <p class="help-block">
                        {{ $errors->first('end_date') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.end_date_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('end_time') ? 'has-error' : '' }}">
                <label for="end_time">{{ trans('cruds.booking.fields.end_time') }}*</label>
                <input type="text" id="end_time" name="end_time" class="form-control timepicker" value="{{ old('end_time', isset($booking) ? $booking->end_time : '') }}" required>
                @if($errors->has('end_time'))
                    <p class="help-block">
                        {{ $errors->first('end_time') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.end_time_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.booking.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($booking) ? $booking->name : '') }}" required>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.booking.fields.email') }}*</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($booking) ? $booking->email : '') }}" required>
                @if($errors->has('email'))
                    <p class="help-block">
                        {{ $errors->first('email') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                <label for="phone_number">{{ trans('cruds.booking.fields.phone_number') }}*</label>
                <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number', isset($booking) ? $booking->phone_number : '') }}" required>
                @if($errors->has('phone_number'))
                    <p class="help-block">
                        {{ $errors->first('phone_number') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.phone_number_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('cruds.booking.fields.description') }}*</label>
                <textarea id="description" name="description" class="form-control " required>{{ old('description', isset($booking) ? $booking->description : '') }}</textarea>
                @if($errors->has('description'))
                    <p class="help-block">
                        {{ $errors->first('description') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.description_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection