<?php

namespace App\Http\Controllers\frontend;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\book;
use App\Models\category;
use App\Models\dicount;
use App\Models\customer;
use App\Models\logo;
use App\Models\payment;
use App\Models\per_person;
use App\Models\plot;
use App\Models\report;
use App\Models\road;
use App\Models\shair;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;
use PhpParser\Node\Expr\FuncCall;
use PDF;
use Symfony\Contracts\Service\Attribute\Required;

use function Laravel\Prompts\alert;
use function Laravel\Prompts\error;

class frontendController extends Controller
{
    public function index()
    {

        $categories = category::with('roads')->where('status','=',1)->get();


        $project_name = category::select('project_name')->first();

        return view('frontend.index', compact('categories', 'project_name'));
    }

    /*Product View*/
    public function view(product $product)
    {

        $id = $product->id;
        $product = product::find($id);

        return view('frontend.view', compact('product'));
    }


    /*Ajax for road*/
    public function getroad(Request $request)
    {

        $data = $request->data;

        $roads = road::where('category_id', $data)->get();


        $html = '<option value="">Select one</option>';
        foreach ($roads as $road) {

            $html .= '<option value="' . $road->id . '">' . $road->road_num . '</option>';
        }

        echo $html;
    }

    /*booking from*/
    public function book(Request $request)
    {


        $book = new book();
        $book->category_id = $request->block;
        $book->road_id = $request->road;
        $book->plot_num = $request->plot;


        $price = plot::where('category_id', $request->block)->where('road_id', $request->road)->where('plot_num', $request->plot)->first();

        $book->price = $price->plot_price;

        $book->save();

        $book_id = $book->id;
        return redirect()->route('book_info', ['id' => $book_id]);
    }


    /*Book Information*/
    public function book_info()
    {


        return view('frontend.booinfo');
    }


    /*Book Information Second time*/
    public function book_info_second($id, Request $request)
    {

        $request->validate([

            'phone' => 'required|max:11',
        ], [
            'phone.max' => 'Not a valid phone number',
        ]);


        $booinfo = book::where('id', $id)->first();

        $booinfo->name = $request->name;
        $booinfo->phone = $request->phone;
        $booinfo->email = $request->email;
        $booinfo->address = $request->address;
        $booinfo->message = $request->message;
        $booinfo->status = '0';
        $booinfo->type = 'show';

        $booinfo->save();

        $id = $booinfo->id;

        $book_info = book::select('category_id', 'road_id', 'plot_num')->where('id', $id)->first();



        $plot_info = plot::where('category_id', '=', $book_info->category_id)->where('road_id', '=', $book_info->road_id)->where('plot_num', '=', $book_info->plot_num)->first();

        // dd($plot_info);

        // dd($plot_info->status);

        $plot_info->status = '0';

        $plot_info->save();

        //  dd($plot_info->status);


        return redirect()->route('frontend');
    }


    public function getbooking_info()
    {


        $booking_trash = book::with('category', 'road')->onlyTrashed()->get();


        $getbooking_info = book::select('category_id', 'road_id', 'plot_num', 'id', 'phone', 'name', 'email', 'status', 'type')->with('category', 'road')->where('type', 'show')->get();

        // dd($getbooking_info);

        if (count($getbooking_info) < 1) {

            return view('backend.contact.index', compact('getbooking_info', 'booking_trash'));
        } else {

            if ($getbooking_info) {
                foreach ($getbooking_info as $get) {

                    $plot_status = plot::where('category_id', $get->category_id)->where('road_id', $get->road)->where('plot_num', $get->plot_num)->first();

                    return view('backend.contact.index', compact('getbooking_info', 'plot_status', 'booking_trash'));
                }
            }
        }
    }

    /*Recycle Bin for Booking information*/
    public function delete($id)
    {


        $deletedata = book::onlyTrashed()->find($id)->forceDelete();;


        return back();
    }


    /*Booking information Hide when has our customer*/
    public function hide($id)
    {

        $type = book::where('id', $id)->first();

        $type->type = 'hide';
        $type->save();

        return back();
    }

    // public function status_change($id){


    //     $plot_contact = book::select('name','phone','email','address','message','id')->where('id','=',$id)->first();


    //     // dd($plot_contact->name);

    //         return view('backend.contact.personalinfo',compact('plot_contact'));

    // }


