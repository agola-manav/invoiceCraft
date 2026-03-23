<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Company;
use App\Helpers\Helper;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return view('front.product.index');
    }

    public function list(Request $request) {

        $userId = auth()->user()->id;
    }

    public function create() {
    }

    public function store(Request $request) {
        
        $userId = auth()->user()->id;
    }

    public function edit($paymentModeId) {
        $paymentModeId = Helper::encryptor($paymentModeId, 'decrypt');
    }

    public function update(Request $request,$paymentModeId) {

        $userId = auth()->user()->id;

        $paymentModeId = Helper::encryptor($paymentModeId, 'decrypt');
    }

    public function destroy($paymentModeId) {
        $paymentModeId = Helper::encryptor($paymentModeId, 'decrypt');
    }
}