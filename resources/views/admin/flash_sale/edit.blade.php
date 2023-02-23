@extends('layouts.Admin.layout')

@section('title', 'Edit Flash Sale')

@section('sidebar')
@include('layouts.Admin.sidebar')
@endsection



@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Edit Flash Sale
                    </div>
                    <div class="card-body">
                        <form action="{{ route('flash_sale.update', $flashSale->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" @if($product->id == $flashSale->product_id) selected @endif>{{ $product->nama }}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="start_time">Start Time</label>
                                <input type="datetime-local" name="start_time" id="start_time" class="form-control" value="{{ old('start_time') ?? $flashSale->start_time }}">
                                @error('start_time')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="end_time">End Time</label>
                                <input type="datetime-local" name="end_time" id="end_time" class="form-control" value="{{ old('end_time') ?? $flashSale->end_time }}">
                                @error('end_time')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="discount">Discount (%)</label>
                                <input type="number" name="discount" id="discount" class="form-control" value="{{ old('discount') ?? $flashSale->discount }}">
                                @error('discount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('flash-sale.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
