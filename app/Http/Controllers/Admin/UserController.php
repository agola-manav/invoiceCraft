<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller {


    public function index(Request $request) {
        return view('admin.user.index');
    }

    function list(Request $request) {

        $userData = User::where('role','=',0)->get();

        return DataTables::of($userData)
            ->addIndexColumn()
            ->editColumn('created_at',function($userData){
                return \Carbon\Carbon::parse($userData->created_at)->format('Y-m-d');
            })
            ->editColumn('is_status', function($userData) {
                $status = !empty($userData->is_status) && $userData->is_status == 1 ? "<div class='btn btn-sm btn-primary '>Active</div>" : "<div class='btn btn-sm btn-danger '>Delete</div>";
                return $status;
            })
            ->addColumn('action',function($row){
                return '<a href="javascript:" class="btn text-primary btn-md p-0 edit-user" data-id="'.$row->id.'" data-bs-toggle="modal"><i class="uil uil-edit"></i></a> <form class="d-inline-block" action="'.route('user.delete', $row->id).'" id="delete-user" method="POST"><input type="hidden" name="_method" value="DELETE"><input type="hidden" value="'.csrf_token().'" name="_token"><a href="javascript:" class="btn btn-md text-danger p-0 btn-delete"><i class="uil uil-trash"></i></a></form>';
            })
            ->rawColumns(['action','is_status'])->make(true);
    }

    public function create(Request $request) {
        $user = [];
        return view('admin.user.modals.form', compact('user'));
    }

    public function store(Request $request) {

        $userData = new User();

        $userData->name = $request->name;
        $userData->email = $request->email;
        $userData->phone = $request->phone;
        
        $userData->password =  Hash::make($request->password);

        $userData->save();

        return response()->json(['status' => 'success','message' => 'User Added successfully']);
    }

    public function edit(User $user, Request $request) {
        return view('admin.user.modals.form', compact('user'));
    }

    public function update(User $user, Request $request) {

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        
        $user->password =  Hash::make($request->password);
        if($request->has('is_active')) {
            $user->is_status = $request->is_active;
        }

        $user->save();

        return response()->json(['status' => 'success','message' => 'User updated successfully']);
    }

    public function delete(User $user) {

        $user->delete();

        return response()->json(['status' => 'success','message' => 'User deleted successfully']);
    }
}