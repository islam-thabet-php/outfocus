<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\RoleRequest;
use App\Repositories\RoleRepository;
use App\Repositories\PermissionRepository;

class RoleController extends Controller
{
    protected $roleRepository;
    protected $permissionRepository;

    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['result'] = $this->roleRepository->allWithPaginate();
        return view('roles.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data['model'] = $this->roleRepository->newInstance();
        $data['modules'] = $this->permissionRepository->getAllPermissionsGroupedByModule();
        return view('roles.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RoleRequest $request)
    {
        $role = $this->roleRepository->store($request);
        $this->permissionRepository->syncPermissions($role, $request->permissions);
        return redirect()->route('roles.index')->with(['status' => 'success', 'message' => __('Created Successfully')]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data['model'] = $this->roleRepository->show($id);
        return view('roles.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data['model'] = $role = $this->roleRepository->show($id);
        $data['modules'] = $this->permissionRepository->getAllPermissionsGroupedByModule($role);
        return view('roles.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(RoleRequest $request, $id)
    {
        $role = $this->roleRepository->update($request, $id);
        $this->permissionRepository->syncPermissions($role, $request->permissions);
        return redirect()->route('roles.index')->with(['status' => 'success', 'message' => __('Updated Successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->roleRepository->delete($id);
        return redirect()->route('roles.index')->with(['status' => 'success', 'message' => __('Deleted Successfully')]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function search(Request $request)
    {
        $data['result'] = $this->roleRepository->search($request);
        return view('roles::index')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Renderable
     */
    public function lockedscreen()
    {
        return view('roles::lockedscreen');
    }
}
