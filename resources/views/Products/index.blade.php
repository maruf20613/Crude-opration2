@extends('Layouts.master')
@section('content')

    <div class="container">
        <div class="text-right"><!--We  need to create a button and link to the product/create page so that one click we can go to the create page -->
            <a href="/products/create" class="btn btn-dark mt-2">New Product</a>
            

           
        </div>
        <h1>Products</h1>

        <table class="table table-hover">
            <thead>
              <tr>
                <th>SI No.</th>
                <th>Name</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td><a href="/products/{{ $product->id }}/show" class="text-dark">{{$product->name}}</a></td>
                    <td>
                        <img src="products/{{$product->image}}" class="rounded-circle" width="50" height="50" />
                    </td>
                     <td>
                      <a href="products/{{ $product->id}}/edit" class="btn btn-dark btn-sm">Edit</a>
                      <a href="products/{{ $product->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
                      <a href="products/{{ $product->id}}/show" class="btn btn-primary btn-sm" >Show</a>
                     </td>
                </tr>
                @endforeach
              
            </tbody>
          </table>

          {{$products->links()}}
    </div>

    @endsection