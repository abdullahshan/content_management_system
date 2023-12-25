@extends('layouts.backendapp')


@section('content')
        <div class="row">

            <div class="">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h1 style="font-size: 20px;">All Booking Info <a class="btn btn-primary" href="{{ route('contact.apply') }}">New Apply</a> </h1>

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



                            @forelse ($getbooking_info as $key => $info)
                                <tr>
                                    <td>{{ $info->id }}</td>
                                    <td>{{ $info->name }}</td>
                                    <td>{{ $info->phone }}</td>
                                    <td>{{ $info->email }}</td>
                                    <td>
                                        {{ $info->category->title }}<br>
                                        Road : {{ $info->road->road_num }}<br>
                                        Plot : {{ $info->plot_num }}
                                    </td>
                                   

                                    <td>
                                        <div class="btn-group">

                                            <a style="border-radius: 5px; margin-left:2%"
                                                href="{{ route('contact.edit', $info->id) }}"
                                                class="btn btn-info btn-sm">Update</a>
                                            <a style="border-radius: 5px; margin-left:2%"
                                                href="{{ route('search_hide', $info->id) }}"
                                                class="btn btn-primary btn-sm">Hide</a>
                                    

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
