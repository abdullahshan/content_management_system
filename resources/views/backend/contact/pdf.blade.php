<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
    }

    .invoice {
        max-width: 700px;
        margin: 0 auto;
        padding: 3px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .invoice-header {
        text-align: center;
        background-color: #f0f0f0;
        padding: 8px;
    }

    .invoice-details {
        margin-top: 0px;
    }

    .invoice-details table {
        width: 100%;
    }

    .invoice-details th,
    .invoice-details td {
        height: 18px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 0px 0px 0px 15px;
        text-align: left;
    }

    .invoice-details th {
        background-color: #f0f0f0;
    }

    .invoice-total {
        margin-top: 20px;
    }

    .invoice-total table {
        width: 20%;
        float: right;
    }

    .invoice-total th,
    .invoice-total td {
        padding: 0;
        text-align: left;
    }

    .invoice-footer {
        margin-bottom: 2px;
        text-align: center;
        font-size: 15px;
        color: rgb(0, 0, 0);
    }

    .invoice-header img {
        max-width: 100%;
    }

    hr {
        border: 1px solid #979797;
    }

    .copy {
        margin-bottom: 5px;
        text-align: center;
        font-size: 8px;
    }
    .STYLE{
        background-color:#9ef5a1;
        color:black;
    }
</style>

<body>
    <div class="invoice">
        <div class="invoice-header">
            {{--  <img src="{{ asset('images/logo1.jpeg') }}" alt="">  --}}
        </div>
        <div class="invoice-footer STYLE">Money Receipt- ( {{ $invoice->description }} )</>
        </div>
        <div class="invoice-details">
            <table>
                <tr>
                    <th>File No : </th>
                    <td>{{ $customer->file_no }}</td>
                    <th>Service No: </th>
                    <td>{{ $customer->service }}</td>
                </tr>
                <tr>
                    <th>Receipt No :</th>
                    <td> {{ $Receipt_No->id }}</td>
                    <th>Name :</th>
                    <td> {{ $customer->name }}</td>

                </tr>
                <tr>
                    <th>Phone: </th>
                    <td>{{ $customer->phone }}</td>                    
                    <th>Email :</th>
                    <td>{{ $customer->email }}</td>
                </tr>
                <tr>
                    <th>Address :</th>
                    <td>{{ $customer->presend_address }}</td>
                    <th>Date :</th>
                    <td>{{ Carbon\carbon::parse($Receipt_No->created_at)->format('d-m-y') }}</td>
                </tr>
                
                <tr>
                    <td colspan="4" style="border: none;">
                        <hr>
                    </td>
                </tr> 
                
                <tr>
                    <th>Block Name: </th>
                    <td>{{ $block_name->title }}</td>
                    <th>Road No :</th>
                    <td>{{ $road->road_num }}</td>
                </tr>
                
                <tr>
                    <th>Plot No : </th>
                    <td> {{ $customer->book->plot_num }}</td>
                    <th>Plot Size:</th>
                    <td>{{ $plot_info->plot_size }}</td>
                </tr>
                
                
                
                <tr>
                    <td colspan="4" style="border: none;">
                        <hr>
                    </td>
                </tr>
                
                <tr>
                    <th>Cash/Cheque/P.O/D.D/etc:</th>
                    <td> {{ $invoice->cheque_ba_cash }}</td>
                    <th>Payment Status</th>
                    <td>{{ $invoice->remarks }}</td>
                </tr>
                <tr>
                    <th>Bank:</th>
                    <td> {{ $invoice->bank }}</td>
                    <th>Branch</th>
                    <td>{{ $invoice->brance }}</td>
                </tr>
                <tr>
                    <th>Pay Date:</th>
                    <td> {{ $invoice->cheque_date }}</td>
                    <th>Against</th>
                    <td>{{ $invoice->description }}</td>
                </tr>
                
                <tr>
                    <td colspan="4" style="border: none;">
                        <hr>
                    </td>
                </tr>
                
                <tr style='font-size:15px;background-color: lightblue;'>
                    <th>Amount : </th>
                    
                      <th>@if ($invoice->due != null)
                        Total={{ number_format($invoice->amount, 2, '.', ','); }},Paid={{ number_format($invoice->due, 2, '.', ','); }},Due={{ number_format($invoice->amount-$invoice->due, 2, '.', ','); }}
                    @else
                    
                     Paid={{ number_format($invoice->amount, 2, '.', ','); }},Due={{ number_format($invoice->due, 2, '.', ',');}}
                       
                    @endif</th>
                    
                    
                    <th>Amount in word: </th>
                    <th style="font-size:12px;">{{$invoice_word}}</th>
                </tr>
                <tr>
                    <th>Receipt By</th>
                    <th>{{ $invoice->pay_by }}</th>
                </tr>

            </table>
        </div>
        
        <div class="invoice-header"style="background-color:white;">
          {{--  <img src="{{ asset('images/footer.png') }}" alt="">  --}}
        </div>
        
        <div class="copy">
            <p>Developed By Shataj Soft: &nbsp;+880 1733919791</p>
        </div>
    </div>

@if (request()->routeIs('contact.invoice_view')) 
        <form action="{{ route('contact.invoice_genarate', $cus_id) }}" method="POST">
            @method('post')
            @csrf
        
            <input type="text" value="{{ $id }}" name="id" hidden>
        
            <input type="text" value="{{ $cus_id }}" name="cus_id" hidden>
            <button type="submit" class="btn btn-warning">Invoice</button>
        </form> 
      
      @endif
</body>


</html>
