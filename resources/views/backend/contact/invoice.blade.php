@extends('layouts.backendapp')

@section('content')

<div class="container">
    <div style="font-size:30px;font-weight:bold;margin-bottom:10px;" class="d-flex justify-content-center mt-2">
        <h1>Dakhina Real Estate Ltd.</h1>
    </div>
    <div class="row" style="font-size: 20px;">
        <div class="col-lg-4">
            Receipt No : {{ $Receipt_No->id}}
        </div>
        <div class="col-lg-4">
            File No : {{ $customer->file_no}}
        </div>
        <div class="col-lg-4">
            Date  : {{ Carbon\carbon::parse($Receipt_No->created_at)->format('d m y') }}
        </div>
        <div class="col-lg-4">
            Name : {{ $customer->name}}
        </div>
        <div class="col-lg-4">
            Address : {{ $customer->presend_address}}
        </div>

        <div class="col-lg-4">
            Sum of Amount : {{ $invoice->cumulative}}
        </div>
        <div class="col-lg-4">
            Cash/Cheque/P.O/D.D/etc NO : {{ $invoice->cheque_ba_cash}}
        </div>
        <div class="col-lg-4">
            Date : {{ $customer->created_at}}
        </div>
        <div class="col-lg-4">
            Phone : {{ $customer->phone}}
        </div>
        <div class="col-lg-4">
            Plot No : {{ $customer->book->plot_num}}
        </div>
        <div class="col-lg-4">
            Road No : {{ $road->road_num }}
        </div>
        <div class="col-lg-4">
            Block Name : {{ $block_name->title}}
        </div>
        <div class="col-lg-4">
            SFT/Katha : {{ $plot_info->plot_size}}
        </div>
        <div class="col-lg-4">
            Faching : {{ "No" }}
        </div>
    

    </div>
</div>

@endsection 