@extends('layouts.backendapp')


@section('content')


<div class="d-sm-flex justify-content-sm-center">
<div class="d-flex justify-content-center border rounded" style="font-size: 15px;">

    <div class="mt-2">
        <h1 style="font-size: 25px";><b>Customer Info:</b></h1>

    <div class="float-end">
        <a class="btn btn-primary" href="{{ route('contact.profile_pdf', $id) }}">Pdf Download</a>
    </div>
    <hr>

        <div class="row mt-5">
            <div class="col-lg-4 col-sm-12">
                <div class="d-flex gap-2 mt-4">
                    <span> <b>File No :</b></span>
                    <span>
                        {{ 'DC' . Carbon\Carbon::parse($customer->created_at)->format('Y-m-d') . '-' . $customer->id
                        }}</span>
                </div>
                <div class="d-flex gap-2">
                    <span> <b>Service :</b></span>
                    <span> {{ $customer->service }}</span>
                </div>
                <div class="d-flex gap-2">
                    <span> <b>Name :</b></span>
                    <span> {{ $customer->name }}</span>
                </div>
                <div class="d-flex gap-2">
                    <span><b>Email :</b></span>
                    <span> {{ $customer->email }}</span>
                </div>
                <div class="d-flex gap-2">
                    <span> <b>Date Of Birth :</b></span>
                    <span> {{ $customer->date_of_birth }}</span>
                </div>

                <div class="d-flex gap-2">
                    <span> <b>Mobile No :</b></span>
                    <span> {{ $customer->phone }}</span>
                </div>
                <div class="d-flex gap-2">
                    <span> <b>Phone Office :</b></span>
                    <span> {{ $customer->phone_office }}</span>
                </div>

                <div class="d-flex gap-2">
                    <span> <b>Father Name :</b></span>
                    <span> {{ $customer->father_name }}</span>
                </div>
                <div class="d-flex gap-2">
                    <span> <b>Mother Name :</b></span>
                    <span> {{ $customer->mother_name }}</span>
                </div>
            </div>

            <div class="col-lg-4 col-sm-12">
                <div class="d-flex gap-2 mt-4">
                    <span> <b>Nationallity :</b></span>
                    <span> {{ $customer->nationallity }}</span>
                </div>
                <div class="d-flex gap-2">
                    <span> <b>Nid No :</b></span>
                    <span> {{ $customer->nid_no }}</span>
                </div>
                <div class="d-flex gap-2">
                    <span> <b>Marriage :</b></span>
                    <span> {{ $customer->marriage }}</span>
                </div>
                <div class="d-flex gap-2">
                    <span> <b>Marriage Status :</b></span>
                    <span> {{ $customer->marriage_status }}</span>
                </div>
                <div class="d-flex gap-2">
                    <span> <b>Present Address :</b></span>
                    <span> {{ $customer->presend_address }}</span>
                </div>
                <div class="d-flex gap-2 text-nowrap">
                    <span> <b>Permanent Address :</b></span>
                    <span> {{ $customer->permanent_address }}</span>
                </div><br>
            </div>
            <div class="col-lg-4 col-sm-12 d-flex flex-column gap-5">
                <div class="d-flex gap-2">
                    <span> <b>Image :</b></span>
                    <span><img style="max-height: 100px;" src="{{ asset('storage/' . $customer->image) }}"
                            alt="image"></span>
                </div>
                <div>
                    <span> <b>Nid Image :</b></span>
                    <span><img style="max-height: 100px;" src="{{ asset('storage/' . $customer->nid_image) }}"
                            alt="image"></span>
                </div>
            </div>
        </div>
        <br><br>
        <hr>
        <div class="row">
            <div class="">
                <h1 style="font-size: 25px;"><b>Nominee</b></h1>

                <table class="table table-responsive">
                    <tr>
                        <th><b>Name</b></th>
                        <th><b>Relation</b></th>
                        <th><b>Phone</b></th>
                        <th><b>Alt.Phone</b></th>
                        <th><b>Address</b></th>

                    </tr>
                    @forelse ($customer->mominee as $s_nominee)
                    <tr>
                        <td>{{ $s_nominee->name }}</td>
                        <td>{{ $s_nominee->relation }}</td>
                        <td>{{ $s_nominee->phone }}</td>
                        <td>{{ $s_nominee->mobile }}</td>
                        <td>{{ $s_nominee->address }}</td>
                    </tr>
                    @empty
                    @endforelse
                </table>
            </div>
            <div class="">
                <h1 class="d-flex justify-content-center mt-5" style="font-size: 25px;"><b>All share Holders</b></h1>
                <table class="table table-responsive">

                    @forelse ($customer->shair as $key=> $s_share)
                </table>
                <table class="table table-responsive">
                    <tr>
                        <th><span style="font-size:25px;color:black;">Share No {{ ++$key }}</span></th>
                    </tr>
                </table>
                <table class="table table-responsive">
                    <tr>
                        <th><b>Image</b></th>
                        <th><b>Name</b></th>
                        <th><b>Mobile</b></th>
                    </tr>
                    <tr>
                        <td>
                            <span><img style="max-height: 100px;" src="{{ asset('storage/' . $s_share->nid_image) }}"
                                    alt="image"></span>
                        </td>
                        <td>{{ $s_share->name }}</td>
                        <td>{{ $s_share->phone }}</td>
                    </tr>
                </table>
                <table class="table table-responsive">
                    <tr>
                        <td>
                            @forelse ($customer->nomieenitoshair as $s_nominee)
                            @if ($s_share->id == $s_nominee->shair_id)
                            <div class="">
                                <h1 style="font-size: 25px;"><b>Nominee</b></h1>

                                <table class="table table-responsive">
                                    <tr>
                                        <th><b>Name</b></th>
                                        <th><b>Relation</b></th>
                                        <th><b>Phone</b></th>
                                        <th><b>Alt.Phone</b></th>
                                        <th><b>Address</b></th>

                                    </tr>

                                    <tr>
                                        <td>{{ $s_nominee->name }}</td>
                                        <td>{{ $s_nominee->relation }}</td>
                                        <td>{{ $s_nominee->phone }}</td>
                                        <td>{{ $s_nominee->mobile }}</td>
                                        <td>{{ $s_nominee->address }}</td>

                                    </tr>

                                </table>
                            </div>
                            @else
                            @endif

                            <br>
                            @empty
                            @endforelse
                        </td>
                    </tr>

                    @empty
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('customjs')
<script>
    $('.deletebtn').click(function () {

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