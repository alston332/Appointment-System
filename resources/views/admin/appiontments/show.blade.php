@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.appiontment.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.appiontment.fields.id') }}
                        </th>
                        <td>
                            {{ $appiontment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Clients
                        </th>
                        <td>
                            @foreach($appiontment->clients as $id => $clients)
                                <span class="label label-info label-many">{{ $clients->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Employee
                        </th>
                        <td>
                            @foreach($appiontment->employees as $id => $employee)
                                <span class="label label-info label-many">{{ $employee->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appiontment.fields.start_time') }}
                        </th>
                        <td>
                            {{ $appiontment->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appiontment.fields.finish_time') }}
                        </th>
                        <td>
                            {{ $appiontment->finish_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appiontment.fields.comments') }}
                        </th>
                        <td>
                            {!! $appiontment->comments !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Service
                        </th>
                        <td>
                            @foreach($appiontment->services as $id => $service)
                                <span class="label label-info label-many">{{ $service->name }}</span>
                            @endforeach
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