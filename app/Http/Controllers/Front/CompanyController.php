<?php

namespace App\Http\Controllers\Front;

use App\Models\Company;
use App\Models\BankDetail;
use App\Models\InvoiceSetting;
use App\Models\QuotationSetting;
use App\Helpers\Helper;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function index()
    {
        return view('front.company.index');
    }

    public function list(Request $request) {

        $userId = auth()->user()->id;

        $companies = Company::where('user_id', $userId)->get();

        return DataTables::of($companies)
            ->addIndexColumn()

            ->editColumn('name', function ($company) {
                return $company->name ?? '-';
            })
            ->editColumn('phone_number', function ($company) {
                return $company->phone_number ?? '-';
            })
            ->editColumn('gst_number', function ($company) {
                return $company->gst_number ?? '-';
            })
            ->editColumn('created_at', function ($company) {
                return Carbon::parse($company->created_at)->format('d-m-Y');
            })
            ->editColumn('status', function ($company) {
                if ($company->status == 1) {
                    return "<span class='badge bg-success'>Active</span>";
                } else {
                    return "<span class='badge bg-danger'>Inactive</span>";
                }
            })
            ->addColumn('action', function ($company) {

                $id = Helper::encryptor($company->id, 'encrypt');

                return '
                    <a href="'.route('companies.edit', $id).'" class="text-primary">
                        <i class="uil uil-edit"></i>
                    </a>

                    <form action="'.route('companies.delete', $id).'" method="POST" class="d-inline-block delete-form">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <a href="#" class="text-danger delete-company">
                            <i class="uil uil-trash"></i>
                        </a>
                    </form>
                ';
            })

            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function create() {

        $company = new Company();

        return view('front.company.create', compact('company'));
    }

    public function store(Request $request) {

        DB::beginTransaction();

        try {

            $userId = auth()->user()->id;

            // ✅ Upload Files
            $imageName = null;
            if ($request->hasFile('image')) {
                $imageName = time().'_logo.'.$request->image->extension();
                $request->image->move(public_path('uploads/company-logo'), $imageName);
            }

            $signName = null;
            if ($request->hasFile('sign')) {
                $signName = time().'_sign.'.$request->sign->extension();
                $request->sign->move(public_path('uploads/company-sign'), $signName);
            }

            // ✅ Save Company
            $company = Company::create([
                'user_id' => $userId,
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'gst_number' => $request->gstn,
                'email' => $request->email,
                'website' => $request->website,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'pincode' => $request->pincode,
                'logo' => $imageName,
                'signature' => $signName,
            ]);

            // ✅ Save Bank Details
            BankDetail::create([
                'user_id' => $userId,
                'company_id' => $company->id,
                'bank_name' => $request->bank_name,
                'account_number' => $request->ac_no,
                'ifsc' => $request->isfc,
                'upi_id' => $request->upi_id,
            ]);

            // ✅ Save Invoice Settings
            InvoiceSetting::create([
                'user_id' => $userId,
                'company_id' => $company->id,
                'invoice_terms' => $request->invoice_terms,
                'invoice_remarks' => $request->invoice_remarks,
                'invoice_prefix' => $request->invoice_prefix,
                'invoice_counter' => $request->invoice_counter ?? 0,
            ]);

            // ✅ Save Quotation Settings
            QuotationSetting::create([
                'user_id' => $userId,
                'company_id' => $company->id,
                'quotation_terms' => $request->quotation_terms,
                'quotation_remarks' => $request->quotation_remarks,
                'quotation_prefix' => $request->quotation_prefix,
                'quotation_counter' => $request->quotation_counter ?? 0,
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Company created successfully'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function edit(Request $request, $companyId) {
        $companyId = Helper::encryptor($companyId, 'decrypt');

        $company = Company::with(['bankDetail','invoiceSetting','quotationSetting'])->find($companyId);

        return view('front.company.edit', compact('company'));
    }

    public function update(Request $request, $companyId)
    {
        $companyId = Helper::encryptor($companyId, 'decrypt');

        DB::beginTransaction();

        try {

            $userId = auth()->user()->id;

            $company = Company::findOrFail($companyId);

            // ✅ Upload Logo (replace old)
            if ($request->hasFile('image')) {

                if (!empty($company->logo) && file_exists(public_path('uploads/company-logo/'.$company->logo))) {
                    unlink(public_path('uploads/company-logo/'.$company->logo));
                }

                $imageName = time().'_logo.'.$request->image->extension();
                $request->image->move(public_path('uploads/company-logo'), $imageName);

                $company->logo = $imageName;
            }

            // ✅ Upload Signature (replace old)
            if ($request->hasFile('sign')) {

                if (!empty($company->signature) && file_exists(public_path('uploads/company-sign/'.$company->signature))) {
                    unlink(public_path('uploads/company-sign/'.$company->signature));
                }

                $signName = time().'_sign.'.$request->sign->extension();
                $request->sign->move(public_path('uploads/company-sign'), $signName);

                $company->signature = $signName;
            }

            // ✅ Update Company
            $company->update([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'gst_number' => $request->gstn,
                'email' => $request->email,
                'website' => $request->website,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'pincode' => $request->pincode,
            ]);

            // ✅ Bank (update or create)
            $company->bankDetail()->updateOrCreate(
                ['company_id' => $company->id],
                [
                    'user_id' => $userId,
                    'bank_name' => $request->bank_name,
                    'account_number' => $request->ac_no,
                    'ifsc' => $request->isfc,
                    'upi_id' => $request->upi_id,
                ]
            );

            // ✅ Invoice
            $company->invoiceSetting()->updateOrCreate(
                ['company_id' => $company->id],
                [
                    'user_id' => $userId,
                    'invoice_terms' => $request->invoice_terms,
                    'invoice_remarks' => $request->invoice_remarks,
                    'invoice_prefix' => $request->invoice_prefix,
                    'invoice_counter' => $request->invoice_counter ?? 0,
                ]
            );

            // ✅ Quotation
            $company->quotationSetting()->updateOrCreate(
                ['company_id' => $company->id],
                [
                    'user_id' => $userId,
                    'quotation_terms' => $request->quotation_terms,
                    'quotation_remarks' => $request->quotation_remarks,
                    'quotation_prefix' => $request->quotation_prefix,
                    'quotation_counter' => $request->quotation_counter ?? 0,
                ]
            );

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Company updated successfully'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($companyId)
    {
        $companyId = Helper::encryptor($companyId, 'decrypt');

        DB::beginTransaction();

        try {

            $company = Company::findOrFail($companyId);

            $company->bankDetail()->delete();
            $company->invoiceSetting()->delete();
            $company->quotationSetting()->delete();

            if ($company->logo && file_exists(public_path('uploads/company-logo/'.$company->logo))) {
                unlink(public_path('uploads/company-logo/'.$company->logo));
            }

            if ($company->signature && file_exists(public_path('uploads/company-sign/'.$company->signature))) {
                unlink(public_path('uploads/company-sign/'.$company->signature));
            }

            $company->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Company deleted successfully'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}