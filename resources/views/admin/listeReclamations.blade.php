<x-navbarAdmin>
</x-navbarAdmin>
<div class="content">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-center font-weight-bold"> Reclamations</h4>
          </div>
          <div class="card-body">
    <table class="table align-middle mb-0 bg-white">
        <thead class="bg-light">
          <tr>
            <th>User</th>
            <th>Complaint Date</th>
            <th>Status</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
          @if (isset($reclamations))
          @foreach ($reclamations as $reclamation )
          <tr>
            <td>
              <div class="d-flex align-items-center">
                <img
                    src="{{ asset('storage/'.$reclamation->user->image) }}"
                    alt=""
                    style="width: 45px; height: 45px"
                    class="rounded-circle mr-2"
                    />
                <div class="ms-3">
                  <p class="fw-bold mb-1">{{ $reclamation->user->name}}</p>
                  <p class="text-muted mb-0">{{ $reclamation->user->email}}</p>
                </div>
              </div>
            </td>
            <td>
              <p class="fw-normal mb-1">{{date("Y-m-d", strtotime($reclamation->created_at)) }}</p>
              <p class="text-muted mb-0">il y a : {{ $ilya }}</p>
            </td>
            <td>
              @if ($reclamation->status == 1)
                  <span class="badge badge-success rounded-pill d-inline p-2">Treated</span>
              @else 
                  <span class="badge badge-warning rounded-pill d-inline p-2">untreated</span>
              @endif
            </td>
            <td>
              <a href="/gererReclamations/{{$reclamation->id}}">  
              <button type="button" class="btn btn-link btn-sm btn-rounded">
                    voir
                  </button>
              </a>
            </td>
          </tr>               
          @endforeach
          @else 
          <div class="alert alert-success" role="alert">There are no announcements yet</div>
          @endif
            
        </tbody>
      </table>
</div>
</div>
</div>
</div>