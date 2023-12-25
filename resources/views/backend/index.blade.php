
@extends('layouts.backendapp')
@section('content')

<style>
.card-box {
    max-width: 20%;
    height:130px;
    border: 1px solid #cfc9c9;
    margin: 24px;
    padding: 12px;
    color: black;
    text-align: center;
}
.pm{
    margin:7px 0 0 0; $report->amount = $kisty_update->last_due;
}

.card-box p{
    color:white;
    font-size: 20px;
    font-weight: bold;    
}

@media only screen and (max-width: 600px) {
.card-box p{
    color:white;
    font-size: 15px;
    font-weight: bold;    
}
}
    .card-box:hover{
        scale: 1.1;
        transition: 0.5s;
        cursor: pointer;
}

    .bg-1 {
        -webkit-box-shadow: 7px 7px 4px -1px rgba(130, 130, 130, 0.9);
        background-color: #007aff;
    }

    .bg-2 {
        -webkit-box-shadow: 7px 7px 4px -1px rgba(130, 130, 130, 0.9);
        background-color: #27a844;
    }

    .bg-3 {
        -webkit-box-shadow: 7px 7px 4px -1px rgba(130, 130, 130, 0.9);
        background-color: #4563dd;
    }

    .bg-4 {
        -webkit-box-shadow: 7px 7px 4px -1px rgba(130, 130, 130, 0.9);
        background-color: #ff6600;
    }

    .bg-5 {
        -webkit-box-shadow: 7px 7px 4px -1px rgba(130, 130, 130, 0.9);
        background-color: #fec107;
    }

    .bg-6 {
        -webkit-box-shadow: 7px 7px 4px -1px rgba(130, 130, 130, 0.9);
        background-color: #dc3546;
    }

    .bg-7 {
        -webkit-box-shadow: 7px 7px 4px -1px rgba(130, 130, 130, 0.9);
        background-color: #10c100;
    }

    .bg-8 {
        -webkit-box-shadow: 7px 7px 4px -1px rgba(130, 130, 130, 0.9);
        background-color: #c1006b;
    }

    .bg-9 {
        -webkit-box-shadow: 7px 7px 4px -1px rgba(130, 130, 130, 0.9);
        background-color: #9d00c1;
    }

    .bg-10 {
        -webkit-box-shadow: 7px 7px 4px -1px rgba(130, 130, 130, 0.9);
        background-color: #cb7623;
    }
    .bg-11 {
        -webkit-box-shadow: 7px 7px 4px -1px rgba(130, 130, 130, 0.9);
        background-color: #fe077c;
    }
    .bg-15 {
        -webkit-box-shadow: 7px 7px 4px -1px rgba(130, 130, 130, 0.9);
        background-color: #276b57;
    }
    


</style>
    <div class="row mt-5">
        
        <div class="col-lg-3 col-sm-6 col-md-4 mt-2 rounded-3 card-box bg-8"> <span>
            <p><i class="fa-solid fa-bangladeshi-taka-sign fa-2x pm"></i></p>
            <p class="fs-3 fw-bolder">Total Amount</p>
            <p class="fs-3 fw-bolder">{{ $total_amount }}</p>
            </span>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-4 mt-2 rounded-3 card-box bg-6" <span>
            <p><i class="fa-brands fa-amazon-pay fa-2x pm"></i></i></p>
            <p class="fs-3 fw-bolder">Paid Amount</p>
            <p class="fs-3 fw-bolder">{{ $amount }}</p>
            </span>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-4 mt-2 rounded-3 card-box bg-7" <span>
            <p><i class="fa-regular fa-money-bill-1 fa-2x pm"></i></p>
            <p class="fs-3 fw-bolder">Total Due</p>
            <p class="fs-3 fw-bolder">{{ $total_duw }}</p>
            </span>
        </div>

        <div class="col-lg-3 col-sm-6 col-md-4 mt-2 rounded-3 card-box bg-10"> <span>
            <p><i class="fa-regular fa-calendar-plus fa-2x pm"></i></i></p>
            <p class="fs-3 fw-bolder">Monthly Paid</p>
            <p class="fs-3 fw-bolder">{{ $amount_month }}</p>
            </span>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-4 mt-2 rounded-3 card-box bg-11"><span>
            <p><i class="fa-regular fa-calendar-days fa-2x pm"></i></p>
            <p class="fs-3 fw-bolder">Monthly Due</p>
            <p class="fs-3 fw-bold">{{ $mounthlydue }}</p>
            </span>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-4 mt-2 rounded-3 card-box bg-9"> <span>
            <p><i class="fa-solid fa-comments-dollar fa-2x pm"></i></p>
            <p class="fs-3 fw-bolder">Today Paid</p>
            <p class="fs-3 fw-bolder">{{ $today_amount }}</p>
            </span>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-4 mt-2 rounded-3 card-box bg-5"><span>
            <p><i class="fa-regular fa-calendar-days fa-2x pm"></i></p>
            <p class="fs-3 fw-bolder">Today Due</p>
            <p class="fs-3 fw-bold">{{ $todaydueamount }}</p>
            </span>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-4 mt-2 rounded-3 card-box bg-2">
            <span>
                <p><i class="fa-solid fa-file-invoice fa-2x pm"></i></p>
                <p class="fs-3 fw-bolder">Total Invoice</p>
                <p class="fs-3 fw-bolder">{{ $count_invoice }}</p>
            </span>
        </div>


        <div class="col-lg-3 col-sm-6 col-md-4 mt-2 rounded-3 card-box bg-1">
            <span>
                <p><i class="fa-solid fa-people-carry-box fa-2x pm"></i></p>
                <p class="fs-3 fw-bolder">Total Customer</p>
                <p class="fs-3 fw-bolder">{{ $count_customer }}</p>
            </span>
        </div>

        <div class="col-lg-3 col-sm-6 col-md-4 mt-2 rounded-3 card-box bg-3"> <span>
            <p><i class="fa-solid fa-user-tie fa-2x pm"></i></p>
            <p class="fs-3 fw-bolder">Admin </p>
            <p class="fs-3 fw-bold">{{ $total_admin }}</p>
            </span>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-4 mt-2 rounded-3 card-box bg-4"> <span>
            <p><i class="fa-solid fa-users fa-2x pm"></i></p>
            <p class="fs-3 fw-bolder">User </p>
            <p class="fs-3 fw-bold">{{ $count_user }}</p>
            </span>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-4 mt-2 rounded-3 card-box bg-15"> <span>
            <p><i class="fa-solid fa-sack-dollar fa-2x pm"></i></p>
            <!--<p class="fs-3 fw-bolder">Utility/Due/Paid </p>-->
            <!--<p class="fs-3 fw-bold">{{ $utility_total_amount }}/{{ $utility_amount }}/{{ $due_utility }}</p>-->
            <p class="fs-3 fw-bold">Paid Utility ={{ $utility_amount }} </p>
            <p class="fs-3 fw-bold"> Due Utility={{ $due_utility }}</p>            
            
            
            
            </span>
        </div>
    </div>
@endsection
