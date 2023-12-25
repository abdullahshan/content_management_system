@extends('layouts.backendapp')


@section('content')

@section('search')
<div class="search d-none d-sm-block">
    <form action="{{ route('file_serch') }}" method="post">
        @csrf
       
    <input type="text" name="name" class="search__input form-control border-transparent" placeholder="Search...">

    </form>
    <i data-feather="search" class="search__icon dark-text-gray-300"></i> 
</div>
@endsection

<div class="mt-5 d-flex justify-content-end">
<a class="btn btn-primary" href="{{ route('contact.customer_form') }}">Add Customer</a>

</div>

@if (isset($result))
<div class="row">
    
    <div class="">
        <table class="table">
                <tr>
                    <th>Sl No</th>
                    <th>Name</th>
                    <th>Mobaile</th>
                    <th>Email</th>
                    <th>Plot_Info</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
             
                <tr>
                    <td>{{ $result->id }}</td>
                    <td>{{ $result->name }}</td>
                    <td>{{ $result->phone }}</td>
                    <td>{{ $result->email }}</td>
                    <td>
                        {{ $result->category->title }}<br>
                       Road : {{ $result->road }}<br>
                      Plot : {{ $result->plot_num }}
                    </td>
                    <td>
                        <a style="border-radius: 5px;" href="" class="{{ $result->status == '0' ? "btn btn-warning" : "btn btn-danger" }}"> {{ $result->status == '0' ? "Comfirm" : "Cancle" }}</a>

                    </td>

                    <td>
                        <div class="btn-group">

                            <a style="border-radius: 5px; margin-left:2%" href="" class="btn btn-info btn-sm">Edit</a>
                            <a style="border-radius: 5px; margin-left:2%" href="" class="btn btn-danger btn-sm">Delete</a>
                    

                         <form action="" method="POST">
                            @csrf
                            @method('delete')
                        
                        </form>
            
                        </div>
                    </td>
                </tr>
              
        </table>
    </div>
</div>
@else
    
<div class="row">
    
    <div class="">

      <div class="mt-2 border rounded">
        @if (Session::has('message'))
        <span class="d-flex justify-content-center" style="padding:5px; font-size: 20px;color:black;background-color:rgb(190, 250, 190);">{{ Session::get('message') }}</span>
        @endif
      </div>
        <table class="table">
                <tr> 
                    <th>Sl No</th>
                    <th>File No</th>
                    <th>Project</th>
                    <th>Name</th>
                    <th>Mobaile</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>



               @forelse ($customers_info as $key => $customer) 
                <tr>
                    <td>{{ $customer->id }}</td>
                   <td>
                        {{ $customer->file_no }}
                   </td>
                   <td>{{ "Dakhinacity" }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>
                        <div class="btn-group">
                          
                              
                        
                           @if ($customer->f_pay == 'pay')
                           <a style="border-radius: 5px; margin-left:2%" href="{{ route('contact.customer_info_edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit Info</a>

                           <a style="border-radius: 5px; margin-left:2%" href="{{ route('contact.customer_view', $customer->id) }}" class="btn btn-info btn-sm">Profile</a>
                           <a style="border-radius: 5px; margin-left:2%" href="{{ route('contact.customer_profile', $customer->id) }}" class="btn btn-warning btn-sm">View Payment</a>
                           @else
                           <a style="border-radius: 5px; margin-left:2%" href="{{ route('contact.customer_info_edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit Info</a>


                           <a style="border-radius: 5px; margin-left:2%" href="{{ route('contact.customer_view', $customer->id) }}" class="btn btn-info btn-sm">Profile</a>
                           <a style="border-radius: 5px; margin-left:2%" href="{{ route('contact.customer_profile', $customer->id) }}" class="btn btn-warning btn-sm">View payment</a>
                           <a style="border-radius: 5px; margin-left:2%" href="{{ route('contact.customer_payment', $customer->id) }}" class="btn btn-primary btn-sm">First Payment</a>                    

                           @endif
                            


                         <form action="" method="POST">
                            @csrf
                            @method('delete')
                        
                        </form>
            
                        </div>
                    </td>
                </tr>
               @empty
                   <tr>
                    <td colspan="4" style="color:red; font-size:30px;">Data not found!</td>
                   </tr>
               @endforelse
        </table>
        
        <div class="d-flex justify-content-center mt-5" style="font-size:15px;">
             {!! $customers_info->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
        
    </div>
</div>
@endif



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