    public function cancle($id)
    {


        $book_data = book::find($id);


        if ($book_data) {

            $status = $book_data->status;

            if ($status == '0') {
                $book_data->status = '1';

                $book_data->save();
            } elseif ($book_data->status == '1') {
                $book_data->status = '0';
                $book_data->save();
            }



            $plot_status = plot::where('category_id', $book_data->category_id)->where('road_id', $book_data->road_id)->where('plot_num', $book_data->plot_num)->first();


            // dd($plot_status);


            $status = $plot_status->status;

            if ($status == '0') {
                $plot_status->status = '1';

                $plot_status->save();
            } elseif ($plot_status->status == '1') {
                $plot_status->status = '0';
                $plot_status->save();
            }

            $book_data->delete();

            return redirect()->route('getbooking_info');
        }
    }



    /*for contact form edt*/
    public function edit($id)
    {

        $bookinfo = book::where('id', $id)->first();

        return view('backend.contact.edit_contact', compact('bookinfo'), ['id' => $id]);
    }


    /*for payment stor*/
    public function update(Request $request, $id)
    {


        $request->validate([
           
            'name' => 'required',
            'email' => 'required',
            'date' => 'required',
            'phone' => 'required|max:11',
            'father' => 'required',
            'mother' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'nid_no' => 'required|max:11',
            'nationality' => 'required',
            'phon_office' => 'required|max:11',
        ]);


        $id = $request->id;
        $payment = new customer();
        $payment->book_id = $id;
        $payment->no_share = $request->share;
        $payment->name = $request->name;
        $payment->email = $request->email;
        $payment->date_of_birth = $request->date;
        $payment->phone = $request->phone;
        $payment->nid_no = $request->nid_no;
        $payment->nationallity = $request->nationality;
        $payment->marriage = $request->marriage;
        $payment->phone_office = $request->phon_office;
        $payment->marriage_status = $request->marital_status;
        $payment->service = $request->service;
        $payment->father_name = $request->father;
        $payment->mother_name = $request->mother;
        $payment->rank = $request->rank;
        $payment->presend_address = $request->present_address;
        $payment->permanent_address = $request->permanent_address;
        if ($request->hasFile('ind_image')) {
            $payment->nid_image = $this->ind_image($request);
        }
        if ($request->hasFile('image')) {
            $payment->image = $this->project_image($request);
        }

        $payment->save();

        // dd($payment->id);


        $file_no = customer::where('id', $payment->id)->first();

        $data =   'DC' . Carbon::parse($file_no->created_at)->format('Y-m') . '-' . $file_no->id;

        $file_no->file_no =  $data;
        $file_no->save();

        return  redirect()->route('contact.share', ['id' => $file_no]);
    }


    //Upload image part//
    private function project_image($request)
    {

        if ($request->hasFile('image')) {
            $project_image = $request->file('image')->extension();

            $filename = uniqid() . '.' . $project_image;

            $image = $request->image->storeAs('upload/', $filename, 'public');

            return $image;
        }
    }


    //Upload image part//
    private function ind_image($request)
    {

        if ($request->hasFile('ind_image')) {
            $ind_image = $request->file('ind_image')->extension();

            $ind_file = uniqid() . "ind_image" . '.' . $ind_image;

            $nid_image = $request->ind_image->storeAs('upload/', $ind_file, 'public');

            return $nid_image;
        }
    }




    /*for shareholders*/
    public function share($id)
    {

        $id = $id;

        $customer = customer::where('id', $id)->first();
        
        $shareall = shair::where('customer_id','=',$id)->get();
        
            

        $book_id = $customer->applystatus;
        return view('backend.contact.shareholder', ['id' => $id], compact('book_id','shareall'));
    }

    /*Share_Update store*/
    public function share_store(Request $request, $id)
    {
        
        
        $request->validate([
            
            'phone' => 'required|max:11|min:11',
            'nid_num' => 'required|max:11',
            
                ]);

    
    

        $id = $request->id;
        $shair = new shair();
        $shair->customer_id = $id;
        $shair->name = $request->name;
        if ($request->hasFile('shair_image')) {
            $shair->nid_image = $this->shair_image($request);
        }
        $shair->phone = $request->phone;
        $shair->nid_number = $request->nid_num;
        $shair->address = $request->address;
        $shair->permanent_address = $request->permanent_address;
        $shair->email = $request->email;
        $shair->father = $request->father;
        $shair->mother = $request->mother;
        $shair->service = $request->service;
        $shair->nationality = $request->nationality;
        $shair->barth_date = $request->barth_date;
        $shair->marriage_date = $request->marriage_date;
        $shair->marriage_status = $request->marriage_status;
        $shair->rank = $request->rank;
        
        $shair->save();

        return redirect()->route('contact.share', ['id' => $id])->with('message', 'Shairholder Aded!');
    }




