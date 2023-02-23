@extends('layouts.Admin.layout')

@section('sidebar')
@include('layouts.Admin.sidebar')
@endsection


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
                    <!--begin::Head-->
                    <div class="d-flex flex-stack mb-10 mb-lg-15">
                        <!--begin::Label-->
                        <!--begin::Label-->
                        <div class="fw-bolder fs-3 text-gray-800 mb-8">Edit About Us</div>
                        <!--end::Label-->
                    </div>
                    <!--end::Head-->

                    
                    
                    <!--begin::Wrapper-->
                    <div class="mb-0">
                      <form action="{{ url('/admin-about/update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    
                        <div class="mb-10">
                            <label for="judul" class="required form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" id="judul" value="{{ $about->judul }}" placeholder="Judul Page">
                        </div>
                    
                        <div class="form-outline mb-4">
                            <label for="deskripsi" class="required form-label" >Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="8">{{ $about->deskripsi }}</textarea>
                        </div>
                    
                        <label for="deskripsi" class="required form-label" >Gambar</label>
                        <img src="{{$about->getImage()}}" style="max-height: 300px;"/>

                        <div class="file-drop-area">
                          <span class="choose-file-button" for="gambar">Choose files</span>
                          <span class="form-label" for="gambar">or drag and drop files here</span>
                          <input class="file-input" type="file" name="gambar" id="gambar" multiple>
                        </div>

                        <label for="deskripsi" class="required form-label" >Video</label>
                        <div class="file-drop-area">
                          <span class="choose-file-button" for="video">Choose files</span>
                          <span class="form-label" for="video">or drag and drop files here</span>
                          <input class="file-input" type="file" name="video" id="video" multiple>
                        </div>
                        <p></p>
                    <p></p>
                       <p></p>
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>



                    </form>
                    
                     
                     @if (session('success'))
                         <div class="alert alert-success">
                             {{ session('success') }}
                         </div>
                     @endif
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Index-->
</div>
<!--end::Post-->

@endsection