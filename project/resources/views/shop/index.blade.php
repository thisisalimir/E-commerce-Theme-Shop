@extends('layouts.master')

@section('title')
  Shop
@stop
@section('content')
   <h2 class="title-page">Buy The Latest Projects From Coalition Technologies</h2>
   <hr>
    @foreach($products->chunk(3) as $productChunk)
    <div class="row">
       @foreach($productChunk as $product )
       <div class="col-sm-6 col-md-4">
         <div class="thumbnail">
           <img src="{{ $product->imagePath }}"
            alt="harry potter" class="img-responsive">
           <div class="caption">
             <h3>{{ $product->title }}</h3>
             <p class="descrioption">{{ $product->description }}</p>
             <p>
             <div class="clearfix">
               <div class="pull-left price">
                 {{ $product->price }}$
               </div>
               <a href="#" class="btn btn-success pull-right" role="button">Add To Cart</a></p>
             </div>
           </div>
         </div>
       </div>
       @endforeach
    </div>
    @endforeach
@stop