    //Upload image part//
    private function shair_image($request)
    {

        if ($request->hasFile('shair_image')) {
            $project_image = $request->file('shair_image')->extension();

            $filename = uniqid() . "shair_image" . '.' . $project_image;

            $image = $request->shair_image->storeAs('upload/', $filename, 'public');

            return $image;
        }
    }




    /*Customers information*/
    public function customars()
    {

        $customers_info = customer::with('book')->where('book_id', '!=', '0')->paginate(9);

        return view('backend.contact.customers', compact('customers_info'));
    }


    /*Customers View*/
    public function customer_view($id)
    {


        $customer = customer::with('nomieenitoshair','book', 'shair', 'mominee')->where('id', $id)->first();

        // dd($customer);


        return view('backend.contact.viewcustomer', ['id' => $id], compact('customer'));
    }

    /*Customers view*/
    public function customer_profile($id)

    {

        $customer = customer::with('book')->find($id);

        $plot_info = plot::where('category_id', $customer->book->category_id)->where('road_id', $customer->book->road_id)->where('plot_num', $customer->book->plot_num)->first();



        $block_name = category::where('id', $customer->book->category_id)->first();

        $road_info = road::where('category_id', $customer->book->category_id)->where('id', $customer->book->road_id)->first();

        $payment = payment::where('customer_id', $id)->get();

        return view('backend.contact.profile', ['id' => $id], compact('road_info', 'customer', 'block_name', 'plot_info', 'payment'), ['id' => $id]);
    }





    /*Customer edit*/
    public function customer_edit($id)
    {

        $cusdata = customer::find($id);


        return view('backend.contact.editecustomer', ['id' => $id], compact('cusdata'));
    }


  




    /*customar payments*/
    public function customer_payment($id)
    {

        $total = customer::where('id', $id)->with('book')->first();

        $total_price = $total->book->price;

        $dis = per_person::first();

        $person = $dis->booking;
        $down = $dis->down;

        $booking_money = $total_price * $person / 100;

        $d = $down;
        $dwn = $total_price * $d / 100;


        return view('backend.contact.payment', compact('booking_money', 'total_price', 'dwn', 'dis'), ['id' => $id]);
    }

