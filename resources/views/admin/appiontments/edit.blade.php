@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.appiontment.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.appiontments.update", [$appiontment->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('clients') ? 'has-error' : '' }}">
                <label for="clients">{{ trans('cruds.appiontment.fields.clients') }}*
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="clients[]" id="clients" class="form-control select2" multiple="multiple" required>
                    @foreach($clients as $id => $clients)
                        <option value="{{ $id }}" {{ (in_array($id, old('clients', [])) || isset($appiontment) && $appiontment->clients->contains($id)) ? 'selected' : '' }}>{{ $clients }}</option>
                    @endforeach
                </select>
                @if($errors->has('clients'))
                    <em class="invalid-feedback">
                        {{ $errors->first('clients') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.appiontment.fields.clients_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('employees') ? 'has-error' : '' }}">
                <label for="employee">{{ trans('cruds.appiontment.fields.employee') }}
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="employees[]" id="employees" class="form-control select2" multiple="multiple">
                    @foreach($employees as $id => $employee)
                        <option value="{{ $id }}" {{ (in_array($id, old('employees', [])) || isset($appiontment) && $appiontment->employees->contains($id)) ? 'selected' : '' }}>{{ $employee }}</option>
                    @endforeach
                </select>
                @if($errors->has('employees'))
                    <em class="invalid-feedback">
                        {{ $errors->first('employees') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.appiontment.fields.employee_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                <label for="start_time">{{ trans('cruds.appiontment.fields.start_time') }}*</label>
                <input type="text" id="start_time" name="start_time" class="form-control datetime" value="{{ old('start_time', isset($appiontment) ? $appiontment->start_time : '') }}" required>
                @if($errors->has('start_time'))
                    <em class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.appiontment.fields.start_time_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('finish_time') ? 'has-error' : '' }}">
                <label for="finish_time">{{ trans('cruds.appiontment.fields.finish_time') }}*</label>
                <input type="text" id="finish_time" name="finish_time" class="form-control datetime" value="{{ old('finish_time', isset($appiontment) ? $appiontment->finish_time : '') }}" required>
                @if($errors->has('finish_time'))
                    <em class="invalid-feedback">
                        {{ $errors->first('finish_time') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.appiontment.fields.finish_time_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('comments') ? 'has-error' : '' }}">
                <label for="comments">{{ trans('cruds.appiontment.fields.comments') }}</label>
                <textarea id="comments" name="comments" class="form-control ">{{ old('comments', isset($appiontment) ? $appiontment->comments : '') }}</textarea>
                @if($errors->has('comments'))
                    <em class="invalid-feedback">
                        {{ $errors->first('comments') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.appiontment.fields.comments_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('services') ? 'has-error' : '' }}">
                <label for="service">{{ trans('cruds.appiontment.fields.service') }}*
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="services[]" id="services" class="form-control select2" multiple="multiple" required>
                    @foreach($services as $id => $service)
                        <option value="{{ $id }}" {{ (in_array($id, old('services', [])) || isset($appiontment) && $appiontment->services->contains($id)) ? 'selected' : '' }}>{{ $service }}</option>
                    @endforeach
                </select>
                @if($errors->has('services'))
                    <em class="invalid-feedback">
                        {{ $errors->first('services') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.appiontment.fields.service_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection