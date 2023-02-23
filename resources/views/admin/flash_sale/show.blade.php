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

                    <div class="container">
                        <h1>Flash Sale {{ $flashSale->id }}</h1>
                        <div class="card">
                            <div class="card-header">{{ $flashSale->product->nama }}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ asset('assets/produk/' . $flashSale->product->gambar) }}" alt="Product Image" width="200" height="248">
                                    </div>
                                    <div class="col-md-8">
                                        <p>Kode Produk: {{ $flashSale->product->kode_produk }}</p>
                                        <p>Kategori: {{ $flashSale->product->kategori }}</p>
                                        <p>Jenis Produk: {{ $flashSale->product->jenisproduk }}</p>
                                        <p>Deskripsi: {{ $flashSale->product->deskripsi }}</p>
                                        <p>Harga: {{ $flashSale->product->harga }}</p>
                                        <p>Stock: {{ $flashSale->product->stock }}</p>
                                        <p>Start Time: {{ $flashSale->start_time }}</p>
                                        <p>End Time: {{ $flashSale->end_time }}</p>
                                        <p>Discount: {{ $flashSale->discount }}</p>
                                        <p>Harga Discount: {{ $flashSale->harga_discount }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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