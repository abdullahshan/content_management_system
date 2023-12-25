@extends('layouts.backendapp')


@section('content')




    <div class="row">

        <div class="">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h1 style="font-size: 20px;">All Users </h1>

                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Sl No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>



                        @forelse ($users as $key => $info)
                            <tr>
                                <td>{{ $info->id }}</td>
                                <td>{{ $info->name }}</td>
                                <td>{{ $info->email }}</td>
                                <td>
                                    @if ($info->type == 'Admin')
                                        {{ 'superadministrator' }}
                                    @else
                                        {{ 'Editor' }}
                                    @endif
                                </td>

                                <td>
                                    <span class="{{ $info->van == '1' ? 'btn-primary border rounded' : 'btn-danger border rounded' }}">

                                        {{ $info->van == '0' ? 'Banned!' : 'Active' }}

                                    </span>
                                </td>


                                <td>
                                    <div class="btn-group">

                                        @if (Auth::user()->hasRole('superadministrator') || Auth::user()->type == 'Admin')
                                       
                                        <a href="{{ route('user_update', $info->id) }}" class="btn btn-info sm border rounded">Edit</a>
                                            
                                        @else

                                        <a href="" class="disabled btn btn-info sm border rounded">Edit</a>
                                            
                                        @endif

                                      &nbsp;
                                        

                                      
                                        @if (Auth::user()->hasRole('superadministrator'))
                                            @if ($info->type == 'Admin')
                                                <a class="border rounded btn btn-danger btn-sm disabled"
                                                    href="{{ route('user_van', $info->id) }}">
                                                    Admin
                                                </a>
                                            @else
                                                <a class="border rounded {{ $info->van == '1' ? 'btn btn-danger' : 'btn btn-primary' }} btn-sm"
                                                    href="{{ route('user_van', $info->id) }}">
                                                    {{ $info->van == '1' ? 'Forbidden' : 'Active' }}
                                                </a>
                                            @endif
                                        @else
                                
                                         @if ($info->type == 'Admin')
                                                <a class="border rounded btn btn-danger btn-sm disabled"
                                                href="{{ route('user_van', $info->id) }}">
                                                Admin
                                            </a>
                                            @else
                                                <a class="border rounded btn btn-danger btn-sm disabled"
                                                href="{{ route('user_van', $info->id) }}">
                                                Forbidden
                                            </a>
                                            @endif
                                           
                                        @endif

                                        &nbsp;
                                        

                                        @if (Auth::user()->hasRole('superadministrator'))
                                            @if ($info->type == 'Admin')
                                                <a class="border rounded btn btn-danger btn-sm disabled"
                                                    href="{{ route('user_delete', $info->id) }}">
                                                    Delete
                                                </a>
                                            @else
                                                <a class="border rounded btn btn-danger btn-sm"
                                                    href="{{ route('user_delete', $info->id) }}">
                                                    Delete
                                                </a>
                                            @endif
                                        @else
                                            <a class="border rounded btn btn-danger btn-sm disabled"
                                                href="{{ route('user_delete', $info->id) }}">
                                                Delete
                                            </a>
                                        @endif

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
