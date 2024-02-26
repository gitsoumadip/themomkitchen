@extends('layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('category', 'active')
@push('styles')
@endpush
@section('content')
    <div class="dashboard_mainsec">
        <!-- company Details -->
        <div class="companydetails_head">
            <h3 class="heading_title">
                Menus
            </h3>
            <div class="comdehead_right">
                {{-- <div class="search_box">
                <form action="">
                    <input type="search" name="" class="form-control" placeholder="Search">
                    <button class="search_btn">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div> --}}
                <a href="{{ route('admin.menu.add') }}" class="btn btn-primary">Add Menu </a>
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
                        <th scope="col"> Types</th>
                        <th scope="col"> Item</th>
                        {{-- <th scope="col">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($fetchMenu as $key => $data)
                        <tr>
                            {{-- @dd($data->toArray()) --}}
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>{{ $data->types->name }}</td>
                            <td>{{ $data->items->name }}</td>
                           
                            <td>
                                <div class="action_box">
                            <a href="{{route('admin.menu.edit',$data->type_id)}}" class="text-primary" ><i class="fa-regular fa-pen-to-square" aria-hidden="true"></i></a>
                            {{-- <a href="javascript:void(0)"  data-uuid="{{$category->uuid}}" data-table="categories" class="text-danger deleteData"><i class="fa-regular fa-trash-can" aria-hidden="true"></i></a> --}}
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