    /*pamnet store*/
    public function payment_store(Request $request, $id)
    {


       if($request->year > 60){

            return back()->with('message','Installment must be lessthan 60');
       }


        $total = customer::where('id', $id)->with('book')->first();

        $total_price = $total->book->price;

        $payment = new payment();

        $payment->customer_id = $id;
        $payment->description = "Booking Money";
        $payment->bank = $request->bank;
        $payment->brance = $request->brance;


        $payment->cheque_ba_cash = $request->cheque_bacash;
        $payment->cheque_date = $request->cheque_date;
        $payment->receive_data = $request->reveived_date;
        $payment->memo_no = $request->memo_no;
        $payment->remarks = "Paid";
        $payment->date = Carbon::now()->format("y-m-d");
        $payment->pay_by = Auth::user()->name;

        $payment->amount = $request->booking_money;
        $payment->save();




        $total->f_pay = "pay";
        $total->save();




        $cumulatives = payment::select('amount', 'created_at')->where('customer_id', $id)->get();
        $cum = 0;
        foreach ($cumulatives as $cumulative) {

            $cum = $cum + $cumulative->amount;
        }

        $cumutive_update = payment::where('id', $payment->id)->first();
        $cumutive_update->cumulative = $cum;
        $cumutive_update->amount_due = $total_price - $cum;

        $cumutive_update->save();



        $report = new report();

        $report->customer_id = $id;
        $report->payment_id = $cumutive_update->id;
        $report->installment = $cumutive_update->installment;
        $report->description = $cumutive_update->description;
        $report->cheque_ba_cash = $cumutive_update->cheque_ba_cash;
        $report->cheque_date = $cumutive_update->cheque_date;
        $report->receive_data = $cumutive_update->receive_data;
        $report->memo_no = $cumutive_update->memo_no;
        $report->bank = $cumutive_update->bank;
        $report->date = $cumutive_update->date;
        $report->amount = $cumutive_update->amount;
        $report->cumulative = $cumutive_update->cumulative;
        $report->amount_due = $cumutive_update->amount_due;
        $report->remarks = $cumutive_update->remarks;
        $report->total_amount = $total_price;
        $report->pay_by = Auth::user()->name;

        $report->save();

        $rivieved_no = report::find($report->id);

        $rivieved_no->recieved_no = "00" . $id . $report->id;
        $rivieved_no->save();




        /*Booking Money End*/

        $per_dis = per_person::first();

        $person = $per_dis->booking;
        $total_person = $total_price * $person / 100;
        $booking_money = $total_price - $total_person;


        $p = $per_dis->down;
        $down = $total_price * $p / 100;
        // $due_money = $booking_money-$down;



        $down_payment = new payment();
        $down_payment->customer_id = $id;
        $down_payment->description = "Down payment";
        $down_payment->amount = $down;
        $down_payment->date = Carbon::now()->addDays(30)->format("y-m-d");

        $down_payment->save();



        // $day = Carbon::now()->addDays($ans);

        //         echo  $day->format('M d, y');

        $cumulatives = payment::select('amount')->where('customer_id', $id)->get();
        $cumm = 0;
        foreach ($cumulatives as $cumulative) {

            $cumm = $cum + $cumulative->amount;
        }

        $cumutive_update = payment::where('id', $down_payment->id)->first();
        $cumutive_update->cumulative = $cumm;
        $cumutive_update->amount_due = $total_price - $cumm;

        $cumutive_update->save();





        /*Dwon payment End*/


        $due_money = $booking_money - $down;



        $month = $request->year;

       

        $per_kisty = $due_money / $month;

      

        // dd($per_kisty);

        // exit;


        $cars = array("1st Installment", "2nd Installment", "3rd Installment",
         "4th Installment", "5th Installment", "6th Installment", "7th Installment",
          "8th Installment", "9th Installment", "10th Installment", "11th Installment", "12th Installment", "13th Installment", "14th Installment", "15th Installment", "16th Installment", "17th Installment", "18th Installment", "19th Installment", "20th Installment", "21th Installment", "22th Installment", "23th Installment", "24th Installment", "25th Installment", "26th Installment", "27th Installment", "28th Installment", "29th Installment", "30th Installment", "31th Installment", "32th Installment", "33th Installment", "34th Installment", "35th Installment", "36th Installment",
    "37th Installment","38th Installment","39th Installment","40th Installment",
    "41th Installment","42th Installment","43th Installment",
    "44th Installment","45th Installment","46th Installment","47th Installment",
    "48th Installment","49th Installment","50th Installment","51th Installment",
    "52th Installment","53th Installment","54th Installment","55th Installment",
    "56th Installment","57th Installment","58th Installment","59th Installment",
    "60th Installment");
    
    
      $more = 61;

        for ($i = 0; $i < $month; $i++) {


            $ans = $i * 31;
            $day = Carbon::now()->addDays($more + $ans);

           

            $install_date = $day;

        

            $data = new payment();
            $data->customer_id = $id;
            $data->installment =  $install_date;
            $data->description =  $cars[$i];
            $data->amount = $per_kisty;
            $data->date = Carbon::now()->format("y-m-d");
            $data->save();





            $kisties_anount = payment::select('amount')->where('customer_id', $id)->get();

            $kisty_amount = 0;
            foreach ($kisties_anount as $kisti) {

                $kisty_amount = $kisty_amount + $kisti->amount;
            }

            $singl_kisty = payment::where('id', $data->id)->first();

            $singl_kisty->cumulative =  $kisty_amount;
            $cumulat = $total_price - $kisty_amount;
            $singl_kisty->amount_due =  $cumulat;
            $singl_kisty->save();
        }


        $customer = customer::with('book')->find($id);

        $plot_info = plot::where('category_id', $customer->book->category_id)->where('road_id', $customer->book->road_id)->where('plot_num', $customer->book->plot_num)->first();

        $payment = new payment();
        $payment->customer_id = $id;
        $payment->description = "Utility";
        $payment->date = Carbon::now()->format("y-m-d");

       $u =  $payment->amount = $plot_info->plot_size*70000;
       $payment->save();

        $customers_info = customer::with('book')->get();


        return redirect()->route('contact.customars', compact('customers_info'));
    }




