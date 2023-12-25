@extends('layouts.backendapp')

@section('content')

@section('content')
    @push('customjs')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @endpush


    <form action="{{ route('contact.search_report') }}" method="POST">
        @csrf
        @method('post')
        <div class="d-flex justify-content-end">
           <input type="date" name="from">
          <input type="date" name="to">
            <button class="btn btn-primary" type="submit">submit</button>
        </div>
    </form>
    <br>


    <div class="container">
        <div class="row">
                
          

                <table class="table-responsive mt-6 table-bordered">

                    <tr>
                      
                      
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>DownPayment</th>
                       


                    </tr>
                    @forelse ($alldue as $key=> $pay)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $pay->customer->name }}</td>
                            <td>{{ $pay->customer->phone }}</td>
                            <td>{{ $pay->amount }}</td>
                           

                        </tr>

                      
                    @empty
                    @endforelse
                </table>
          

             

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
