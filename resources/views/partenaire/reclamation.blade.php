<x-app-layout>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mt-3 text-center font-weight-bold" style="color: #F15412; font-weight:bold; font-size: 28px;">Complaints</div>
                <div class="card mt-4">
                    <div class="card-body">
                        <form method="POST" action="/" id="myForm">
                            @csrf
                        
                            <div class="form-group">
                                <label for="sujet">{{ __('Sujet') }}</label>
                                <input type="text" name="sujet" class="form-control @error('sujet') is-invalid @enderror" value="{{ old('sujet') }}">
                                @error('sujet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="form-group">
                                <label for="contenue">{{ __('Contenue') }}</label>
                                <textarea name="contenue" class="form-control @error('contenue') is-invalid @enderror">{{ old('contenue') }}</textarea>
                                @error('contenue')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="form-group mb-0">
                                <button type="button" class="btn btn-primary" id="submit-button" onclick="submitForm()">{{ __('Envoyer') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitForm() {
                    $.ajax({
                        type: 'POST',
                        url: '/',
                        data: $('#myForm').serialize(),
                        success: function(response) {
                            // Display success alert
                            Swal.fire({
                                title: 'Success!',
                                text: 'The Complaint sended successfully.',
                                icon: 'success'
                            }).then(function() {
                                window.location.href = '/'; // replace with the URL of the success page
                                });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // Display error alert
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred while submitting the form.',
                                icon: 'error'
                            });
                        }
                    });
                }
    </script> 
</x-app-layout>