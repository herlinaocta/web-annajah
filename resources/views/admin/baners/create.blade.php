@extends('layouts.Admin.layout')

@section('sidebar')
@include('layouts.Admin.sidebar')
@endsection

@section('title', 'Tambah Baner')

@section('content')

<!--begin::Post-->
<div class="content flex-row-fluid" id="kt_content">
    <!--begin::Index-->
    <div class="card card-page">
        <!--begin::Body-->
        <div class="card-body p-lg-20">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
                    <form action="{{ route('baner.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="d-flex flex-stack mb-10 mb-lg-15">
                            <!--begin::Label-->
                            <div class="fw-bolder fs-3 text-gray-800 mb-8">Add Banner</div>
                            <!--end::Label-->
                            <!--begin::Actions-->
                            <div class="my-1">
                                <a href="/baner" class="btn btn-sm btn-light me-2">Close</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            <!--end::Actions-->
                          </div>

                        <!-- 2 column grid layout with text inputs for the first and last names -->
                            <div class="row mb-4">
                                <div class="col">
                                <div class="form-outline">
                                    <label for="exampleFormControlInput1" class="required form-label">Link</label>
                                    <input type="text" class="form-control" name="link" id="link"  placeholder="*Ect - Dress ">
                                </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('gambar') ? ' has-error' : '' }}">
                                <label for="exampleFormControlInput1" class="required form-label">Banner</label>

                                <div class="col-md-6">
                                    <input id="gambar" type="file" class="form-control" name="gambar" required>

                                    @if ($errors->has('gambar'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('gambar') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            
                    </form>
                </div>
                
                </div>
                <!--end::Layout-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Index-->
    </div>
    <!--end::Post-->
</div>

@endsection
