<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Dashboard Admin
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#ef3b2d",
                        },
                    },
                },
            };
        </script>
  <script>

      $(document).ready(function() {
          $('#categories-table').DataTable();
      });
  </script>
  <script>
      $(document).ready(function() {
          $('.details-btn').click(function() {
              var annonce = $(this).data('id');


              $('.product-price span').text(annonce.sale_price + ' MAD');
              $('.product-description span').text(annonce.product.category.name);
              $('.product-description h1').text(annonce.product.title);
              $('.product-description p').text(annonce.product.description);
              $('.constructor').text(annonce.user.name + ' ' + annonce.user.prenom);
              $('.left-column img').attr('src', 'storage/' + annonce.product.image[0].imageName);
              $('.real').attr('action', "{{ route('admin.deleteAnnonce', ':id') }}".replace(':id', annonce
                  .id));
              if (annonce.annonce_particuliere) {
                  var disponibleDays = JSON.parse(annonce.annonce_particuliere.disponible_days);
                  var ul = $('.cable-choose ul');
                  ul.empty();
                  for (var i = 0; i < disponibleDays.length; i++) {
                      var li = $('<li></li>').text(disponibleDays[i]);
                      ul.append(li);
                  }
                  $('.cable-config').show();
              } else {
                  $('.cable-config').hide();
              }


              console.log(annonce);

              $('#table-parent').hide();
              $('#details-div').show();

              // fetch details via AJAX
              $.ajax({
                  url: '/details/' + id,
                  type: 'GET',
                  success: function(response) {
                      $('#details-content').html(response);
                  }
              });
          });

          $('.back-btn').click(function() {
              $('#details-div').hide();
              $('#table-parent').show();
          });
      });
      $(document).ready(function() {

          $('.color-choose input').on('click', function() {
              var headphonesColor = $(this).attr('data-image');

              $('.active').removeClass('active');
              $('.left-column img[data-image = ' + headphonesColor + ']').addClass('active');
              $(this).addClass('active');
          });

      });
  </script>
  <style>
      html,
      body {
          height: 100%;
          width: 100%;
          margin: 0;
          font-family: 'Roboto', sans-serif;
      }

      .container {
          max-width: 1200px;
          margin: 0 auto;
          padding: 15px;
          display: flex;
      }

      /* Columns */
      .left-column {
          width: 65%;
          position: relative;
      }

      .right-column {
          width: 35%;
          margin-top: 60px;
      }

      /* Left Column */
      .left-column img.active {
          position: absolute;
          left: 0;
          top: 0;
          opacity: 1;
          transition: all 0.3s ease;
      }

      /* .left-column img.active {
          opacity: 1;
      } */

      /* Product Description */
      .product-description {
          border-bottom: 1px solid #E1E8EE;
          margin-bottom: 20px;
      }

      .product-description span {
          font-size: 12px;
          color: #358ED7;
          letter-spacing: 1px;
          text-transform: uppercase;
          text-decoration: none;
      }

      .product-description h1 {
          font-weight: 300;
          font-size: 52px;
          color: #43484D;
          letter-spacing: -2px;
      }

      .product-description p {
          font-size: 16px;
          font-weight: 300;
          color: #86939E;
          line-height: 24px;
      }

      /* Product Color */
      .product-color {
          margin-bottom: 30px;
      }

      .color-choose div {
          display: inline-block;
      }

      .color-choose input[type=&amp;
      quot;
      radio&amp;
      quot;

      ] {
          display: none;
      }

      .color-choose input[type=&amp;
      quot;
      radio&amp;
      quot;

      ]+label span {
          display: inline-block;
          width: 40px;
          height: 40px;
          margin: -1px 4px 0 0;
          vertical-align: middle;
          cursor: pointer;
          border-radius: 50%;
      }

      .color-choose input[type=&amp;
      quot;
      radio&amp;
      quot;

      ]+label span {
          border: 2px solid #FFFFFF;
          box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
      }

      .color-choose input[type=&amp;
      quot;
      radio&amp;
      quot;

      ]#red+label span {
          background-color: #C91524;
      }

      .color-choose input[type=&amp;
      quot;
      radio&amp;
      quot;

      ]#blue+label span {
          background-color: #314780;
      }

      .color-choose input[type=&amp;
      quot;
      radio&amp;
      quot;

      ]#black+label span {
          background-color: #323232;
      }

      .color-choose input[type=&amp;
      quot;
      radio&amp;
      quot;

      ]:checked+label span {
          background-image: url(images/check-icn.svg);
          background-repeat: no-repeat;
          background-position: center;
      }

      /* Cable Configuration */
      .cable-choose {
          margin-bottom: 20px;
      }

      .cable-choose button {
          border: 2px solid #E1E8EE;
          border-radius: 6px;
          padding: 13px 20px;
          font-size: 14px;
          color: #5E6977;
          background-color: #fff;
          cursor: pointer;
          transition: all .5s;
      }

      .cable-choose button:hover,
      .cable-choose button:active,
      .cable-choose button:focus {
          border: 2px solid #86939E;
          outline: none;
      }

      .cable-config {
          border-bottom: 1px solid #E1E8EE;
          margin-bottom: 20px;
      }

      .cable-config a {
          color: #358ED7;
          text-decoration: none;
          font-size: 12px;
          position: relative;
          margin: 10px 0;
          display: inline-block;
      }

      .cable-config a:before {
          content: &amp;
          quot;
          ?&amp;
          quot;
          ;
          height: 15px;
          width: 15px;
          border-radius: 50%;
          border: 2px solid rgba(53, 142, 215, 0.5);
          display: inline-block;
          text-align: center;
          line-height: 16px;
          opacity: 0.5;
          margin-right: 5px;
      }

      /* Product Price */
      .product-price {
          display: flex;
          align-items: center;
      }

      .product-price span {
          font-size: 26px;
          font-weight: 300;
          color: #43474D;
          margin-right: 20px;
      }

      .cart-btn {
          display: inline-block;
          background-color: #7DC855;
          border-radius: 6px;
          font-size: 16px;
          color: #FFFFFF;
          text-decoration: none;
          padding: 12px 30px;
          transition: all .5s;
      }

      .cart-btn:hover {
          background-color: #64af3d;
      }

      * Responsive */ @media (max-width: 940px) {
          .container {
              flex-direction: column;
              margin-top: 60px;
          }

          .left-column,
          .right-column {
              width: 100%;
          }

          .left-column img {
              width: 300px;
              right: 0;
              top: -65px;
              left: initial;
          }
      }

      @media (max-width: 535px) {
          .left-column img {
              width: 220px;
              top: -85px;
          }
      }
  </style>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="../assets/img/logo-small.png">
          </div>
          <!-- <p>CT</p> -->
        </a>
        <a href="https://www.creative-tim.com" class="simple-text logo-normal">
          ADMIN

          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
            <li>
                <a href="{{route('admin.chart')}}">
                    <i class="nc-icon nc-bank"></i>
                    <p>Dashboard</p>
                </a>
            </li>
          <li id="usersList">
            <a href="{{route('admin.usersList')}}">
              <i class="nc-icon nc-single-02"></i>
              <p>Users</p>
            </a>
          </li>
          <li id="annonces">
            <a href="{{ route('admin.annonces') }}">
              <i class="nc-icon nc-paper"></i>
              <p>Announcement</p>
            </a>
          </li>

          <li id="reclammations">
            <a href="{{ route('admin.listeReclamations') }}">
              <i class="nc-icon nc-support-17"></i>
              <p>Complains</p>
            </a>
          </li>
          <li id="categories">
            <a href="{{ route('admin.categories') }}">
              <i class="nc-icon nc-layout-11"></i>
              <p>Categories</p>
            </a>
          </li>
          <li>
            <a href="{{ route('profile.edit') }}">
              <i class="nc-icon nc-button-power"></i>
            </a>
              <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a href="{{ route('logout') }}"
              onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
              </form>
               </li>

        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;">My Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link btn-magnify" href="javascript:;">
                  <i class="nc-icon nc-layout-11"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-bell-55"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="javascript:;">
                  <i class="nc-icon nc-settings-gear-65"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

<script>
  var navLinks = document.querySelectorAll(".nav li a");
    for (var i = 0; i < navLinks.length; i++) {
        navLinks[i].addEventListener("click", function() {
            var navLi = this.parentNode;
            var activeLi = document.querySelector(".nav li.active");
            if (activeLi) {
                activeLi.classList.remove("active");
            }
            navLi.classList.add("active");
        });
    }
</script>
