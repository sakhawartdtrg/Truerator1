<?php

namespace App\Http\Controllers\Admin;

use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;
use Bouncer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;


class RolesController extends Controller
{
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */

    public $relation_id ;

    public function __construct()
    {
       $this->middleware(function ($request, $next) {
        $this->relation_id= auth()->user()->relation_id;
            return $next($request);
        });
    }

    public function index()
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }

        $roles = Role::where('relation_id',$this->relation_id)->get();
        activity('List')->causedBy(Auth::user())->log('Pulled Roles list');

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating new Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        // if(Bouncer::is(Auth::user())->a('administrator')){
        //     $abilities = Ability::get()->pluck('name', 'name');
        // }else{
        //     $abilities = Ability::where('name','!=','users_manage')->get()->pluck('name', 'name');
        // }

        return view('admin.roles.create');
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \App\Http\Requests\StoreRolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRolesRequest $request)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        // print_r($request->all());
        // exit;
        $role = new Role;
        $role->fill($request->all());
        $role->relation_id = $this->relation_id;
        $role->save();

        // $role->allow($request->input('abilities'));
        activity('Create')->causedBy(Auth::user())->log($role->name.' '.'Role created');
        // Session::flash('success','Role created');
        return redirect()->route('roles.index');
    }


    /**
     * Show the form for editing Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        if(Bouncer::is(Auth::user())->a('administrator')){
            $abilities = Ability::get()->pluck('name', 'name');
        }else{
            $abilities = Ability::where('name','!=','users_manage')->get()->pluck('name', 'name');
        }

        $role = Role::findOrFail($id);

        return view('admin.roles.edit', compact('role', 'abilities'));
    }

    /**
     * Update Role in storage.
     *
     * @param  \App\Http\Requests\UpdateRolesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRolesRequest $request, $id)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        $role = Role::findOrFail($id);
        $role->update($request->all());
        foreach ($role->getAbilities() as $ability) {
            $role->disallow($ability->name);
        }
        $role->allow($request->input('abilities'));
        activity('Update')->causedBy(Auth::user())->log($role->name.' '.'Role detail updated');
        Session::flash('success','Role updated');
        return redirect()->route('admin.roles.index');
    }

    public function show(Role $role)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }

        $role->load('abilities');

        return view('admin.roles.show', compact('role'));
    }

    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        $role = Role::findOrFail($id);
        activity('Delete')->causedBy(Auth::user())->log($role->name.' '.'Role deleted');
        $role->delete();
        Session::flash('error','Role Deleted');
        return redirect()->route('admin.roles.index');
    }

    /**
     * Delete all selected Role at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        activity('Delete')->causedBy(Auth::user())->log('All Role Deleted');
        Role::whereIn('id', request('ids'))->delete();
        Session::flash('error','Roles Deleted');
        return response()->noContent();
    }

    public function permission()
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        // echo '<pre>';
        $permissions = Ability::with('group')->get()->groupBy('group.name')->toArray();
        $roles = Role::where('relation_id',$this->relation_id)->get();
        $role_abilities = [];
        foreach($roles as $role){
            $abilities = $role->getAbilities();
            $role_abilities[$role->id] = $abilities->pluck('id')->toArray();
        }
        activity('List')->causedBy(Auth::user())->log('Pulled Roles Permissions');
        
        // print_r($role_abilities);
        // exit;
        return view('admin.roles.permission', compact('roles','permissions','role_abilities'));
    }

    public function permission_assign(Request $request)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        $permissions = Ability::with('group')->get()->groupBy('group.name')->toArray();
        $roles = Role::where('relation_id',$this->relation_id)->get();
        foreach($roles as $role){
            foreach ($role->getAbilities() as $ability) {
                $role->disallow($ability->name);
            }
        }
        foreach($request->role as $val){
            $val = explode('.',$val);
            $role = Role::findOrFail($val[0]);
            $role->allow($val[1]);
            
        }    
        activity('Update')->causedBy(Auth::user())->log('Updated Roles Permissions');
        return redirect(route('permission'));
    }

}
