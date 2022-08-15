<?php

namespace App\Http\Controllers\Settings;

use Facades\App\Helpers\ListingHelper;
use App\Http\Requests\UserRequest;
use App\Permission;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Role;
use App\User;
use App\Logs;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\SupplierModels\ApproversSetting;

class UserController extends Controller
{
    use SendsPasswordResetEmails;

    private $searchFields = ['username'];

    public function __construct()
    {
        Permission::module_init($this, 'user');
    }

    public function index()
    {
        $users = ListingHelper::simple_search(User::class, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);

        $searchType = 'simple_search';

        return view('admin.users.index',compact('users','filter', 'searchType'));
    }

    public function create()
    {
        $roles = Role::get();
        return view('admin.users.create',compact('roles'));
    }

    public function store(UserRequest $request)
    {
//        if(User::where('name',$request->fname.' '.$request->lname)->exists()){
//            return back()->with('duplicate', __('standard.users.duplicate_email'));
//        } else {
        $user = User::create([
            'first_name'        => $request->fname,
            'last_name'         => $request->lname,
            'username'          => $request->email,
            'password'          => Str::random(32),
            'email'             => $request->email,
            'role_id'           => $request->role,
            'active'            => 1,
            'user_id'           => Auth::id(),
            'remember_token'    => Str::random(10)
        ]);

        $user->send_reset_temporary_password_email();

        if($user->role_id == env('APPROVER_ID')) {
            ApproversSetting::create(['approver_id' => $user->id]);
        }

        return redirect()->route('users.index')->with('success', 'Pending for activation. Please remind the user to check the email and activate the account.');
//        }
    }

    public function edit($id)
    {
        $roles = Role::get();
        $user = User::where('id',$id)->first();

        return view('admin.users.edit',compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        Validator::make($request->all(), [
            'fname' => 'required|max:90',
            'lname' => 'required|max:90',
            'email' => 'required|email|max:191|unique:users,email,'.$user->id,
            'role' => 'required|exists:role,id'
        ])->validate();

        $user->update([
            'first_name'=> $request->fname,
            'last_name' => $request->lname,
            'name'     => $request->fname.' '.$request->lname,
            'email'    => $request->email,
            'role_id'  => $request->role,
            'user_id'  => Auth::id(),
        ]);

        return redirect()->route('users.edit', $user->id)->with('success', __('standard.users.update_success'));
    }

    public function deactivate(Request $request)
    {
        User::find($request->user_id)->update([
            'active' => 0,
            'user_id'   => Auth::id(),
        ]);

        return back()->with('success', __('standard.users.status_success', ['status' => 'deactivated']));
    }

    public function activate(Request $request)
    {
        User::find($request->user_id)->update([
            'active' => 1,
            'user_id'   => Auth::id(),
        ]);

        return back()->with('success', __('standard.users.status_success', ['status' => 'activated']));
    }


    public function show($id, $param = null)
    {
        $user = User::where('id',$id)->first();
        $logs = Logs::where('created_by',$id)->orderBy('id','desc')->paginate(10);

        return view('admin.users.profile',compact('user','logs','param'));
    }

    public function filter()
    {
        $params = Input::all();

        $params['sort'] = 'activity_date';
        $params['order'] = isset($params['order']) && $params['order'] == 'asc' ? 'asc' : 'desc';
        $params['pageLimit'] = isset($params['pageLimit']) && $params['pageLimit'] < 101 ? $params['pageLimit'] : 10;

        return $this->apply_filter($params);
    }

    public function apply_filter($param = null)
    {
        $user = User::where('id',$param['id'])->first();

        if(isset($param['order'])){
            $logs = Logs::where('created_by',$param['id'])->orderBy($param['sort'],$param['order'])->paginate($param['pageLimit']);
        } else {
            $logs = Logs::where('created_by',$param['id'])->paginate($param['pageLimit']);
        }

        return view('admin.users.profile',compact('user','logs','param'));
    }

}
