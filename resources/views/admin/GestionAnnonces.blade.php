<x-navbarAdmin>
    <!-- End Navbar -->
    <style>
        <?php for($i=1;$i<15;$i++){?> #banUser<?php echo $i; ?> {
            display: none
        }

        /* Basic Styling */

        .banUserDiv<?php echo $i; ?> {
            width: 120px;
            height: 40px;
            background: #333;
            border-radius: 50px;
            position: relative;
        }

        .banUserDiv<?php echo $i; ?>:before {
            content: 'Yes';
            position: absolute;
            top: 12px;
            left: 13px;
            height: 2px;
            color: #26ca28;
            font-size: 16px;
        }

        .banUserDiv<?php echo $i; ?>:after {
            content: 'No';
            position: absolute;
            top: 12px;
            left: 84px;
            height: 2px;
            color: #fff;
            font-size: 16px;
        }

        .banUserDiv<?php echo $i; ?> label {
            display: block;
            width: 52px;
            height: 22px;
            border-radius: 50px;
            transition: all .5s ease;
            cursor: pointer;
            position: absolute;
            top: 9px;
            z-index: 1;
            left: 12px;
            background: #ddd;
        }

        .banUserDiv<?php echo $i; ?> input[type=checkbox]:checked+label {
            left: 60px;
            background: #26ca28;
        }

        <?php }?>
    </style>

    <script>
        $(document).ready(function() {
            <?php for($i=1;$i<15;$i++){?>
            $('#successMsg<?php echo $i; ?>').hide();
            $('#role<?php echo $i; ?>').change(function() {
                var role_val<?php echo $i; ?> = $('#role<?php echo $i; ?>').val();
                var userId<?php echo $i; ?> = $('#userId<?php echo $i; ?>').val();
                $.ajax({
                    type: 'get',
                    data: 'userID=' + userId<?php echo $i; ?> + '&role_val=' +
                        role_val<?php echo $i; ?>,
                    url: '<?php echo url('/admin/updateRole'); ?>',
                    success: function(response) {
                        console.log(response);
                        $('#successMsg<?php echo $i; ?>').show();
                        $('#successMsg<?php echo $i; ?>').html(response);
                    }
                });
            });
            $('#banUser<?php echo $i; ?>').click(function() {
                //alert('yes');
                if (document.getElementById('banUser<?php echo $i; ?>').checked) {
                    alert('checked');
                } else {
                    alert('uncheck');
                }
            });
            <?php }?>
        });
    </script>
</x-navbarAdmin>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center font-weight-bold"> Annonces simples</h4>
                </div>
                <div class="card-body">
                    <div id="table-parent" class="table-responsive">
                        @if ($annonces->isEmpty())
                            <div class="alert alert-success" role="alert">There are no announcements yet</div>
                        @else
                            <table class="table">
                                <thead class="text-primary">
                                    <th>id</th>
                                    <th>owner</th>
                                    <th>title</th>
                                    <th>category name</th>
                                    <th>minimum day</th>
                                    <th>date debut</th>
                                    <th>date fin</th>
                                    <th>city</th>
                                    <th>price</th>
                                    <th>premium</th>
                                    <th>status</th>
                                    <th>date de creation</th>
                                    <th class='col-lg-3'>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($annonces as $annonce)
                                        <tr>
                                            <td>{{ $annonce->id }}</td>
                                            <td>{{ $annonce->user->name }} {{ $annonce->user->prenom }}</td>
                                            <td>{{ $annonce->product->title }}</td>
                                            <td>{{ $annonce->product->category->name }}</td>
                                            <td>{{ $annonce->minday }}</td>
                                            <td>{{ $annonce->from }}</td>
                                            <td>{{ $annonce->to }}</td>
                                            <td>{{ $annonce->city }}</td>
                                            <td>{{ $annonce->sale_price }} MAD</td>
                                            <td>{{ $annonce->premium }}</td>
                                            <td>{{ $annonce->stat }}</td>
                                            <td>{{ $annonce->created_at }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <button type="submit" class="btn btn-primary mr-2 details-btn"
                                                        data-id="{{ json_encode($annonce) }}">More Details</button>
                                                    <form action="{{ route('admin.deleteAnnonce', $annonce->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this announcement?')">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                    </div>
                    <div id="details-div" style="display: none;">
                        <main class="container">

                            <!-- Left Column / Headphones Image -->
                            <div class="left-column">
                                <img data-image="black" class="active" width="70%" height="100%" src=""
                                    alt="">
                            </div>
                            <!-- Right Column -->
                            <div class="right-column">

                                <!-- Product Description -->
                                
                                <div class="product-description">
                                    <span></span>
                                    <h1></h1>
                                    <p></p>
                                </div>
                                <div class="product-description">
                                    <h4>Owner:</h4>
                                    <p class="constructor"></p>
                                </div>

                                <!-- Product Configuration -->
                                <div class="product-configuration">

                                    <!-- Product Color -->
                                    <!-- Cable Configuration -->
                                    <div class="cable-config">
                                        <span>Diposnible days :</span>

                                        <div class="cable-choose">
                                            <ul>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Pricing -->
                                <div class="product-price">

                                    <span></span>
                                    <form action="" method="POST" class="real">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this announcement?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </main>
                        
                        <button type="button" class="btn btn-secondary mb-3 back-btn">&lt; Back to Table</button>
                        <div id="details-content"></div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>