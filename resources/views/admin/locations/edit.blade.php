@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.location.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.locations.update", [$location->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                <label for="location">{{ trans('cruds.location.fields.location') }}</label>
                <input type="text" id="location" name="location" class="form-control" value="{{ old('location', isset($location) ? $location->location : '') }}">
                @if($errors->has('location'))
                    <p class="help-block">
                        {{ $errors->first('location') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.location.fields.location_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection