@extends('layouts.backendapp')

@section('content')
    <link rel="stylesheet" href="{{ asset('backend/dist/css/style.css') }}" />


    <div class="row">

        <div style="font-size:30px;font-weight:bold;margin-bottom:10px;" class="col-lg-10 d-flex justify-content-center mt-2">

            <h1>Dakhina Real Estate Ltd.</h1>

        </div>
        <div class="mt-5 d-flex justify-content-end col-lg-2">

            <a class="btn btn-primary" href="{{ route('contact.payment_list', $id) }}">Pay List Pdf</a>

        </div>


    </div>
    <div class="row" style="font-size: 18px;">
        <div class="col-lg-4">
            <b>File No</b> : {{ $customer->file_no }}
        </div>
        <div class="col-lg-4">
            <b>Name :</b> {{ $customer->name }}
        </div>
        <div class="col-lg-4">
            <b>Phone :</b> {{ $customer->phone }}
        </div>
        <div class="col-lg-4">
            <b>Block Name :</b> {{ $block_name->title }}
        </div>
        <div class="col-lg-4">
            <b>Road No :</b> {{ $road_info->road_num }}
        </div>
        <div class="col-lg-4">
            <b> Plot No :</b> {{ $customer->book->plot_num }}
        </div>
        <div class="col-lg-4">
            <b>Faching :</b> {{ $plot_info->facing }}
        </div>
        <div class="col-lg-4">
            <b>Plot Size :</b> {{ $plot_info->plot_size }}
        </div>
        <div class="col-lg-4">
            <b>Total Price :</b> {{ $plot_info->plot_price }}
        </div>
        <div class="col-lg-4">
            <b>Plot Price :</b> {{ $plot_info->per_plot_price }}
        </div>
        <div class="col-lg-4">
            <b>Service No :</b> {{ $customer->service }}
        </div>

        <br>
        <br>

        <dir>
            @if (Session::has('message'))
                <span class="d-flex justify-content-center"
                    style="padding:7px;font-size: 30px;color:red;background-color:rgb(190, 250, 190);">{{ Session::get('message') }}</span>
            @endif
        </dir>
        <table class="table-bordered border-primary table-responsive"
            style="font-size:15px;border:2px solid; border-color: black">
            <tr>
                <th>Installment</th>
                <th>Description</th>
                <th>Cheque No / Cash</th>
                <th>Branch</th>
                <th>Bank</th>
                <th>Cheque Date</th>
                <th>Receive Date</th>
                <th>Amount</th>
                <th>Cumultative</th>
                <th>Amount Due</th>
                <th>Received By</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>

            <tr>
                @forelse ($payment as $payment_s)
            <tr style="text-align: center;">

                @if ($payment_s->installment == null )
                   <td> {{ " " }} </td>
                @else

                <td>{{ Carbon\carbon::parse($payment_s->installment)->format('M , y'); }}</td>
                    
                @endif

                <td>{{ $payment_s->description }}</td>
                <td>{{ $payment_s->cheque_ba_cash }}</td>
                <td>{{ $payment_s->brance }}</td>
                <td>{{ $payment_s->bank }}</td>
                <td>{{ $payment_s->cheque_date }}</td>
                <td>{{ $payment_s->receive_data }}</td>
              
                <td>
                    
                        
                   @if ($payment_s->due != null)
                   Total={{ $payment_s->amount }},<br>Paid={{$payment_s->due}},<br>Due={{ $payment_s->amount-$payment_s->due}},
                   @else
                   {{ $payment_s->amount }}
                   @endif
                   
                </td>
                <td>{{ $payment_s->cumulative }}</td>
                <td>{{ $payment_s->amount_due }}</td>
                <td>{{ $payment_s->pay_by }}</td>
                <td>{{ $payment_s->remarks }}</td>

                <td>

                    <div class="form-group d-flex m-1 p-1" style="position: relative">

                        @if ($payment_s->remarks == 'Paid')
                            @if (Auth::user()->hasRole('superadministrator'))
                                <form action="{{ route('contact.Kisty_amount', $payment_s->id) }}" method="POST">
                                    @method('post')
                                    @csrf
                                    <input type="text" value="{{ $id }}" name="cus_id" hidden>
                                    <button disabled type="submit" class="btn btn-primary">Payment</button>
                                </form>
                            @else
                                <form action="{{ route('contact.Kisty_amount', $payment_s->id) }}" method="POST">
                                    @method('post')
                                    @csrf
                                    <input type="text" value="{{ $id }}" name="cus_id" hidden>
                                    <button type="submit" disabled class="btn btn-primary">Payment</button>
                                </form>
                            @endif
                        @else
                            <form action="{{ route('contact.Kisty_amount', $payment_s->id) }}" method="POST">
                                @method('post')
                                @csrf
                                <input type="text" value="{{ $id }}" name="cus_id" hidden>
                                <button type="submit" class="btn btn-primary">Payment</button>
                            </form>
                        @endif


                        {{--  <form action="{{ route('contact.invoice', $payment_s->id) }}" method="POST">
                        @method('post')
                        @csrf
                        <input type="text" value="{{ $id }}" name="cus_id" hidden>
                       <button type="submit" class="btn btn-warning">view</button>
                       </form>
          --}}


                        @if ($payment_s->remarks == 'Paid'  || $payment_s->due != null)
                            <form action="{{ route('contact.invoice_view', $payment_s->id) }}" method="POST">
                                @method('post')
                                @csrf
                                <input type="text" value="{{ $id }}" name="cus_id" hidden>
                                <button type="submit" class="btn btn-warning">View</button>
                            </form>

                            

                    @if (Auth::user()->hasRole('superadministrator'))
                    <form action="{{ route('contact.edit_kisty', $payment_s->id) }}" method="POST">
                        @method('post')
                        @csrf
                        <input type="text" value="{{ $id }}" name="cus_id" hidden>
                       <button type="submit" class="btn btn-danger">edit</button>
                      
                    </form> 
                    @else
                    <form action="{{ route('contact.edit_kisty', $payment_s->id) }}" method="POST">
                        @method('post')
                        @csrf
                        <input type="text" value="{{ $id }}" name="cus_id" hidden>
                       <button disabled type="submit" class="btn btn-danger">edit</button>
                      
                    </form> 
                    @endif
                            
                        @else
                            <form action="{{ route('contact.invoice_view', $payment_s->id) }}" method="POST">
                                @method('post')
                                @csrf
                                <input type="text" value="{{ $id }}" name="cus_id" hidden>
                                <button type="submit" disabled class="btn btn-warning">View</button>
                            </form>

                            <form action="{{ route('contact.edit_kisty', $payment_s->id) }}" method="POST">
                                @method('post')
                                @csrf
                                <input type="text" value="{{ $id }}" name="cus_id" hidden>
                               <button type="submit" disabled class="btn btn-danger">edit</button>
                              
                            </form> 
                        @endif

                    </div>

                </td>
            </tr>
        @empty
            @endforelse
            

            </tr>
        </table>
        
        
    </div>
    </div>
@endsection
