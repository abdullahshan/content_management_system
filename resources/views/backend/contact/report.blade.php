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
    @push('customjs')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @endpush

    <div class="mt-3">
       <h1 style="font-size:20px;">All Invoice</h1>
        <form action="{{ route('contact.search_report') }}" method="POST">
        @csrf
        @method('post')
        <div class="d-flex justify-content-center">
            <div class="d-flex justify-conten-evenly gap-4">
                <div class="d-flex justify-conten-evenly gap-3">
                    <label for="from" class="form-label">From</label>
                    <input class="form-control" type="date" name="from" required>
                </div>

                <div class="d-flex justify-conten-evenly gap-3">
                    <label for="to" class="form-label">to</label>
                    <input class="form-control" type="date" name="to" required>
                </div>
                <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;Search</button>
            </div>
        </div>
    </form>
    </div>

    <div class="container">
        <div class="row">


            @if (isset($data))
                <table class="table-responsive mt-6 table-bordered">

                    <tr>
                        <th>Receipt no</th>
                        <th>Installment</th>
                        <th>Description</th>
                        <th>Bank</th>
                        <th>Cheque No/Cash</th>
                        <th>Receive_data</th>
                        <th>Amount</th>
                        <th>Received By</th>


                    </tr>
                    @forelse ($data as $pay)
                        <tr>
                            <td>{{ $pay->id }}</td>
                            <td>{{ $pay->installment }}</td>
                            <td>{{ $pay->description }}</td>
                            <td>{{ $pay->bank }}</td>
                            <td>{{ $pay->cheque_ba_cash }}</td>
                            <td>{{ $pay->receive_data }}</td>
                            <td>{{ $pay->amount }}</td>
                            <td> {{ $pay->pay_by }}</td>


                        </tr>

                        <tr style="color: rgb(131, 118, 118)">
                            <td>
                                <span style="font-size:30px;">&#10551;</span>
                            </td>

                            <td>
                                <img style="max-height: 50px;" src="{{ asset('storage/' . $pay->customer->image) }}"
                                    alt="">
                            </td>
                            <td>
                                <b> Name :</b> {{ $pay->customer->name }}
                            </td>
                            <td>
                                <b> Phone :</b> {{ $pay->customer->phone }}
                            </td>

                            <td>
                                <b>Address :</b> {{ $pay->customer->presend_address }}
                            </td>
                        </tr>

                    @empty
                    @endforelse
                </table>
            @else
                <table class="table-responsive mt-6 table-bordered">

                    <tr>
                        <th>Receipt no</th>
                        <th>Installment</th>
                        <th>Description</th>
                        <th>Bank</th>
                        <th>Cheque No/Cash</th>
                        <th>Receive_data</th>
                        <th>Amount</th>
                        <th>Received By</th>



                    </tr>
                    @forelse ($all_pay as $pay)
                        <tr>
                            <td>{{ $pay->id }}</td>
                            <td>{{ Carbon\carbon::parse($pay->installment)->format('M, Y') }}</td>
                            <td>{{ $pay->description }}</td>
                            <td>{{ $pay->bank }}</td>
                            <td>{{ $pay->cheque_ba_cash }}</td>
                            <td>{{ $pay->receive_data }}</td>
                            <td>{{ $pay->amount }}</td>
                            <td> {{ $pay->pay_by }}</td>



                        </tr>

                        <tr style="color: rgb(131, 118, 118)">
                            <td>
                                <span style="font-size:30px;">&#10551;</span>
                            </td>
                             <td>
                               <img style="max-height: 50px;" src="{{ asset('storage/' . $pay->customer->image) }}"
                                    alt="">
                            </td>
                            <td>
                                <b> Name :</b> {{ $pay->customer->name }}
                            </td>
                            <td>
                                <b> Phone :</b> {{ $pay->customer->phone }}
                            </td>


                        </tr>

                    @empty
                    @endforelse
                </table>
            @endif



        </div>


        <script>
            $(document).ready(function() {

                $('#data').change(function(e) {

                    let $data_value = $(this).val();

                    $.ajax({
                        type: 'post',
                        url: '/report_find',
                        dataType: 'json',
                        data: 'data=' + $data_value + '&_token={{ csrf_token() }}',
                        success: function(response) {

                            $data = response;

                            console.log($data);

                        }
                    });

                });
            });
        </script>

    </div>

@endsection
