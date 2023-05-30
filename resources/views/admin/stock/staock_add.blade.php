@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">{{ __('Add Stock') }}</div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('admin.stocks.index') }}" class="btn btn-success btn-sm text-white">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.stocks.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="">{{ __('Product') }}</label>
                                    <select name="product_id[]" class="form-control" required>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="">{{ __('Type') }}</label>
                                    <select name="type[]" class="form-control" required>
                                        <option value="1">In</option>
                                        <option value="0">Out</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="">{{ __('Qty') }}</label>
                                    <input type="number" name="qty[]" class="form-control" placeholder="{{ __('Qty')}}" required>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <button type="button" onclick="addMoreStock(this)" class="mt-4 btn btn-info">
                                        {{ __('Add More')}}
                                    </button>
                                </div>
                            </div>
                            <div class="more_add">
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-success btn-sm">{{__('Add Stock')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function addMoreStock() {

            $('.more_add').append(`
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="">{{ __('Product') }}</label>
                        <select name="product_id[]" class="form-control" required>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">{{ __('Type') }}</label>
                        <select name="type[]" class="form-control" required>
                            <option value="1">In</option>
                            <option value="0">Out</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">{{ __('Qty') }}</label>
                        <input type="number" name="qty[]" class="form-control" placeholder="Qty" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button type="button" id="remove_item" class="mt-4 btn btn-danger">
                            {{ __('Remove') }}
                        </button>
                    </div>
                </div>
            `);
        }

        $(document).on("click", "#remove_item", function() {
            $(this).parent().parent('div').remove();
        });
    </script>
@endpush