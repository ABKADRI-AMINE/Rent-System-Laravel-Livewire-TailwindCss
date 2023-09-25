<x-navbarAdmin>
</x-navbarAdmin>
<br><br><br><br><br><br>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<body>
    <div class="container" >
        <div class="row">
            
            <div class="col-md-8 col-md-offset-2">
                
                <h1>Ajouter un Categorie</h1>
                
                <form action="/addCategory" method="POST" enctype= "multipart/form-data"> 
                    @csrf            
                    <div class="form-group">
                        <label for="name">Categorie Name <span class="require">*</span></label>
                        <input type="text" class="form-control" name="name" value = "{{ old('name') }}"/>
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="customFile">Ajouter image</label>
                        <input type="file" class="form-control" id="customFile" name="image" value="{{ old('images') }} " />
                    </div>
                    @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <p><span class="require">*</span> - required fields</p>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Ajouter
                        </button>
                        <button class="btn btn-default">
                            Cancel
                        </button>
                    </div>                    
                </form>
            </div>
            
        </div>
    </div>
</body>
</html>