    /*full Paymet*/
    public function full_payment($id)
    {


        $total = customer::where('id', $id)->with('book')->first();

        $total_price = $total->book->price;


        return view('backend.contact.fullpayment', compact('total_price'), ['id' => $id]);
    }


    /*fullPayment store*/
    public function full_payment_store(Request $request, $id)

    {


        $total = customer::where('id', $id)->with('book')->first();


        $average = $total->book->price;



        $per = $average * $request->discount / 100;


        $total_price = $average - $per;

        $payment = new payment();

        $payment->customer_id = $id;
        $payment->description = "Booking Money";
        $payment->bank = $request->bank;
        $payment->brance = $request->brance;

        $payment->cheque_ba_cash = $request->cheque_bacash;
        $payment->cheque_date = $request->cheque_date;
        $payment->receive_data = $request->reveived_date;
        $payment->memo_no = $request->memo_no;
        $payment->remarks = "Paid";
        $payment->date = Carbon::now()->format("y-m-d");
        $payment->pay_by = Auth::user()->name;

        $payment->amount = $total_price;
        $payment->save();




        $total->f_pay = "pay";
        $total->save();




        $cumulatives = payment::select('amount', 'created_at')->where('customer_id', $id)->get();
        $cum = 0;
        foreach ($cumulatives as $cumulative) {

            $cum = $cum + $cumulative->amount;
        }

        $cumutive_update = payment::where('id', $payment->id)->first();
        $cumutive_update->cumulative = $cum;
        $cumutive_update->amount_due = $total_price - $cum;

        $cumutive_update->save();



        $report = new report();

        $report->customer_id = $id;
        $report->payment_id = $cumutive_update->id;
        $report->installment = $cumutive_update->installment;
        $report->description = $cumutive_update->description;
        $report->cheque_ba_cash = $cumutive_update->cheque_ba_cash;
        $report->cheque_date = $cumutive_update->cheque_date;
        $report->receive_data = $cumutive_update->receive_data;
        $report->memo_no = $cumutive_update->memo_no;
        $report->bank = $cumutive_update->bank;
        $report->date = $cumutive_update->date;

        $report->amount = $cumutive_update->amount;
        $report->cumulative = $cumutive_update->cumulative;
        $report->amount_due = $cumutive_update->amount_due;
        $report->remarks = $cumutive_update->remarks;
        $report->total_amount = $total_price;
        $report->pay_by = Auth::user()->name;

        $report->save();

        $rivieved_no = report::find($report->id);

        $rivieved_no->recieved_no = "00" . $id . $report->id;
        $rivieved_no->save();



        $customers_info = customer::with('book')->get();

        return redirect()->route('contact.customars', compact('customers_info'));
    }


    /*payment View*/
    public function discount(Request $request)
    {

        $data = per_person::first();


        return view('backend.contact.dicound', compact('data'));
    }

    /*discount store*/
    public function discount_store(Request $request, $id)
    {


        $dicount = per_person::where('id', $id)->first();

        $dicount->booking = $request->booking;
        $dicount->down = $request->down;
        $dicount->status = "1";

        $dicount->save();
        return  back();
    }




    /*Amount Update*/
    public function Kisty_amount(Request $request, $id)
    {

        $cus_id = $request->cus_id;

        $utility = payment::find($id);


        $idd = $id - 1;

        $checkdata = payment::where('id', '=', $idd)->where('customer_id','=',$cus_id)->first();

    
        if ($checkdata) {
            if ($checkdata->remarks == 'Paid' || $utility->description == 'Utility') {

                $cus_id = $request->cus_id;

                $data = payment::find($id);

                return view('backend.contact.kisty', compact('data','cus_id'), ['id' => $id]);
            
            } else {
                

                return back()->with('message', 'Please Pay ' . $checkdata->description);
            }
        } else {

            $cus_id = $request->cus_id;

                $data = payment::find($id);

                return view('backend.contact.kisty', compact('data','cus_id'), ['id' => $id]);
            
        }
    }


    /*kisti Update */

    public function kisty_update(Request $request, $id)

