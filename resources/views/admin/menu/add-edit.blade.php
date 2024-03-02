@extends('layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('category', 'active')
@section('content')
    <div class="dashboard_mainsec">
        <!-- company Details -->
        <div class="companydetails_head">
            <h3 class="heading_title">
                Menu
            </h3>
            <div class="backwardright">
                <a href="{{ route('admin.menu.list') }}"><i class="fa fa-backward"></i></a>
            </div>
        </div>
        <div class="company_profiles card-body">
            <form action="{{ route('admin.menu.add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="uuid" id="uuid" value="{{ $data->id ?? '' }}">
                <div class="row">
                    <div class="col-lg-12 col-md-12 ">
                        <div class="doctor-details-style clinicsheading_title">
                            Menu
                        </div>
                    </div>
                    <div class="col-md-4 adfilter-single">
                        <label for="name">Type</label>
                        <select class="form-control" name="type" id="type">
                            <option value="">---Select Type---</option>
                            {{ fetchType($data->id ?? '') }}
                        </select>
                        @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-8 adfilter-single">
                        <label for="itemId">Speciality Description</label>
                        <select name="itemId[]" id="itemId" multiple="multiple">
                            {!! isset($datas) && isset($datas->items) ? getItemOptions($datas->items->pluck('id')) : getItemOptions([]) !!}
                        </select>
                        @error('itemId')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('admin.category.list') }}"> <button type="button"
                                class="btn btn-cancle">Cancel</button></a>
                        <input type="submit" class="btn btn-book" value="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#itemId').multiselect({
                includeSelectAllOption: true,
            });
        });
    </script>
@endpush
