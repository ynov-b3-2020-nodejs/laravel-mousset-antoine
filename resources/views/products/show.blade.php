@extends('layouts.app')

@section('content')

    <div class="row" >
        <div class="col-lg-12 margin-tb" >
            <div class="pull-left">
                <h2> Show Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary col-lg-3 btn btn-default center-block"  href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row" style="margin-left: 550px">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $product->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong>
                {{ $product->detail }}
            </div>
        </div>
    </div>
@endsection