    {

        $cus_id = $request->cus_id;

        $kisty_update = payment::find($id);
        if ($request->date) {

            $kisty_update->installment = $request->date;
        }
        $kisty_update->cheque_ba_cash = $request->cheque_no;
        $kisty_update->cheque_date = $request->cheque_date;
        $kisty_update->receive_data = $request->recieved_date;
        $kisty_update->memo_no = $request->memo_no;
        $kisty_update->bank = $request->bank;
        $kisty_update->brance = $request->brance;


        $kisty_update->pay_by =  Auth::user()->name;
        
        
      $due = $kisty_update->due+$request->due;

        if($kisty_update->amount == $due){

            $kisty_update->remarks = "Paid";
          
            $kisty_update->due = null;

        }else{

            if ($due > $kisty_update->amount) {


                return redirect()->route('contact.customer_profile', ['id' => $cus_id])
                ->with('message','Amount is too high, please change');

            }else{

               if ($kisty_update->remarks == "Paid") {
              
               } else {
                $kisty_update->due =  $kisty_update->due+$request->due;
               }
               
            }


        }
        
        
        $kisty_update->date = Carbon::now()->format("y-m-d");


        $kisty_update->save();

        $report = new report();

        $report->customer_id = $cus_id;
        $report->payment_id = $kisty_update->id;
        $report->installment = $kisty_update->installment;
        $report->description = $kisty_update->description;
        $report->cheque_ba_cash = $kisty_update->cheque_ba_cash;
        $report->cheque_date = $kisty_update->cheque_date;
        $report->receive_data = $kisty_update->receive_data;
        $report->memo_no = $kisty_update->memo_no;
        $report->bank = $kisty_update->bank;
        $report->date = $kisty_update->date;
       
        $report->amount = $request->due;

        $report->cumulative = $kisty_update->cumulative;
        $report->amount_due = $kisty_update->amount_due;
        $report->remarks = "Paid";
        $report->pay_by = Auth::user()->name;

        $report->save();

        $rivieved_no = report::find($report->id);

        $rivieved_no->recieved_no = "00" . $cus_id . $report->id;
        $rivieved_no->save();

        return redirect()->route('contact.customer_profile', ['id' => $cus_id]);
    }



/*Installments edit*/

public function edit_kisty(Request $request, $id){


    $cus_id = $request->cus_id;

    $data = payment::find($id);


    return view('backend.contact.kistiedit', compact('cus_id','data'), ['id' => $id]);


}


public function edit_kisty_store(Request $request, $id){



    $cus_id = $request->cus_id;

    $kisty_update = payment::find($id);


    

    if($kisty_update->amount < $request->due){


        return redirect()->route('contact.customer_profile', ['id' => $cus_id])->with('message','Amount is too high, please change');

    }else{



        
    if ($request->date) {

        $kisty_update->installment = $request->date;
    }
    $kisty_update->cheque_ba_cash = $request->cheque_no;
    $kisty_update->cheque_date = $request->cheque_date;
    $kisty_update->receive_data = $request->recieved_date;
    $kisty_update->memo_no = $request->memo_no;
    $kisty_update->bank = $request->bank;
    $kisty_update->brance = $request->brance;

    $due = $request->due;

    if ($kisty_update->amount == $due) {

        $kisty_update->due = null;
        $kisty_update->remarks = "Paid";

    } else {

        $kisty_update->due = $request->due;
        $kisty_update->remarks = null;
    }
    
    
    $kisty_update->save();
          
    return redirect()->route('contact.customer_profile', ['id' => $cus_id])->with('message',$kisty_update->description.' Updated!');



    }




}

    /*Invoice */
    public function invoice(Request $request, $id)
    {

        $cus_id = $request->cus_id;

        $customer = customer::with('book')->find($cus_id);

        $road = road::where('category_id', $customer->book->category_id)->where('id', $customer->book->road_id)->first();

        $Receipt_No = report::where('payment_id', $id)->first();

        $plot_info = plot::where('category_id', $customer->book->category_id)->where('road_id', $customer->book->road_id)->where('plot_num', $customer->book->plot_num)->first();

        $block_name = category::where('id', $customer->book->category_id)->first();

        $payment = payment::where('customer_id', $id)->get();

        $invoice = payment::where('id', $id)->first();

        return view('backend.contact.invoice', compact('road', 'Receipt_No', 'invoice', 'customer', 'plot_info', 'block_name', 'payment'));
    }




