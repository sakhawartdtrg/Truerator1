<?php

namespace App\Http\Controllers;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Silber\Bouncer\Bouncer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Alert;

class UserController extends Controller
{
    public $relation_id ;

    public function __construct()
    {
       $this->middleware(function ($request, $next) {
        $this->relation_id= auth()->user()->id;
            return $next($request);
        });
    }

    public function index()
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        // echo '<pre>';
        $users = User::where('relation_id',$this->relation_id)->with('roles')->where('id','!=',auth()->user()->id)->get();
        // print_r($users);
        // exit;
        activity('List')->causedBy(Auth::user())->log('Created User listed');

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }

        $roles = Role::where('relation_id',$this->relation_id)->get()->pluck('name', 'name');
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        $data = $request->all();
        // $data['company_name'] = $request->name;
        // $data['employee_id']  = $request->employee_id;
        // if(in_array('account_owner',$request->input('roles'))){
        //     $data['relation_id'] = User::latest('id')->first()->id +1;
        // }else{
        $data['relation_id'] = $this->relation_id;
        // }
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        
        $user->assign($request->roles);
        activity('Create')->causedBy(Auth::user())->log($user->name.' '.'User created');
        alert()->success('User Created',"$user->name account created and role assigned");
        return redirect()->route('users.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        $roles = Role::where('relation_id','=',$this->relation_id)->get()->pluck('name', 'name');

        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, $id)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }

        // print_r($request->all());
        // exit;
        $user = User::findOrFail($id);
        $data = $request->all();
        $data['first_name']  = $request->first_name;
        $data['last_name']  = $request->last_name;
        if(!empty($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }else{
            $data['password'] = $user->password;
        }
        $user->update($data);
        foreach ($user->roles as $role) {
            $user->retract($role);
        }
        // if(!empty($request->input('roles'))){
            // foreach ($request->input('roles') as $role) {
        $user->assign($request->roles);
            // }
        // }
        // Session::flash('success','User Updated');
        Alert::success('Updated', 'Detail is updated');
        activity('Update')->causedBy(Auth::user())->log($user->first_name.' '.'User detail Updated');

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }
    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        $user = User::findOrFail($id);
        activity('Delete')->causedBy(Auth::user())->log($user->name.' '.'User deleted');
        $user->delete();
        Session::flash('error','User deleted');

        return redirect()->route('users.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        User::whereIn('id', request('ids'))->delete();
        activity('Delete')->causedBy(Auth::user())->log('All users deleted');
        Session::flash('error','Users Deleted');
        return response()->noContent();
    }

    public function logs(){
        if (!Bouncer::is(auth()->user())->an('administrator')) {
            return abort(401);
        }
        $logs = Activity::all();
        return view('admin.users.logs', compact('logs'));
    }

    public function users_list(){
        if(Bouncer::is(Auth::user())->an('administrator')){
            $users = User::with('roles')->with('creator')->with('editor')->get()->toArray();
        }else{
            $users = User::where('relation_id',$this->relation_id)->where('id','!=',Auth::user()->id)->with('roles')->with('creator')->with('editor')->get()->toArray();
        }
        $datas = [];
        $data = [];

        foreach($users as $user){
            $roles='';
            $data['id'] = $user['id'];
            $data['name'] = $user['name'];
            if(!empty($user['employee_id'])){
                $data['employee_id'] = $user['employee_id'];
            }else{
                $data['employee_id'] = 'N/A';
            }
            $data['email'] = $user['email'];
            $data['created_at'] = $user['created_at'];
            $data['creator'] = $user['creator'];
            foreach($user['roles'] as $role){
                $roles.='<span class="badge badge-info">'.$role['name'].'</span>';
            }
            $data['roles'] = $roles;
            array_push($datas,$data);
        }
        return json_encode(['data'=>$datas]);
    }

    function allow_admin_ability(){
        Bouncer::allow(auth()->user())->toOwnEverything();
    }
}
