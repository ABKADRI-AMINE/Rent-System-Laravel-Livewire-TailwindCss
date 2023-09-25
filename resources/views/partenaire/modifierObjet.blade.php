<x-app-layout>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h5 class="class= mt-3 text-center font-weight-bold" style="color: #F15412; font-weight:bold; font-size: 28px;">Modifier Objet</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="/listeObject/{{$product->id}}">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" value="{{$product['title']}}">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description">{{$product['description']}}</textarea>
            </div>
            <div class="form-group">
              <label for="category">Category</label>
              <select class="form-control" id="category" name="category_id">
                @foreach ($categories as $category)
                  <option value="{{$category->id}}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{$category->name}}</option>
                @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</x-app-layout>
