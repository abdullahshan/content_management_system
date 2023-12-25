@extends('layouts.backendapp')


@section('content')

@section('search')
<div class="search d-none d-sm-block">
    <form action="{{ route('search') }}" method="post">
        @csrf
       
    <input type="text" name="name" class="search__input form-control border-transparent" placeholder="Search...">

    </form>
    <i data-feather="search" class="search__icon dark-text-gray-300"></i> 
</div>
@endsection
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
                        <td>0{{ $result->phone }}</td>
                        <td>{{ $result->email }}</td>
                        <td>
                            {{ $result->category->title }}<br>
                            Road : {{ $result->road }}<br>
                            Plot : {{ $result->plot_num }}
                        </td>
                        <td>
                            <a style="border-radius: 5px;" href=""
                                class="{{ $result->status == '0' ? 'btn btn-warning' : 'btn btn-danger' }}">
                                {{ $result->status == '0' ? 'Pandding' : 'Cancle' }}</a>

                        </td>

                        <td>
                            <div class="btn-group">

                                <a style="border-radius: 5px; margin-left:2%" href=""
                                    class="btn btn-info btn-sm">Edit</a>
                                <a style="border-radius: 5px; margin-left:2%" href=""
                                    class="btn btn-danger btn-sm">Delete</a>


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
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h1 style="font-size: 20px;">All Booking Info </h1>

                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Sl No</th>
                                <th>Project</th>
                                <th>Name</th>
                                <th>Mobaile</th>
                                <th>Email</th>
                                <th>Plot_Info</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>



                            @forelse ($getbooking_info as $key => $info)
                                <tr>
                                    <td>{{ $info->id }}</td>
                                    <td>{{ "Dakhinacity" }}</td>
                                    <td>{{ $info->name }}</td>
                                    <td>{{ $info->phone }}</td>
                                    <td>{{ $info->email }}</td>
                                    <td>
                                        {{ $info->category->title }}<br>
                                        Road : {{ $info->road->road_num }}<br>
                                        Plot : {{ $info->plot_num }}
                                    </td>
                                    <td>
                                        <a style="border-radius: 5px;" href="{{ route('cancle.home', $info->id) }}"
                                            class="{{ $info->status == '0' ? 'btn btn-warning' : 'btn btn-danger' }}">
                                            {{ $info->status == '0' ? 'Pandding' : 'Cancle' }}</a>

                                    </td>

                                    <td>
                                        <div class="btn-group">

                                            <a style="border-radius: 5px; margin-left:2%"
                                                href="{{ route('contact.edit', $info->id) }}"
                                                class="btn btn-info btn-sm">Update</a>
                                            <a style="border-radius: 5px; margin-left:2%"
                                                href="{{ route('hide', $info->id) }}"
                                                class="btn btn-primary btn-sm">Hide</a>
                                          


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
                    </div>
                </div>

            </div>
        </div>
    @endif


    <br><br>

    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h1 style="font-size: 20px;">Recycle Bin</h1>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Sl No</th>
                            <th>Name</th>
                            <th>Mobaile</th>
                            <th>Email</th>
                            <th>Plot_Info</th>
                            <th>Actions</th>
                        </tr>

                        @forelse ($booking_trash as $s_trash)
                            <tr>
                                <td>{{ $s_trash->id }}</td>
                                <td>{{ $s_trash->name }}</td>
                                <td>{{ $s_trash->phone }}</td>
                                <td>{{ $s_trash->email }}</td>
                                <td>Block : {{ $s_trash->category->title }}<br>
                                   Road :  {{ $s_trash->road->road_num }}<br>
                                   Plot : {{ $s_trash->plot_num }}
                                </td>
                                <td>


                                    <a class="btn btn-danger btn-sm deletebtn" href="#">Delete</a>

                                    <form action="{{ route('delete', $s_trash->id) }}" method="POST">
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
        $('.deletebtn').click(function() {

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