    public function invoice_view(Request $request,$id){
        
        $cus_id = $request->cus_id;

        $customer = customer::with('book')->find($cus_id);

        $Receipt_No = report::where('payment_id', $id)->first();

        $plot_info = plot::where('category_id', $customer->book->category_id)->where('road_id', $customer->book->road_id)->where('plot_num', $customer->book->plot_num)->first();

        $road = road::where('category_id', $customer->book->category_id)->where('id', $customer->book->road_id)->first();

        $block_name = category::where('id', $customer->book->category_id)->first();

        $payment = payment::where('customer_id', $id)->get();

        $invoice = payment::where('id', $id)->first();

        $image = category::first();
        
        
         if($invoice->due != null){
            $invoice_word = $this->numberToWord($invoice->due);
        }else{

            $invoice_word = $this->numberToWord($invoice->amount);
        }



 return view('backend.contact.pdf', compact('cus_id','invoice_word','road','image','Receipt_No', 'invoice', 'customer', 'plot_info', 'block_name', 'payment'),['id'=>$id]);



    }


    /*Invoice Generate*/
    public function invoice_genarate(Request $request)
    {

        $cus_id = $request->cus_id;

        $customer = customer::with('book')->find($cus_id);

        $Receipt_No = report::where('payment_id', $request->id)->first();

        $plot_info = plot::where('category_id', $customer->book->category_id)->where('road_id', $customer->book->road_id)->where('plot_num', $customer->book->plot_num)->first();

        $road = road::where('category_id', $customer->book->category_id)->where('id', $customer->book->road_id)->first();

        $block_name = category::where('id', $customer->book->category_id)->first();

        $payment = payment::where('customer_id', $request->id)->get();

        $invoice = payment::where('id', $request->id)->first();

        $image = category::first();
        
        
         if($invoice->due != null){
            $invoice_word = $this->numberToWord($invoice->due);
        }else{

            $invoice_word = $this->numberToWord($invoice->amount);
        }
        
        
        
        




        //         return view('backend.contact.pdf', compact('image','Receipt_No', 'invoice', 'customer', 'plot_info', 'block_name', 'payment'));

        // exit;

        $id = $request->id;


        $pdf = Pdf::loadView('backend.contact.pdf', [
            'id'=>$id,
            'cus_id' => $cus_id,
            'customer' => $customer,
            'cus_id' => $cus_id,
            'Receipt_No' => $Receipt_No,
            'plot_info' => $plot_info,
            'block_name' => $block_name,
            'payment' => $payment,
            'invoice' => $invoice,
            'image' => $image,
            'road'  => $road,
            'invoice_word' => $invoice_word,
        ]);

        return $pdf->download();
    }
    
    
    
    
      public function numberToWord($num = '')
    {
        $num    = ( string ) ( ( int ) $num );
        
        if( ( int ) ( $num ) && ctype_digit( $num ) )
        {
            $words  = array( );
             
            $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );
             
            $list1  = array('','one','two','three','four','five','six','seven',
                'eight','nine','ten','eleven','twelve','thirteen','fourteen',
                'fifteen','sixteen','seventeen','eighteen','nineteen');
             
            $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
                'seventy','eighty','ninety','hundred');
             
            $list3  = array('','thousand','million','billion','trillion',
                'quadrillion','quintillion','sextillion','septillion',
                'octillion','nonillion','decillion','undecillion',
                'duodecillion','tredecillion','quattuordecillion',
                'quindecillion','sexdecillion','septendecillion',
                'octodecillion','novemdecillion','vigintillion');
             
            $num_length = strlen( $num );
            $levels = ( int ) ( ( $num_length + 2 ) / 3 );
            $max_length = $levels * 3;
            $num    = substr( '00'.$num , -$max_length );
            $num_levels = str_split( $num , 3 );
             
