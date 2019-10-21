<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Appiontment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppiontmentRequest;
use App\Http\Requests\UpdateAppiontmentRequest;
use App\Http\Resources\Admin\AppiontmentResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppiontmentApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('appiontment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppiontmentResource(Appiontment::with(['clients', 'employees', 'services'])->get());
    }

    public function store(StoreAppiontmentRequest $request)
    {
        $appiontment = Appiontment::create($request->all());
        $appiontment->clients()->sync($request->input('clients', []));
        $appiontment->employees()->sync($request->input('employees', []));
        $appiontment->services()->sync($request->input('services', []));

        return (new AppiontmentResource($appiontment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Appiontment $appiontment)
    {
        abort_if(Gate::denies('appiontment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppiontmentResource($appiontment->load(['clients', 'employees', 'services']));
    }

    public function update(UpdateAppiontmentRequest $request, Appiontment $appiontment)
    {
        $appiontment->update($request->all());
        $appiontment->clients()->sync($request->input('clients', []));
        $appiontment->employees()->sync($request->input('employees', []));
        $appiontment->services()->sync($request->input('services', []));

        return (new AppiontmentResource($appiontment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Appiontment $appiontment)
    {
        abort_if(Gate::denies('appiontment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appiontment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
