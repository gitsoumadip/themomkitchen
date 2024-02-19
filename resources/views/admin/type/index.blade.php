@extends('layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('category', 'active')
@push('styles')
@endpush
@section('content')
    <div class="dashboard_mainsec">
        <!-- company Details -->
        <div class="companydetails_head">
            <h3 class="heading_title">
                Type
            </h3>
            <div class="comdehead_right">

                <a href="{{ route('admin.type.add') }}" class="btn btn-primary">Add Types </a>
            </div>
        </div>
    </div>
    <!-- company details -->
    <div class="company_profiles card-body">
        <div class="table-responsive adminbio_table">
            <table class="table table-hover dataTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"> Image</th>
                        <th scope="col"> Type</th>
                        <th scope="col"> Name</th>
                        <th scope="col"> Description</th>
                        <th scope="col"> Price</th>
                        {{-- <th scope="col"> Status</th> --}}
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($fetchTypeList as $key => $data)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td><img src="{{ asset('uploads/' . $data->img) }}" alt="" width="100px" height="100px"></td>
                            <td>{{ $data->categorys->name }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->price }}</td>
                            {{-- <td>{{ $data->price }}</td> --}}
                           
                            <td>
                                <div class="action_box">
                                    <a href="{{ route('admin.category.edit', $data->id) }}" class="text-primary"><i
                                            class="fa-regular fa-pen-to-square" aria-hidden="true"></i></a>
                                    <a href="javascript:void(0)" data-uuid="{{ $data->id }}" data-table="categories"
                                        class="text-danger deleteData"><i class="fa-regular fa-trash-can"
                                            aria-hidden="true"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
@endpush