            foreach( $num_levels as $num_part )
            {
                $levels--;
                $hundreds   = ( int ) ( $num_part / 100 );
                $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
                $tens       = ( int ) ( $num_part % 100 );
                $singles    = '';
                 
                if( $tens < 20 ) { $tens = ( $tens ? ' ' . $list1[$tens] . ' ' : '' ); } else { $tens = ( int ) ( $tens / 10 ); $tens = ' ' . $list2[$tens] . ' '; $singles = ( int ) ( $num_part % 10 ); $singles = ' ' . $list1[$singles] . ' '; } $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' ); } $commas = count( $words ); if( $commas > 1 )
            {
                $commas = $commas - 1;
            }
             
            $words  = implode( ', ' , $words );
             
            $words  = trim( str_replace( ' ,' , ',' , ucwords( $words ) )  , ', ' );
            if( $commas )
            {
                $words  = str_replace( ',' , ' and' , $words );
            }
             
            return $words;
        }
        else if( ! ( ( int ) $num ) )
        {
            return 'Zero';
        }
        return '';
    }



    /*paymet list pdf*/

    public function payment_list($id)
    {


        $customer = customer::with('book')->find($id);

        $plot_info = plot::where('category_id', $customer->book->category_id)->where('road_id', $customer->book->road_id)->where('plot_num', $customer->book->plot_num)->first();



        $block_name = category::where('id', $customer->book->category_id)->first();

        $road_info = road::where('category_id', $customer->book->category_id)->where('id', $customer->book->road_id)->first();

        $payment = payment::where('customer_id', $id)->get();

        // return view('backend.contact.pdfpaymentlist',['id'=>$id], compact('road_info','customer', 'block_name', 'plot_info', 'payment'), ['id' => $id]);


        $pdf = PDF::loadView('backend.contact.pdfpaymentlist', [
            'customer' => $customer,
            'plot_info' => $plot_info,
            'block_name' => $block_name,
            'road_info' => $road_info,
            'payment' => $payment,
            'id' => $id,
        ]);

        return $pdf->download('land.pdf');
    }



    /*profile download*/
    public function profile_pdf($id)
    {



        $customer = customer::with('book')->find($id);

        $plot_info = plot::where('category_id', $customer->book->category_id)->where('road_id', $customer->book->road_id)->where('plot_num', $customer->book->plot_num)->first();



        $block_name = category::where('id', $customer->book->category_id)->first();

        $road_info = road::where('category_id', $customer->book->category_id)->where('id', $customer->book->road_id)->first();

        $payment = payment::where('customer_id', $id)->get();


        $customer = customer::with('nomieenitoshair','book', 'shair', 'mominee')->where('id', $id)->first();

        // dd($road_info->road_num);

        $pdf = PDF::loadView('backend.contact.pdfprofile', [
            'customer' => $customer,'plot_info' => $plot_info,'block_name' => $block_name,
            'road_info' => $road_info,'payment' => $payment,
        ]);

        return $pdf->download('land_profile.pdf');
    }




    /*Report */

    public function report()
    {

        $all_pay = report::with('customer')->get();

        $report_date = report::select('date')->get();

        // $customer_name = customer::select('name','id')->get();

        return view('backend.contact.report', compact('all_pay', 'report_date'));
    }

    /*Report find*/
    public function report_find(Request $request)
    {


        $data = $request->data;

        $search_data = report::where('created_at', '>=', $data)->get();

        return response()->json($search_data);
    }


    /*find report with submit*/
    public function search_report(Request $request)
    {


        $from = $request->from;
        $to = $request->to;

        $fordue = $request->fordue;
        $forto = $request->forto;

        $forkisty = $request->forkisty;
        $tokisty = $request->tokisty;

        $forbooking = $request->forbooking;
        $tobooking = $request->tobooking;


        if ($fordue || $forto) {
            $alldue = payment::with('customer')->where('remarks', '=', null)
                ->where('description', '=', 'Down payment')->where('date', '>=', $fordue)
                ->where('date', '<=', $forto)->get();

            if ($alldue) {

              
                return view('backend.report.downmoney', compact('alldue'));
            }
        } elseif ($from || $to) {


            $data = report::with('customer')->where('date', '>=', $from)
                ->where('date', '<=', $to)->get();

            $all_pay = report::with('customer')->get();

            return view('backend.contact.report', compact('data', 'all_pay'));
        } elseif ($forkisty || $tokisty) {


            $allkisty = payment::with('customer')
                ->where('remarks', '=', null)
                ->where('description', '!=', 'Down payment')
                ->where('description', '!=', 'Booking Money')
                ->where('installment', '>=', $forkisty)
                ->where('installment', '<=', $tokisty)->get();

             

            return view('backend.report.dueinstallment', compact('allkisty'));
        }elseif($forbooking || $tobooking){

            $allbooking = payment::with('customer')->where('remarks', '=', 'Paid')
            ->where('description', '=', 'Booking Money')->where('date', '>=', $forbooking)
            ->where('date', '<=', $tobooking)->get();

        if ($allbooking) {
          
            return view('backend.report.bookingmoney', compact('allbooking'));
        }
        }
    }

}
