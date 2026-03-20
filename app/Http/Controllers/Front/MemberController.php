<?php

namespace App\Http\Controllers\front;

use App\Models\User;
use App\Helpers\Helper;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index() {
        return view('front.manager.member.index');
    }

    function list(Request $request) {

        $userId = auth()->user()->id;

        $member = User::where('role','=',0)->where('society_id', $userId)->get();

        return DataTables::of($member)
            ->addIndexColumn()
            ->editColumn('created_at',function($member){
                return \Carbon\Carbon::parse($member->created_at)->format('Y-m-d');
            })
            ->editColumn('is_status', function($member) {
                $status = !empty($member->is_status) && $member->is_status == 1 ? "<div class='btn btn-sm btn-primary '>Active</div>" : "<div class='btn btn-sm btn-danger '>Delete</div>";
                return $status;
            })
            ->addColumn('action',function($member){

                $memberId = Helper::encryptor($member->id, 'encrypt');

                return '<a href="javascript:" class="btn text-primary btn-md p-0 edit-member" data-id="'.$memberId.'" data-bs-toggle="modal"><i class="uil uil-edit"></i></a> <form class="d-inline-block" action="'.route('user.delete', $memberId).'" id="delete-member" method="POST"><input type="hidden" name="_method" value="DELETE"><input type="hidden" value="'.csrf_token().'" name="_token"><a href="javascript:" class="btn btn-md text-danger p-0 btn-delete"><i class="uil uil-trash"></i></a></form>';
            })
            ->rawColumns(['action','is_status'])->make(true);
    }

    public function create(Request $request) {
        $member = [];
        return view('front.manager.member.modals.forms', compact('member'));
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $userId = auth()->user()->id;

        $member = new User();

        $member->name = $request->name;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->password =  Hash::make($request->password);
        $member->society_id = $userId;
        $member->save();

        // event(new Registered($member));

        return response()->json(['status' => 'success','message' => 'Member Added successfully']);
    }

    public function edit(Request $request, $memberId) {

        $member_id = Helper::encryptor($memberId, 'decrypt');

        $member = User::find($member_id);

        return view('front.manager.member.modals.forms', compact('member'));
    }

    public function update(Request $request, $memberId) {

        $member_id = Helper::encryptor($memberId, 'decrypt');

        $userId = auth()->user()->id;

        $member = User::find($member_id);
        $member->name = $request->name;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->password =  Hash::make($request->password);
        if($request->has('is_status')) {
            $member->is_status = $request->is_status;
        }
        $member->society_id = $userId;
        $member->save();

        return response()->json(['status' => 'success','message' => 'Member updated successfully']);
    }

    public function delete(User $user) {

        $user->delete();

        return response()->json(['status' => 'success','message' => 'Member deleted successfully']);
    }
}
