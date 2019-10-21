<?php

namespace App\Http\Controllers\Admin;

use App\Appiontment;
use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppiontmentRequest;
use App\Http\Requests\StoreAppiontmentRequest;
use App\Http\Requests\UpdateAppiontmentRequest;
use App\Service;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AppiontmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Appiontment::with(['clients', 'employees', 'services'])->select(sprintf('%s.*', (new Appiontment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'appiontment_show';
                $editGate      = 'appiontment_edit';
                $deleteGate    = 'appiontment_delete';
                $crudRoutePart = 'appiontments';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('clients', function ($row) {
                $labels = [];

                foreach ($row->clients as $client) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $client->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('employee', function ($row) {
                $labels = [];

                foreach ($row->employees as $employee) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $employee->name);
                }

                return implode(' ', $labels);
            });

            $table->editColumn('comments', function ($row) {
                return $row->comments ? $row->comments : "";
            });
            $table->editColumn('service', function ($row) {
                $labels = [];

                foreach ($row->services as $service) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $service->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'clients', 'employee', 'service']);

            return $table->make(true);
        }

        return view('admin.appiontments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('appiontment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::all()->pluck('name', 'id');

        $employees = User::all()->pluck('name', 'id');

        $services = Service::all()->pluck('name', 'id');

        return view('admin.appiontments.create', compact('clients', 'employees', 'services'));
    }

    public function store(StoreAppiontmentRequest $request)
    {
        $appiontment = Appiontment::create($request->all());
        $appiontment->clients()->sync($request->input('clients', []));
        $appiontment->employees()->sync($request->input('employees', []));
        $appiontment->services()->sync($request->input('services', []));

        return redirect()->route('admin.appiontments.index');
    }

    public function edit(Appiontment $appiontment)
    {
        abort_if(Gate::denies('appiontment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::all()->pluck('name', 'id');

        $employees = User::all()->pluck('name', 'id');

        $services = Service::all()->pluck('name', 'id');

        $appiontment->load('clients', 'employees', 'services');

        return view('admin.appiontments.edit', compact('clients', 'employees', 'services', 'appiontment'));
    }

    public function update(UpdateAppiontmentRequest $request, Appiontment $appiontment)
    {
        $appiontment->update($request->all());
        $appiontment->clients()->sync($request->input('clients', []));
        $appiontment->employees()->sync($request->input('employees', []));
        $appiontment->services()->sync($request->input('services', []));

        return redirect()->route('admin.appiontments.index');
    }

    public function show(Appiontment $appiontment)
    {
        abort_if(Gate::denies('appiontment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appiontment->load('clients', 'employees', 'services');

        return view('admin.appiontments.show', compact('appiontment'));
    }

    public function destroy(Appiontment $appiontment)
    {
        abort_if(Gate::denies('appiontment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appiontment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppiontmentRequest $request)
    {
        Appiontment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
