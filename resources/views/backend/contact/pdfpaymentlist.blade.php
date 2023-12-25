<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        .invoice {
            max-width: 100%;
            margin: 0 auto;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .invoice-header {
            text-align: center;
            background-color: #f0f0f0;
            padding: 10px;
        }

        .invoice-details {
            margin-top: 0px;
        }

        .invoice-details table {
            border-radius: 3px;
            width: 100%;
        }

        .invoice-details th,
        .invoice-details td {
            height: 18px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0px 0px 0px 20px;
            text-align: left;
        }

        .style th,
        .style td {
            border: 1px solid #ccc;
            border-radius: 3px;
            padding: 0px 0px 0px 2px;
            text-align: left;
        }

        .invoice-details th {
            background-color: #f0f0f0;
        }

        .invoice-footer {
            margin-bottom: 5px;
            text-align: center;
            font-size: 15px;
            color: rgb(0, 0, 0);
        }

        .copy {
            margin-bottom: 5px;
            text-align: center;
            font-size: 8px;
        }


        .invoice-header img {
            max-width: 100%;
        }

        hr {
            border: 1px solid #979797;
        }
    </style>
</head>

<body>
    <div class="invoice">
         <div class="invoice-header">
           <img src="{{ asset('images/logo1.jpeg') }}" alt=""> 
        </div>  
        <div class="invoice-footer">Payment List</div>
        <div class="invoice-details">
            <table>
                <tr>
                    <th>File No : </th>
                    <td>{{ $customer->file_no }}</td>
                    <th>Service No:</th>
                    <td> {{ $customer->service }} </td>
                </tr>
                <tr>
                    <th>Name :</th>
                    <td> {{ $customer->name }}</td>
                    <th>Phone: </th>
                    <td>{{ $customer->phone }}</td>
                </tr>
                <tr>
                    <th>Present Address :</th>
                    <td>{{ $customer->presend_address }}</td>
                    <th>Permanent Address:</th>
                    <td>{{ $customer->permanent_address }}</td>
                </tr>

                <tr>
                    <td colspan="4" style="border: none;">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <th>Number of Share: </th>
                    <td>{{ $customer->no_share }}</td>
                    <th>Block Name: </th>
                    <td>{{ $block_name->title }}</td>
                </tr>

                <tr>
                    <th>Road No :</th>
                    <td>{{ $road_info->road_num }}</td>
                    <th>Plot No : </th>
                    <td> {{ $customer->book->plot_num }}</td>
                </tr>
                <tr>
                    <th>Plot Size:</th>
                    <td>{{ $plot_info->plot_size }}</td>
                    <th>Faching:</th>
                    <td>{{ $plot_info->facing }}</td>
                </tr>

                <tr>
                    <th>Plot Price (Per Kata)</th>
                    <td>{{ $plot_info->per_plot_price }}</td>
                    <th>Total Price: </th>
                    <td>{{ $plot_info->plot_price }}</td>
                </tr>
                <tr>
                    <th>Utility (Per kata):</th>
                    <td>70,000</td>
                    <th>Total Utility: </th>
                    <td><?php echo $plot_info->plot_size * 70000?></td>
                </tr>
                
            </table>
        </div>
        <br><br>
        <div class="invoice-footer">Installment Details</div>
        <div class="invoice-details">
            <table class="style">
                <tr>
                    <th>Installment</th>
                    <th>Description</th>
                    <th>Check No</th>
                    <th>Bank</th>
                    <th>Branch</th>
                    <th>Receive Date</th>
                    <th>Payment</th>
                    <th>Total</th>
                    <th>Due</th>
                    <th>Received By</th>
                    <th>Remarks</th>
                </tr>

                <tr>
                    @forelse ($payment as $payment_s)
                <tr>
                    @if ($payment_s->installment == null )
                   <td> {{ " " }} </td>
                @else

                <td>{{ Carbon\carbon::parse($payment_s->installment)->format('M , y'); }}</td>
                    
                @endif
                    <td>{{ $payment_s->description }}</td>
                    <td>{{ $payment_s->cheque_ba_cash }}</td>
                    <td>{{ $payment_s->bank }}</td>
                    <td>{{ $payment_s->brance }}</td>
                    <td>{{ $payment_s->receive_data }}</td>
                    <td>{{ $payment_s->amount }}</td>
                    <td>{{ $payment_s->cumulative }}</td>
                    <td>{{ $payment_s->amount_due }}</td>
                    <td>{{ $payment_s->pay_by }}</td>
                    <td>{{ $payment_s->remarks }}</td>
                </tr>
            @empty
                @endforelse
                </tr>
            </table>
        </div>
        <div class="invoice-footer">
            <p>Thank you for your business!</p>
        </div>
        <hr>
        <div class="copy">
            <p>Developed By Shataj Soft: &nbsp;+880 1733919791</p>
        </div>
    </div>
</body>

</html>
