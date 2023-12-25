<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\payment;
use Illuminate\Http\Request;

class reportController extends Controller
{
    public function down_money(){


        $alldown = payment::with('customer')->where('remarks','=',null)->where('description','=','Down payment')->get();
       
        return view('backend.report.downmoney',compact('alldown'));
    }

    public function booking_money(){


        $alldown = payment::with('customer')->where('remarks','=','Paid')->where('description','=','Booking Money')->get();
       
        return view('backend.report.bookingmoney',compact('alldown'));
    }

    public function  due_installment(){


        $installments = payment::with('customer')->where('remarks','=',null)->where('description','!=','Down payment')->paginate(7);
      
        return view('backend.report.dueinstallment',compact('installments'));
    }
   
}
