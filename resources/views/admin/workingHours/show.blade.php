@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.workingHour.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.workingHour.fields.id') }}
                        </th>
                        <td>
                            {{ $workingHour->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workingHour.fields.workinghours') }}
                        </th>
                        <td>
                            {{ $workingHour->workinghours->location ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workingHour.fields.startworkinghour') }}
                        </th>
                        <td>
                            {{ $workingHour->startworkinghour }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workingHour.fields.endworkinghour') }}
                        </th>
                        <td>
                            {{ $workingHour->endworkinghour }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection