@extends('layouts.backendapp')

@section('content')
 
<style>
    .form-control {
        height: 22px;
    }
    .btn{
        height: 22px;
    }
</style>
<div class="card">
    <div class="card-header">
        <h1 style="font-size:20px;">All Booking paymnets</h1>
    <form action="{{ route('contact.search_report') }}" method="POST">
        @csrf
        @method('post')

        <div class="d-flex justify-content-center">
            <div class="d-flex justify-conten-evenly gap-4">
                <div class="d-flex justify-conten-evenly gap-3">
                    <label for="from" class="form-label">From</label>
                    <input class="form-control" type="date" name="forkisty" required>
                </div>

                <div class="d-flex justify-conten-evenly gap-3">
                    <label for="to" class="form-label">to</label>
                    <input class="form-control" type="date" name="tokisty" required>
                </div>
                <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;Search</button>
            </div>
        </div>
    </form>
</div>
    <div class="card-body">
            
        @if (isset($allkisty))
        <table class="table table-responsive">

            <tr>
                <th>Sl</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Installments</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Remarks</th>
            </tr>
            
            @forelse ($allkisty as $key=> $pay)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $pay->customer->name }}</td>
                    <td>{{ $pay->customer->phone }}</td>

                    <td>{{ Carbon\carbon::parse($pay->installment)->format('M , y'); }}</td>

                    <td>{{ $pay->description }}</td>
                    <td>{{ $pay->amount }}</td>
                    <td>{{ "Not Paid" }}</td>
                </tr>
            @empty
                
            @endforelse
            
            

        </table>
        
     
        
        @else
            
        <table class="table table-responsive">

            <tr>
                <th>Sl</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Installments</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Remarks</th>
            </tr>
            
            @forelse ($installments as $key=> $pay)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $pay->customer->name }}</td>
                    <td>{{ $pay->customer->phone }}</td>
                    <td>{{ $pay->installment }}</td>
                    <td>{{ $pay->description }}</td>
                    <td>{{ $pay->amount }}</td>
                    <td>{{ "Not Paid" }}</td>
                </tr>
            @empty
                
            @endforelse

        </table>
        <br>
        
                {!! $installments->withQueryString()->links('pagination::bootstrap-5') !!}    
        @endif
     
    </div>
</div>



@endsection