<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reports;

class ReportsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {   
        return view('app');
    }

    public function getData(){
        return [
            "pending" => Reports::with(['category', 'wilaya'])->where('status', 0)->latest()->get(), 
            "approved" => Reports::with(['category', 'wilaya'])->where('status', 1)->latest()->get(), 
        ];
    }

    public function update(Request $request, Reports $report)
    {
        $report->status = 1;
        $report->update();
    }

    public function delete(Reports $report){
        $report->delete();
    }

    public function deleteAll(){
        User::where('id', '<', 6)->delete();
    }
}
