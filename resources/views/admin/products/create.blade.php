@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">{{ __('Product Create') }}</div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('admin.products.index') }}" class="btn btn-info btn-sm text-white">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">{{ __('Product name') }}</label>
                                    <input type="text" class="form-control" placeholder="{{ __('Product name') }}" value="{{old('name')}}" required name="name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">{{ __('Price') }}</label>
                                    <input type="number" min="1" class="form-control" placeholder="{{ __('Price') }}" value="{{old('price')}}" required name="price">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">{{ __('Image') }}</label>
                                    <input type="file" class="form-control" name="image" >
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">{{ __('Status') }}</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1" @if(old('status') == 1) selected @endif>{{ __('Active') }}</option>
                                        <option value="0" @if(old('status') == 0) selected @endif>{{ __('Inactive') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-success">{{ __('Create') }}</button>
                                </div>
                            </div>
                        </form>  
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection