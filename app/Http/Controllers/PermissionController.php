<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeletePermissionRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();

        return view('permission.index', compact('permissions'));
    }

    public function store(StorePermissionRequest $request)
    {
        $validated = $request->validated();

        $permission = Permission::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        return response()->json(['message' => 'Permiso guardado con éxito.'], 200);

    }

    public function update(UpdatePermissionRequest $request)
    {
        $validated = $request->validated();

        $permission = Permission::find($request->get('permission_id'));

        $permission->name = $request->get('name');
        $permission->description = $request->get('description');

        $permission->save();

        return response()->json(['message' => 'Permiso modificado con éxito.'], 200);

    }

    public function destroy(DeletePermissionRequest $request)
    {
        $validated = $request->validated();

        $permission = Permission::find($request->get('permission_id'));

        $permission->delete();

        return response()->json(['message' => 'Role eliminado con éxito.'], 200);

    }

    public function middlewareCheck()
    {
        dd('Si estas viendo esta vista, entonces has pasado el middleware');
    }
}
