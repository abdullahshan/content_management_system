<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\customer;
use App\Models\report;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\payment;
use App\Models\User;


class backendController extends Controller
{
  

    public function index(){


            $allcustomer = customer::all();
            $allinvoice = report::all();

            $utility = report::where('remarks','=',"Paid")
            ->where('description','=','Utility')->get();

            $utility_amount = 0;
            foreach($utility as $samount){

                $utility_amount = $utility_amount+$samount->amount;
            }


            $utility_due = payment::where('description','=','Utility')->get();


            $due_utility = 0;
            foreach($utility_due as $samount){

                $due_utility = $due_utility+$samount->amount;
            }

            $due_utility = $due_utility- $utility_amount;

            $utility_total = payment::where('description','=','Utility')->get();

            $utility_total_amount = 0;
            foreach($utility_total as $samount){

                $utility_total_amount = $utility_total_amount+$samount->amount;
            }


            $count_customer = count($allcustomer);
            $count_invoice = count($allinvoice);


            $allpay = payment::Where('remarks','=','Paid')->Where('description','!=','Utility')->get();
            $allpay_due = payment::Where('due','!=',null)->Where('description','!=','Utility')->get();


            $amount = 0;
            foreach($allpay as $pay){

                $amount = $amount+$pay->amount;
               
            }

           

            $amount_due = 0;
            foreach($allpay_due as $pay){

               
                    $amount_due = $amount_due+$pay->due;
                
            }


            $amount = $amount+$amount_due;


            $duw_amount = payment::where('description','!=','Utility')->get();
            $total_amount = 0;
            foreach($duw_amount as $samount){

                $total_amount = $total_amount+$samount->amount;
            }

           $total_duw = $total_amount- $amount;


           $now = Carbon::now();

           $date = $now->format('Y-m-d');
   
           $report = payment::where('remarks','=','Paid')->Where('description','!=','Utility')->where('created_at',$date)->get();
           $report_due = payment::where('due','!=',null)->Where('description','!=','Utility')->where('created_at',$date)->get();
   
           $today_amount = 0;
           foreach($report as $s_report){
   
               $today_amount = $today_amount + $s_report->amount;
           }

           $today_amount_due = 0;
           foreach($report_due as $s_report){
   
               $today_amount_due = $today_amount_due + $s_report->due;
           }


           $today_amount =  $today_amount+$today_amount_due;
   
   
           $date = Carbon::now()->subDays(30);
   
           $report_mont = payment::where('remarks','=','Paid')->Where('description','!=','Utility')->where('created_at', '>=', $date)->get();
           
           $report_mont_due = payment::where('due','!=',null)->Where('description','!=','Utility')->where('created_at', '>=', $date)->get();
           
           
           $amount_month = 0;
           foreach($report_mont as $s_report){
   
               $amount_month = $amount_month + $s_report->amount;
           }

           $amount_month_due = 0;
           foreach($report_mont_due as $s_report){
   
               $amount_month_due = $amount_month_due + $s_report->due;
           }

           $amount_month = $amount_month+$amount_month_due;
   
   
           $duemonthly = payment::where('created_at', '>=', $date)->where('description','!=','Utility')->get();
   
            $mounthlydue = 0;
            
            foreach($duemonthly as $samount){
                
                $mounthlydue = $mounthlydue+$samount->amount;
            }


            $mounthlydue =  $mounthlydue-$amount_month;


            
             $now = Carbon::now();
             $date = $now->format('Y-m-d');

           
   
   
             $todaydue = payment::where('created_at',$date)
             ->where('description','!=','Utility')->get();


   
             
               $todaydueamount = 0;
            
            foreach($todaydue as $samount){
                
                $todaydueamount = $todaydueamount+$samount->amount;
            }



        $todaydueamount  = $todaydueamount-$today_amount;

       



   
           $all_pay = report::with('customer')->where('created_at', '>=', $date)->get();


           $total_admin = User::where('type','=','Admin')->get();
           $total_user = User::where('type','!=','User')->get();
           
           $total_admin = count($total_admin);
           $count_user = count($total_user);



    return view('backend.index',compact('utility_total_amount','due_utility','utility_amount','todaydueamount','mounthlydue','count_user','total_admin','total_amount','count_customer','count_invoice','amount','total_duw','today_amount','amount_month'
      

        ));
    }

    


}
