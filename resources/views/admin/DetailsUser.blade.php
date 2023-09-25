<x-navbarAdmin>
</x-navbarAdmin>
<style>
    .partner-rating {
        text-align: center;
    }

    .partner-rating i {
        color: yellow;
    }

    .partner-rating i.fa {
        font-size: 20px;
    }

    .partner-rating h2 {
        font-size: 20px;
    }
</style>
<div class="content">
    <div class="
row">
          <div class="col-md-5">
            <div class="card card-user">
              <div class="image">
                <img src="../assets/img/damir-bosnjak.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="{{ asset('storage/'.$user->image)}}" alt="...">
                    <h5 class="title">{{$user->name}} {{$user->prenom}}</h5>
                  </a>
                  <p class="description">

                  </p>
                </div>
                <div class="partner-rating">
                    <h2>Review</h2>
    @if(isset($partnerRating)) 

        @for ($i = 1; $i <= 5; $i++)
            @if ($i <= $partnerRating)
                <i class="fa fa-star"></i>
            @else
                <i class="fa fa-star-o"></i>
            @endif
        @endfor
        @else
        @for ($i = 1; $i <= 5; $i++) 
                <i class="fa fa-star-o"></i>
                @endfor      
    @endif
</div>
              </div>
              <div class="card-footer">
                <hr>
                <div class="button-container">
                  <div class="row">
                    <div class="col-lg-3 col-md-6 col-6 ml-auto">
                      <h5>{{$annoncesCount}}<br><small>Annonces</small></h5>
                    </div>
                    <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                      <h5>{{$ReclamationCount}}<br><small>Complains</small></h5>
                    </div>
                    <div class="col-lg-3 mr-auto">
                      <h5>{{$demandeCount}}<br><small>Reservation</small></h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="col-md-7">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Profile</h5>
                </div>
                <div class="card-body">
                    <form>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" disabled="" placeholder="Company" value="{{$user->name}}">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" disabled="" placeholder="Username" value="{{$user->prenom}}">
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" disabled="" placeholder="Email" value="{{$user->email}}">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Phone number</label>
                        <input type="text" class="form-control" disabled="" placeholder="Phone Number" value="{{$user->telephone}}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                        @if($user['isBan'] == 1)
                            <form method="POST" action="{{ route('admin.unbanUser', $user->id) }}" id="unbanUserForm">
                                @csrf
                                <button type="button" class="btn btn-success btn-round" id="unbanUserBtn">Unban user</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.banUser', $user->id) }}" id="banUserForm">
                                @csrf
                                <button type="button" class="btn btn-danger btn-round" id="banUserBtn">Ban user</button>
                            </form>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul>
                <li><a href="https://www.creative-tim.com" target="_blank">Creative Tim</a></li>
                <li><a href="https://www.creative-tim.com/blog" target="_blank">Blog</a></li>
                <li><a href="https://www.creative-tim.com/license" target="_blank">Licenses</a></li>
              </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                © <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(document).ready(function() {
        $('#banUserBtn').click(function() {
            swal({
                title: "Are you sure?",
                text: "Do you want to ban this user?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, ban them!",
                closeOnConfirm: false
            }, function() {
                $('#banUserForm').submit();
            });
        });

        $('#unbanUserBtn').click(function() {
            swal({
                title: "Are you sure?",
                text: "Do you want to unban this user?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, unban them!",
closeOnConfirm: false
}, function() {
$('#unbanUserForm').submit();
});
});
});
</script>

</body>
</html>