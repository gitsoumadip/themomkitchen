@extends('layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('type', 'active')
@section('content')
    <div class="dashboard_mainsec">
        <!-- company Details -->
        <div class="companydetails_head">
            <h3 class="heading_title">
                Type
            </h3>
            <div class="backwardright">
                <a href="{{ route('admin.type.list') }}"><i class="fa fa-backward"></i></a>
            </div>
        </div>
        <div class="company_profiles card-body">
            <form action="{{ route('admin.type.add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="uuid" id="uuid" value="{{ $data->uuid ?? '' }}">
                <div class="row">
                    <div class="col-lg-12 col-md-12 ">
                        <div class="doctor-details-style clinicsheading_title">
                            Type
                        </div>
                    </div>
                    <div class="col-md-4 adfilter-single">
                        <label for="name">Category</label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value=""></option>
                            {{ getCategory('') }}
                        </select>
                        @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 adfilter-single">
                        <label for="name">Type Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Enter Type Name."
                            value="{{ old('description', $data->description ?? '') }}">
                        @error('description')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 adfilter-single">
                        <label for="name">Prices</label>
                        <input type="text" class="form-control" name="price" id="price"
                            placeholder="Enter Prices."
                            value="{{ old('price', $data->price ?? '') }}">
                        @error('price')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 adfilter-single">
                        <label for="name">Image</label>
                        <input type="file" class="form-control" name="img" id="img">
                        @error('img')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 adfilter-single">
                        <label for="name">Type Description</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Enter Speciality Description."
                            value="{{ old('description', $data->description ?? '') }}" cols="10" rows="3"></textarea>
                        @error('description')
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
@endpush