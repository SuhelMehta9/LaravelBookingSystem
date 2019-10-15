@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.booking.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.booking.fields.id') }}
                        </th>
                        <td>
                            {{ $booking->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.booking.fields.select_location') }}
                        </th>
                        <td>
                            {{ $booking->select_location->location ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.booking.fields.start_date') }}
                        </th>
                        <td>
                            {{ $booking->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.booking.fields.start_time') }}
                        </th>
                        <td>
                            {{ $booking->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.booking.fields.end_date') }}
                        </th>
                        <td>
                            {{ $booking->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.booking.fields.end_time') }}
                        </th>
                        <td>
                            {{ $booking->end_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.booking.fields.name') }}
                        </th>
                        <td>
                            {{ $booking->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.booking.fields.email') }}
                        </th>
                        <td>
                            {{ $booking->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.booking.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $booking->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.booking.fields.description') }}
                        </th>
                        <td>
                            {!! $booking->description !!}
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