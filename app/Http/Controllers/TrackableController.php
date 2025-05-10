<?php

namespace App\Http\Controllers;

use App\DataTables\TrackableDataTable;
use App\Http\Requests\TrackableRequest;
use App\Models\Project;
use App\Models\Trackable;
use Illuminate\Http\Request;

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
            'project_id' => $data['project_id'] ?? null,
            'other_name' => $data['other_name'],
        ]);

        if (!empty($data['linked_objects'])) {
            foreach ($data['linked_objects'] as $object) {
                $trackable->linkedObjects()->create(['name' => $object]);
            }
        }

        return redirect()->route('trackables.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trackable $trackable)
    {
        $projects = Project::select('name', 'id')->get();
        return view('trackables.show', compact('trackable', 'projects'));
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
        if (!empty($data['linked_objects'])) {
            foreach ($data['linked_objects'] as $object) {
                $trackable->linkedObjects()->create(['name' => $object]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Trackable updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trackable $trackable)
    {
        $trackable->delete();
        return redirect()->route('trackables.index');
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
