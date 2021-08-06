<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Title;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Promise\all;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
//        Auth::user()->revokePermissionTo('role_view');
//        $role = Role::create(['name' => 'Admin']);
//        $permission = Permission::create(['name' => 'role_view']);
//        Role::find(1)->givePermissionTo(1);
//        Permission::find(1)->assignRole(1);
//        User::find(3)->assignRole(1);
        $this->authorize('role_view');
        return RoleResource::collection(Title::query()->paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return auth()->user()->jsPermissions();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->authorize('role_create');
        $role = Title::query()->create($request->validated());
        return response()->json([$role, 'message' => "Successfully added a new role"], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Title  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Title $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Title  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Title $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Title  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Title $role): JsonResponse
    {
        $this->authorize('role_update');
        $data = $request->validated();
        $role->fill($data);
        $role->save();
        return response()->json([$role, 'message' => "Successfully updated a role"], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Title  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Title $role): JsonResponse
    {
        $this->authorize('role_delete');
        $role->delete();
        return response()->json(['message' => 'Successfully deleted a role.'], Response::HTTP_OK);
    }
}
