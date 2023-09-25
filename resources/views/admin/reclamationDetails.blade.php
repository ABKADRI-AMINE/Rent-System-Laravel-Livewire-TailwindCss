<x-navbarAdmin>
</x-navbarAdmin>
<div class="content">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-center font-weight-bolde"> Complaint from : {{ $reclamation->user->name }} {{ $reclamation->user->prenom }}</h4>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="card p-4 shadow-sm">
                  <form method="POST" action="{{ route('admin.storeRec', $reclamation->id) }}">
                    @csrf
                    <div class="mb-3">
                      <label for="subject" class="form-label">Subject:</label>
                      <input type="text" class="form-control rounded-0" id="subject" name="subject" value="{{ $reclamation->sujet }}" readonly>
                    </div>
                    <div class="mb-3">
                      <label for="message" class="form-label">Content:</label>
                      <textarea class="form-control rounded-0 pl-3" id="message" name="message" rows="5" readonly>{{ $reclamation->contenue }}</textarea>
                    </div>
                    <button type="button" class="btn btn-primary rounded-0" id="response-button" style="background-color: #FF9900; border-color: #FF9900;">Response</button>
                    <div id="response-container" class="mt-3 d-none">
                      <label for="response" class="form-label">Complaint Response:</label>
                      <textarea class="form-control rounded-0 pl-3" id="response" name="response" rows="5">{{ !empty($reclamation->reponse) ? $reclamation->reponse: '' }}</textarea>
                      <button type="submit" class="btn btn-primary mt-3" id="send-response-button" style="background-color: #FF9900; border-color: #FF9900;">Send Response</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>          
          </div>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Get the response button and response container elements
            var responseButton = document.getElementById('response-button');
            var responseContainer = document.getElementById('response-container');
            
            // Add a click event listener to the response button
            responseButton.addEventListener('click', function() {
              // Toggle the visibility of the response container
              responseContainer.classList.toggle('d-none');
            });

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
                window.location.href = '/gererReclamations';
            @endif
        </script>