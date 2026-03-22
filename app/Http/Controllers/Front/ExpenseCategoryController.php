<?php

namespace App\Http\Controllers\Front;

use App\Models\ExpenseCategory;
use App\Helpers\Helper;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        return view('front.expense-category.index');
    }

    public function list(Request $request) {

        $userId = auth()->user()->id;

        $expenseCategoryes = ExpenseCategory::where('user_id', $userId)->get();

        return DataTables::of($expenseCategoryes)
            ->addIndexColumn()
            ->editColumn('name', function ($expenseCategory) {
                return $expenseCategory->name ?? '-';
            })
            ->editColumn('created_at', function ($expenseCategory) {
                return Carbon::parse($expenseCategory->created_at)->format('d-m-Y');
            })
            ->editColumn('status', function ($expenseCategory) {
                if ($expenseCategory->status == 1) {
                    return "<span class='badge bg-success'>Active</span>";
                } else {
                    return "<span class='badge bg-danger'>Inactive</span>";
                }
            })
            ->addColumn('action', function ($expenseCategory) {

                $id = Helper::encryptor($expenseCategory->id, 'encrypt');

                return '
                    <a href="'.route('expense-category.edit', $id).'" class="text-primary">
                        <i class="uil uil-edit"></i>
                    </a>

                    <form action="'.route('expense-category.delete', $id).'" method="POST" class="d-inline-block delete-form">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <a href="#" class="text-danger delete-expense-category">
                            <i class="uil uil-trash"></i>
                        </a>
                    </form>
                ';
            })

            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function create() {
        $expenseCategory = [];

        return view('front.expense-category.create', compact('expenseCategory'));
    }

    public function store(Request $request) {
        
        $userId = auth()->user()->id;

        ExpenseCategory::create([
            'user_id' => $userId,
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Expense Category created successfully'
        ]);

    }

    public function edit($expenseCategoryId) {
        $expenseCategoryId = Helper::encryptor($expenseCategoryId, 'decrypt');

        $expenseCategory = ExpenseCategory::findOrFail($expenseCategoryId);

        return view('front.expense-category.edit', compact('expenseCategory'));
    }

    public function update(Request $request,$expenseCategoryId) {

        $userId = auth()->user()->id;

        $expenseCategoryId = Helper::encryptor($expenseCategoryId, 'decrypt');

        $expenseCategory = ExpenseCategory::findOrFail($expenseCategoryId);
        $expenseCategory->update([
            'user_id' => $userId,
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Expense Category updated successfully'
        ]);
    }

    public function destroy($expenseCategoryId) {
        $expenseCategoryId = Helper::encryptor($expenseCategoryId, 'decrypt');

        ExpenseCategory::findOrFail($expenseCategoryId)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Expense Category deleted successfully'
        ]);
    }
}