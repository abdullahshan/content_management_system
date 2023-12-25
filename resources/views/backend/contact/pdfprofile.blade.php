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
            width: 100%;
        }

        .invoice-details th,
        .invoice-details td {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0px 0px 0px 20px;
            text-align: left;
        }

        .invoice-details th {
            background-color: #f0f0f0;
        }
        .invoice-details td {
            width: 30%;
        }

        .style th,
        .style td {
            border: 1px solid #ccc;
            border-radius: 3px;
            padding: 4px 0px 0px 2px;
            text-align: left;
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

        .profile {
            max-width: 100%;
            height: 120px;
            border: 1px solid rgb(38, 39, 39);
            border-radius: 3px;
        }
        th,td{
            height: 22px;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <div class="invoice-header">
          <img src="{{ asset('images/logo1.jpeg') }}" alt="">  
        </div>  
        <div class="invoice-footer">Plot Information</div>
        <div class="invoice-details">
            <table class="style">
                <tr>
                <tr style="align-items: center;">
                    <th>Project:&nbsp;<b>Dakhina City</b></th>                    
                    <th>Block:&nbsp;{{ $block_name->title }} </th>
                    <th>Road no:&nbsp;{{  $road_info->road_num }}</th>
                    <th>Plot No:&nbsp;{{ $customer->book->plot_num }} </th>
                    <th>Plot Size:&nbsp;{{ $plot_info->plot_size }}</th>
                    <th>Price:&nbsp;{{ $plot_info->plot_price }} </th>
                </tr>
            </table>
        <div class="invoice-footer">Customer Information</div>
        <div class="invoice-details">            
            <table class="size">
                <tr>
                    <th>File No : </th>
                    <td>{{ 'DC' . Carbon\Carbon::parse($customer->created_at)->format('Y-m-d') . '-' . $customer->id }}
                    </td>
                    <th style="border:none;background-color:white"></th>
                    <td rowspan="4" style="border: none">
                      <img class="profile" src="{{ asset('storage/'.$customer->image) }}"  
                            alt="img"> 
                    </td>
                </tr>
                <tr>
                    <th>Name: </th>
                    <td>{{ $customer->name }}</td>
                </tr>
                <tr>
                    <th>Rank:</th>
                    <td>{{ $customer->rank }}</td>
                </tr>                 
                
                <tr>
                    <th>Service/BDTSN: </th>
                    <td>{{ $customer->service }}</td>
                </tr>
                <tr>
                    <th>Mobile No : </th>
                    <td>{{ $customer->phone }}</td>
                </tr>
                <tr>
                    <th>Alt. Mobile No: </th>
                    <td>{{ $customer->phone_office }}</td>
                </tr>
                <tr>
                    <th>Email :</th>
                    <td>{{ $customer->email }}</td>
                    <th>Nid No :</th>
                    <td>{{ $customer->nid_no }}</td>
                </tr>
                <tr>
                    <th>Mailing Address :</th>
                    <td>{{ $customer->presend_address }}</td>
                    <th>Permanent Address :</th>
                    <td>{{ $customer->permanent_address }}</td>
                </tr>
                <tr>
                    <th>Father Name :</th>
                    <td>{{ $customer->father_name }}</td>
                    <th>Mother Name:</th>
                    <td> {{ $customer->mother_name }}</td>
                </tr>
                <tr>
                    <th>Nationallity :</th>
                    <td> {{ $customer->nationallity }}</td>
                    <th>Date Of Birth :</th>
                    <td>{{ $customer->date_of_birth }}</td>
                </tr>
                <tr>
                    <th>Marriage Status:</th>
                    <td>{{ $customer->marriage_status }}</td>
                    <th>Marriage Date :</th>
                    <td>{{ $customer->marriage }}</td>
                </tr>
            </table>
        </div>
        <hr>

        <div class="invoice-footer">Nominee</div>
        <div class="invoice-details">
            <table class="size">
                <tr>
                    <th><b>Name</b></th>
                    <th><b>Relation</b></th>
                    <th><b>Address</b></th>
                    <th><b>Phone</b></th>
                    <th><b>Mobile</b></th>
                </tr>
                @forelse ($customer->mominee as $s_nominee)
                    <tr>
                        <td>{{ $s_nominee->name }}</td>
                        <td>{{ $s_nominee->relation }}</td>
                        <td>{{ $s_nominee->address }}</td>
                        <td>{{ $s_nominee->phone }}</td>
                        <td>{{ $s_nominee->mobile }}</td>
                    </tr>
                @empty
                @endforelse
            </table>
        </div>
        <hr>
        <div class="invoice-details">
            <table class="style">
                <tr>
                @forelse ($customer->shair as $s_share)
                        <div class="invoice-footer">User Profile</div>
                        <div class="invoice-details">
                            <table class="size">
                                <tr>
                                    <th>Rank No : </th>
                                    <td>{{ $s_share->rank }}</td>
                                </tr>                                
                                <tr>
                                    <th>File No : </th>
                                    <td>{{ 'DC' . Carbon\Carbon::parse($customer->created_at)->format('Y-m-d') . '-' . $customer->id }}
                                    </td>
                                    <th style="border:none;background-color:white"></th>
                                    <td rowspan="4" style="border: none">
                                        <img class="profile" src="{{ asset('storage/'.$s_share->nid_image) }}"  
                                            alt="img"> 
                                    </td>
                                </tr>
                                <tr>
                                    <th>Name: </th>
                                    <td>{{ $s_share->name }}</td>
                                </tr>
                                <tr>
                                    <th>Rank:</th>
                                    <td>{{ $s_share->rank }}</td>
                                </tr>                 
                                
                                
                                <tr>
                                    <th>Service/BDTSN: </th>
                                    <td>{{ $customer->service }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile No : </th>
                                    <td>{{ $s_share->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Email :</th>
                                    <td>{{ $s_share->email }}</td>
                                    <th>Nid No :</th>
                                    <td>{{ $s_share->nid_number }}</td>
                                </tr>
                                <tr>
                                    <th>Present Address :</th>
                                    <td>{{ $s_share->address }}</td>
                                    <th>Mailing Address :</th>
                                    <td>{{ $s_share->permanent_address }}</td>
                                </tr>
                                <tr>
                                    <th>Father Name :</th>
                                    <td>{{ $s_share->father }}</td>
                                    <th>Mother Name:</th>
                                    <td> {{ $s_share->mother }}</td>
                                </tr>
                <tr>
                    <th>Nationallity :</th>
                    <td> {{ $s_share->nationallity }}</td>
                    <th>Date Of Birth :</th>
                    <td>{{ $s_share->barth_date }}</td>
                </tr>
                <tr>
                    <th>Marriage Status:</th>
                    <td>{{ $s_share->marriage_status }}</td>
                    <th>Marriage Date :</th>
                    <td>{{ $s_share->marriage_date }}</td>
                </tr>
                                
                                
                            </table>
                        </div>
                        <hr>

                        {{--  <td>{{ $s_share->name }}</td>
                        <td>{{ $s_share->phone }}</td>
                        <td>{{ $s_share->nid_number }}</td>
                        <td>{{ $s_share->address }}</td>  --}}
                    </tr>

                </table>
                <table>
                    <tr>
                        <td>
                            @forelse ($customer->nomieenitoshair as $s_nominee)
                                @if ($s_share->id == $s_nominee->shair_id)
                                <div class="invoice-footer">Nominee</div>
                                <div class="invoice-details">
                                    <table class="style">
                                        <tr>
                                            <th><b>Name</b></th>
                                            <th><b>Relation</b></th>
                                            <th><b>Address</b></th>
                                            <th><b>Phone</b></th>
                                            <th><b>Mobile</b></th>
                                        </tr>
                                       
                                            <tr>
                                                <td>{{ $s_nominee->name }}</td>
                                                <td>{{ $s_nominee->relation }}</td>
                                                <td>{{ $s_nominee->address }}</td>
                                                <td>{{ $s_nominee->phone }}</td>
                                                <td>{{ $s_nominee->mobile }}</td>
                                            </tr>
                                      
                                    </table>
                                </div>
                                @else
                                    
                                @endif
                            @empty
                                
                            @endforelse
                            
                        </td>
                    </tr>
                </table>
                <table>
                @empty
                @endforelse
                </tr>
            </table>
        </div>
        <br>
       
        <div class="copy">
            <p>Developed By Shataj Soft: &nbsp;+880 1733919791</p>
        </div>
    </div>
</body>
