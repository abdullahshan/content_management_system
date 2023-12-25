@extends('layouts.backendapp')


@section('content')

    <div class="row">
    
        <div class="">
            <table class="table">
                    <tr>
                        <th>Sl No</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>

               
                    <tr>
                        <td>{{ $plot_contact->id }}</td>
                        <td>{{ $plot_contact->name }}</td>
                        <td>{{ $plot_contact->phone }}</td>
                        <td>{{ $plot_contact->email }}</td>
                        <td>{{ $plot_contact->address }}</td>
                        <td>{{ $plot_contact->message }}</td>
                       
                        <td>
                            <div class="btn-group">

                                <a style="border-radius: 5px;" href="{{ url('http://127.0.0.1:8000/getbooking_info') }}" class="btn btn-primary btn-sm">Back</a>
                              
                              
                                <a style="border-radius: 5px; margin-left:2%" href="#" class="btn btn-danger btn-sm deletebtn">delete</a>
                              
                
                
                            </div>
                        </td>
                    </tr>
                
                      
            </table>
        </div>
    </div>

@endsection



@push('customjs')

    <script>
            
        $('.deletebtn').click(function(){

            Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    
        $(this).next('form').submit();

  }
})
        });

    </script>
    
@endpush







