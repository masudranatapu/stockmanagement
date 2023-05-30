@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">{{ __('Dashboard') }}</div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('admin.stocks.create') }}" class="btn btn-success btn-sm text-white">{{ __('Add Stock') }}</a>
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
                                          <th scope="col">{{ __('Product name') }}</th>
                                          <th scope="col">{{ __('Qty') }}</th>
                                          <th scope="col">{{ __('Type') }}</th>
                                          <th scope="col">{{ __('Action') }}</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                            @if(isset($stock) && count($stock) >0 )
                                                @foreach($stock as $key => $s_value)
                                                <tr>
                                                    <td>{{ $key + 1}}</td>
                                                    <td>{{ $s_value->product->name ?? '' }}</td>
                                                    <td>
                                                        {{ $s_value->qty }}
                                                    </td>
                                                    <td>
                                                        @if($s_value->type == 1)
                                                            <span class="badge bg-success">In</span>
                                                        @else 
                                                            <span class="badge bg-info">Out</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.stocks.delete', $s_value->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this data!')">
                                                            {{ __('Delete') }}
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-danger text-center">
                                                        {{ __('No data')}}
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