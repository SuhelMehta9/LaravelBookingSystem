<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWorkingHourRequest;
use App\Http\Requests\StoreWorkingHourRequest;
use App\Http\Requests\UpdateWorkingHourRequest;
use App\Location;
use App\WorkingHour;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkingHoursController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('working_hour_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workingHours = WorkingHour::all();

        return view('admin.workingHours.index', compact('workingHours'));
    }

    public function create()
    {
        abort_if(Gate::denies('working_hour_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workinghours = Location::all()->pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.workingHours.create', compact('workinghours'));
    }

    public function store(StoreWorkingHourRequest $request)
    {
        $workingHour = WorkingHour::create($request->all());

        return redirect()->route('admin.working-hours.index');
    }

    public function edit(WorkingHour $workingHour)
    {
        abort_if(Gate::denies('working_hour_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workinghours = Location::all()->pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workingHour->load('workinghours');

        return view('admin.workingHours.edit', compact('workinghours', 'workingHour'));
    }

    public function update(UpdateWorkingHourRequest $request, WorkingHour $workingHour)
    {
        $workingHour->update($request->all());

        return redirect()->route('admin.working-hours.index');
    }

    public function show(WorkingHour $workingHour)
    {
        abort_if(Gate::denies('working_hour_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workingHour->load('workinghours');

        return view('admin.workingHours.show', compact('workingHour'));
    }

    public function destroy(WorkingHour $workingHour)
    {
        abort_if(Gate::denies('working_hour_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workingHour->delete();

        return back();
    }

    public function massDestroy(MassDestroyWorkingHourRequest $request)
    {
        WorkingHour::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
