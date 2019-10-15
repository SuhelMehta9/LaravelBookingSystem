@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.workingHour.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.working-hours.update", [$workingHour->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('workinghours_id') ? 'has-error' : '' }}">
                <label for="workinghours">{{ trans('cruds.workingHour.fields.workinghours') }}*</label>
                <select name="workinghours_id" id="workinghours" class="form-control select2" required>
                    @foreach($workinghours as $id => $workinghours)
                        <option value="{{ $id }}" {{ (isset($workingHour) && $workingHour->workinghours ? $workingHour->workinghours->id : old('workinghours_id')) == $id ? 'selected' : '' }}>{{ $workinghours }}</option>
                    @endforeach
                </select>
                @if($errors->has('workinghours_id'))
                    <p class="help-block">
                        {{ $errors->first('workinghours_id') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('startworkinghour') ? 'has-error' : '' }}">
                <label for="startworkinghour">{{ trans('cruds.workingHour.fields.startworkinghour') }}*</label>
                <input type="text" id="startworkinghour" name="startworkinghour" class="form-control timepicker" value="{{ old('startworkinghour', isset($workingHour) ? $workingHour->startworkinghour : '') }}" required>
                @if($errors->has('startworkinghour'))
                    <p class="help-block">
                        {{ $errors->first('startworkinghour') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.workingHour.fields.startworkinghour_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('endworkinghour') ? 'has-error' : '' }}">
                <label for="endworkinghour">{{ trans('cruds.workingHour.fields.endworkinghour') }}*</label>
                <input type="text" id="endworkinghour" name="endworkinghour" class="form-control timepicker" value="{{ old('endworkinghour', isset($workingHour) ? $workingHour->endworkinghour : '') }}" required>
                @if($errors->has('endworkinghour'))
                    <p class="help-block">
                        {{ $errors->first('endworkinghour') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.workingHour.fields.endworkinghour_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection