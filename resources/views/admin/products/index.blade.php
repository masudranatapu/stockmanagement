@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">{{ __('Product List') }}</div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('admin.products.create') }}" class="btn btn-success btn-sm">{{ __('Add Product') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                      <thead>
                                        <tr>
                                          <th scope="col">{{ __('SL') }}</th>
                                          <th scope="col">{{ __('Name') }}</th>
                                          <th scope="col">{{ __('Image') }}</th>
                                          <th scope="col">{{ __('Price') }}</th>
                                          <th scope="col">{{ __('Status') }}</th>
                                          <th scope="col">{{ __('Action') }}</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                            @if(isset($products) && count($products) >0 )
                                                @foreach($products as $key => $product)
                                                <tr>
                                                    <td>{{ $key + 1}}</td>
                                                    <td>{{$product->name}}</td>
                                                    <td>
                                                        <img src="{{asset($product->image)}}" width="80" height="80" alt="">
                                                    </td>
                                                    <td>{{ number_format($product->price, 2) }}</td>
                                                    <td>
                                                        @if($product->status == 1)
                                                            <span class="badge bg-success">{{ __('Active')}}</span>
                                                        @else 
                                                            <span class="badge bg-info">{{ __('Inactive')}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-info btn-sm">
                                                            {{ __('Edit') }}
                                                        </a>
                                                        <a href="{{ route('admin.products.delete', $product->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this data!')">
                                                            {{ __('Delete') }}
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6" class="text-danger text-center">
                                                        {{ __('No data') }}
                                                    </td>
                                                </tr>
                                            @endif
                                      </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>      
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection