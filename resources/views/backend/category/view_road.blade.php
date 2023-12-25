@extends('layouts.backendapp')

@section('content')


    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h1 style="font-size: 20px;">All Roads</h1>
                </div>
                
                 @if (Session::has('message'))

                <br>
                <span class="d-flex justify-content-center" style="font-size: 20px;color:black;background-color:rgb(190, 250, 190);">{{ Session::get('message') }}</span>
                @endif
                <div class="card-body">
                    <table class="table table-responsive">
                         <th>Sl No</th>
                         <th>Road No</th>
                         <th>Action</th>
                         @forelse ($roads as $road)

                        <tr>
                            <td>{{ $road->id }}</td>
                            <td>{{ $road->road_num }}</td>
                            <td>
                                
                                 <a class="btn btn-primary" href="{{ route('category.edit_road', $road->id) }}">Edit</a>
                                <a class="btn btn-primary" href="{{ route('category.get_plot', $road->id) }}">Sell plots</a>
                                <a class="btn btn-primary" href="{{ route('category.avilabele_plot', $road->id) }}">Available plots</a>
                                <a style="border-radius: 5px;margin-left:2px;" href="#" class="btn btn-danger btn-sm deletebtn">Delete</a>
                            
                                <form action="{{ route('category.delete_road', $road->id) }}" method="POST">
                                   @csrf
                                   @method('delete')
                               
                               </form>
                          
                            </td>
                        </tr>
                             
                         @empty
                             
                         @endforelse
                    </table>
                </div>
            </div>
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