@extends('layouts.backendapp')

@section('content')


    <div class="container">
        <div class="row">
            
            @if (Session::has('message'))


<span class="d-flex justify-content-center" style="font-size: 20px;color:black;background-color:rgb(190, 250, 190);">{{ Session::get('message') }}</span>
@endif


            @if (isset($avilable_plots))
            <div class="card">
                <div class="card-header">
                    <h1 style="font-size: 20px;">Avilable Plots </h1>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                         <th>Sl No</th>
                         <th>Plot No</th>
                         <th>Action</th>
                         @forelse ($avilable_plots as $plot)

                        <tr>
                            <td>{{ $plot->id }}</td>
                            <td>{{ $plot->plot_num }}</td>
                            <td class="d-flex justify-content-center">

                                <form action="{{ route('category.edit_plot', $plot->id) }}" method="POST" enctype="multipart/form-data">
                                <input type="text" hidden name="road_id" value="{{ $id }}">
                                @csrf
                                @method('post')
                                <button type="submit" class="btn btn-primary">Edit</button>
                                </form>

                                &nbsp;
                               
                                <a style="border-radius: 5px;margin-left:2px;" href="#" class="btn btn-danger btn-sm deletebtn">Delete</a>

                                <form action="{{ route('category.delete_plot', $plot->id) }}" hidden method="POST">
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
            @else
            <div class="card">
                <div class="card-header">
                    <h1 style="font-size: 20px;">All Plots </h1>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                         <th>Sl No</th>
                         <th>Plot No</th>
                         <th>Action</th>
                         @forelse ($plots as $plot)

                        <tr>
                            <td>{{ $plot->id }}</td>
                            <td>{{ $plot->plot_num }}</td>
                            <td>
                                <a class="btn btn-danger" href="{{ route('category.delete_sell_plot', $plot->id) }}">Delete</a>
                            </td>
                        </tr>
                             
                         @empty
                             
                         @endforelse
                    </table>
                </div>
            </div>
            @endif


          
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