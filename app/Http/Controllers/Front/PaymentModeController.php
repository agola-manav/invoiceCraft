<?php

namespace App\Http\Controllers\Front;

use App\Models\PaymentMode;
use App\Helpers\Helper;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentModeController extends Controller
{
    public function index()
    {
        return view('front.payment-mode.index');
    }

    public function list(Request $request) {

        $userId = auth()->user()->id;

        $paymentModes = PaymentMode::where('user_id', $userId)->get();

        return DataTables::of($paymentModes)
            ->addIndexColumn()
            ->editColumn('name', function ($paymentMode) {
                return $paymentMode->name ?? '-';
            })
            ->editColumn('created_at', function ($paymentMode) {
                return Carbon::parse($paymentMode->created_at)->format('d-m-Y');
            })
            ->editColumn('status', function ($paymentMode) {
                if ($paymentMode->status == 1) {
                    return "<span class='badge bg-success'>Active</span>";
                } else {
                    return "<span class='badge bg-danger'>Inactive</span>";
                }
            })
            ->addColumn('action', function ($paymentMode) {

                $id = Helper::encryptor($paymentMode->id, 'encrypt');

                return '
                    <a href="'.route('payment-mode.edit', $id).'" class="text-primary">
                        <i class="uil uil-edit"></i>
                    </a>

                    <form action="'.route('payment-mode.delete', $id).'" method="POST" class="d-inline-block delete-form">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <a href="#" class="text-danger delete-payment-mode">
                            <i class="uil uil-trash"></i>
                        </a>
                    </form>
                ';
            })

            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function create() {
        $paymente = [];

        return view('front.payment-mode.create', compact('paymente'));
    }

    public function store(Request $request) {
        
        $userId = auth()->user()->id;

        PaymentMode::create([
            'user_id' => $userId,
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Payment Mode created successfully'
        ]);

    }

    public function edit($paymentModeId) {
        $paymentModeId = Helper::encryptor($paymentModeId, 'decrypt');

        $paymente = PaymentMode::findOrFail($paymentModeId);

        return view('front.payment-mode.edit', compact('paymente'));
    }

    public function update(Request $request,$paymentModeId) {

        $userId = auth()->user()->id;

        $paymentModeId = Helper::encryptor($paymentModeId, 'decrypt');

        $paymentMode = PaymentMode::findOrFail($paymentModeId);
        $paymentMode->update([
            'user_id' => $userId,
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Payment Mode updated successfully'
        ]);
    }

    public function destroy($paymentModeId) {
        $paymentModeId = Helper::encryptor($paymentModeId, 'decrypt');

        PaymentMode::findOrFail($paymentModeId)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Payment Mode deleted successfully'
        ]);
    }
}