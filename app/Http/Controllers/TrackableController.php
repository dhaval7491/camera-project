<?php

namespace App\Http\Controllers;

use App\DataTables\TrackableDataTable;
use App\DataTables\TrackableProjectDataTable;
use App\Http\Requests\TrackableRequest;
use App\Models\Company;
use App\Models\Project;
use App\Models\Trackable;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class TrackableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TrackableDataTable $dataTable)
    {
        return $dataTable->render('trackables.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrackableRequest $request)
    {
        $data = $request->validated();
        $trackable = Trackable::create([
            'trackable_name' => $data['trackable_name'],
            'other_name' => $data['other_name'],
        ]);

        if (isset($data['linked_objects']) && is_array($data['linked_objects'])) {
            $filteredLinkedObjects = [];

            foreach ($data['linked_objects'] as $object) {
                $trimmedObject = trim($object);
                if (!empty($trimmedObject) && $trimmedObject !== '' && $trimmedObject !== null) {
                    $filteredLinkedObjects[] = $trimmedObject;
                }
            }

            // Only proceed if we have valid objects
            if (!empty($filteredLinkedObjects)) {
                foreach ($filteredLinkedObjects as $object) {
                    $trackable->linkedObjects()->create(['name' => $object]);
                }
            }
        }

        if (!empty($data['project_id'])) {
            $trackable->projects()->attach($data['project_id']);
        }

        return redirect()->route('settings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trackable $trackable)
    {
        $trackable->load([
            'projects' => function ($query) {
                $query->select('projects.id', 'projects.name', 'projects.created_at', 'projects.is_active')
                      ->with(['companies' => function ($query) {
                          $query->select('companies.id', 'companies.company_name');
                      }]);
            }, 
            'linkedObjects'
        ]);
        // dd($trackable->id);
        $dataTable = app(TrackableProjectDataTable::class, ['trackableId' => $trackable->id]);
        return $dataTable->render('trackables.show', [
            'companies' => Company::pluck('company_name', 'id')->toArray(), // Pass companies for edit modal
            'projects' => Project::pluck('name', 'id')->toArray(),
            'permissions' => Permission::pluck('name', 'id')->toArray(),
            'trackable' => $trackable
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trackable $trackable)
    {
        if (request()->ajax()) {
            return response()->json([
                'id' => $trackable->id,
                'trackable_name' => $trackable->trackable_name,
                'other_name' => $trackable->other_name,
                'status' => $trackable->status,
                'linked_objects' => $trackable->linkedObjects->pluck('name')->toArray(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TrackableRequest $request, Trackable $trackable)
    {
        $data = $request->validated();
        $trackable->update([
            'trackable_name' => $data['trackable_name'],
            'other_name' => $data['other_name'],
        ]);

        $trackable->linkedObjects()->delete();
        if (isset($data['linked_objects']) && is_array($data['linked_objects'])) {
            $filteredLinkedObjects = [];

            foreach ($data['linked_objects'] as $object) {
                $trimmedObject = trim($object);
                if (!empty($trimmedObject) && $trimmedObject !== '' && $trimmedObject !== null) {
                    $filteredLinkedObjects[] = $trimmedObject;
                }
            }

            // Only proceed if we have valid objects
            if (!empty($filteredLinkedObjects)) {
                foreach ($filteredLinkedObjects as $object) {
                    $trackable->linkedObjects()->create(['name' => $object]);
                }
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Trackable updated successfully'
            ]);
        }

        return redirect()->route('settings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trackable $trackable)
    {
        $trackable->delete();
        return redirect()->route('settings.index');
    }

    public function toggleActive(Trackable $trackable)
    {
        $trackable->is_active = !$trackable->is_active;
        $trackable->save();

        return response()->json([
            'success' => true,
            'message' => 'Trackable status updated successfully',
            'status' => $trackable->is_active
        ]);
    }
}
