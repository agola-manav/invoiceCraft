<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Package;
use Carbon\Carbon;
use App\Http\Controllers\Controller;


class PackageController extends Controller
{
    public function index() {

        return view('admin.package.index');
    }

    public function create(Request $request) {

        $package = [];

        return view('admin.package.modals.form', compact('package'));
    }

    public function list(Request $request) {

        $packages = Package::all();

        return DataTables::of($packages)
        ->addIndexColumn()
        ->editColumn('created_at',function($packages){
            return \Carbon\Carbon::parse($packages->created_at)->format('Y-m-d');
        })
        ->editColumn('description', function ($packages) {
            return \Str::words(strip_tags($packages->description), 5, '...');
        })
        ->editColumn('interval_type', function ($packages) {
            
            switch ($packages->interval_type) {
                case 0:
                    return 'Monthly';
                case 1:
                    return 'Half-Yearly';
                case 2:
                    return 'Yearly';
                default:
                    return 'Unknown';
            }
            
        })
        ->editColumn('price', function ($packages) {
            return number_format($packages->price);
        })
        ->editColumn('is_status', function($packages) {
            $status = !empty($packages->is_status) && $packages->is_status == 1 ? "<div class='btn btn-sm btn-primary '>Active</div>" : "<div class='btn btn-sm btn-danger '>Delete</div>";
            return $status;
        })
        ->addColumn('action',function($packages){
            return '<a href="javascript:" class="btn text-primary btn-md p-0 edit-package" data-id="'.$packages->id.'" data-bs-toggle="modal"><i class="uil uil-edit"></i></a> <form class="d-inline-block" action="'.route('user.delete', $packages->id).'" id="delete-user" method="POST"><input type="hidden" name="_method" value="DELETE"><input type="hidden" value="'.csrf_token().'" name="_token"><a href="javascript:" class="btn btn-md text-danger p-0 btn-delete"><i class="uil uil-trash"></i></a></form>';
        })
        ->rawColumns(['features','action','is_status'])->make(true);
    }

    public function store(Request $request) {

        $package = new Package();
        $package->title = $request->title;
        $package->description = $request->description;
        $package->interval_type = $request->interval_type;
        $package->max_user = $request->max_user;
        $package->price = $request->price;
        $package->features = $request->features;
        $package->save();

        return response()->json(['status' => 'success', 'message' => 'Package create successfully']);
    }

    public function edit(Request $request, Package $package) {

        return view('admin.package.modals.form', compact('package'));
    }

    public function update(Request $request, Package $package) {

        $package->title = $request->title;
        $package->description = $request->description;
        $package->interval_type = $request->interval_type;
        $package->max_user = $request->max_user;
        $package->price = $request->price;
        $package->features = $request->features;
        $package->save();

        return response()->json(['status' => 'success', 'message' => 'Package update successfully']);
    }
}
