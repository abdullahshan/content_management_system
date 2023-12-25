@extends('layouts.backendapp')


@section('content')

<div class="row">
    
    <div class="">
        <table class="table">
                <tr> 
                    <th>Sl No</th>
                    <th>File</th>
                    <th>Name</th>
                    <th>Mobaile</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>



           
                <tr>
                    <td>{{ $serfile->id }}</td>
                   <td>
                        {{ $serfile->file_no }}
                   </td>
                    <td>{{ $serfile->name }}</td>
                    <td>{{ $serfile->phone }}</td>
                    <td>{{ $serfile->email }}</td>
                    <td>
                        <div class="btn-group">
                          
                              
                        
                           @if ($serfile->f_pay == 'pay')
                           <a style="border-radius: 5px; margin-left:2%" href="{{ route('contact.customer_view', $serfile->id) }}" class="btn btn-primary btn-sm">View</a>
                           <a style="border-radius: 5px; margin-left:2%" href="{{ route('contact.customer_profile', $serfile->id) }}" class="btn btn-primary btn-sm">Profile</a>
                           @else
                           <a style="border-radius: 5px; margin-left:2%" href="{{ route('contact.customer_view', $serfile->id) }}" class="btn btn-primary btn-sm">View</a>
                           <a style="border-radius: 5px; margin-left:2%" href="{{ route('contact.customer_profile', $serfile->id) }}" class="btn btn-primary btn-sm">Profile</a>
                           <a style="border-radius: 5px; margin-left:2%" href="{{ route('contact.customer_payment', $serfile->id) }}" class="btn btn-primary btn-sm">First Payment</a>                    

                           @endif
                            


                       
            
                        </div>
                    </td>
                </tr>
             
        </table>
    </div>
</div>

@endsection