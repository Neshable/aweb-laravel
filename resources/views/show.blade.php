@extends ('master')

@section ('content')
  
    <div class="col-md-8">
    <h2>List of all products</h2>
    </div>
    <div class="col-md-4"> {{ $product->links() }} </div>

    <div class="col-md-12">
    <table class="table table-striped">
      <tr>
        <th>Product CODE</th>
        <th>Product Name</th>
        <th>EAN Code</th>
        <th>Level 3 Category</th> 
        <th>Level 2 Category</th>
        <th>Level 1 Category</th>
      </tr>
      @foreach ($product as $item)
      <tr>
        <td>{{$item->code}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->eon}}</td>
        <td>{{$item->categories[0]->name}}</td>
        <td>{{$item->categories[0]->parent->name}}</td>
        <td>{{$item->categories[0]->parent->parent->name}}</td>
      </tr>
      @endforeach
    </table>
    </div>
    {{ $product->links() }}
    

@endsection
