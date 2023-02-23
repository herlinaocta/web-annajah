@extends('layouts.Admin.layout')

@section('sidebar')
@include('layouts.Admin.sidebar')
@endsection

@section('content')
<!--begin::Post-->
<div class="content flex-row-fluid" id="kt_content">
    <!--begin::Index-->
    <div class="card card-page">
        <!--begin::Card body-->
        <div class="card-body">

            <form method="POST" action="{{ route('flash_sale.store') }}">
                @csrf

                <div class="col">
                    <div class="form-outline">
                        <label for="product_id" class="required form-label">Product</label>
                        <select class="form-control select" name="product_id" id="product_id">

                            <option value="" holder>Pilih Product</option>

                            @foreach($products as $ress)

                            <option value="{{ $ress->id }}" {{ old('product_id') == $ress->id ? 'selected' : '' }} >{{ $ress->nama }}</option>

                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="mb-3">
                  <label for="start_time" class="form-label">Start Time</label>
                  <input type="datetime-local" class="form-control" name="start_time" required>
                </div>
                <div class="mb-3">
                  <label for="end_time" class="form-label">End Time</label>
                  <input type="datetime-local" class="form-control" name="end_time" required>
                </div>
                <div class="mb-3">
                  <label for="discount" class="form-label">Discount</label>
                  <input type="number" class="form-control" name="discount" min="0" max="100" step="0.01" required>
                </div>
                <div class="mb-3">
                  <label for="stock" class="form-label">Stock</label>
                  <input type="number" class="form-control" name="stock" min="1" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>              
            
</div>
<!--end::Card body-->
</div>
<!--end::Index-->
</div>
<!--end::Post-->

@endsection