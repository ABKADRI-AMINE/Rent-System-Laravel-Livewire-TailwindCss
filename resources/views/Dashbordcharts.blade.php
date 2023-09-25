<x-navbarAdmin>
    <!-- End Navbar -->
</x-navbarAdmin>

<style>
    <?php for($i=1;$i<15;$i++){?>
        #banUser<?php echo $i ;?>{ display:none;}
    .banUserDiv<?php echo $i ;?> {
        width: 120px;
        height: 40px;
        background: #333;
        border-radius: 50px;
        position: relative;
    }
    .banUserDiv<?php echo $i ;?>:before {
        content: 'Yes';
        position: absolute;
        top: 12px;
        left: 13px;
        height: 2px;
        color: #26ca28;
        font-size: 16px;
    }
    .banUserDiv<?php echo $i ;?>:after {
        content: 'No';
        position: absolute;
        top: 12px;
        left: 84px;
        height: 2px;
        color: #fff;
        font-size: 16px;
    }
    .banUserDiv<?php echo $i ;?> label {
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
    .banUserDiv<?php echo $i ;?> input[type=checkbox]:checked + label {
        left: 60px;
        background: #26ca28;
    }
    <?php }?>

    #myChart{
        width: 70%;
        max-width: 400px;
        /* Ajout d'une marge */
        margin: auto;
    }

    /* Modifier la couleur de fond du conteneur */
    .chart-container {
        background-color: #f9f9f9;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    /* Modifier la couleur de fond du graphique */
    .chart-container canvas {
        background-color: #ffffff;
        border-radius: 10px;
    }

    /* Modifier la couleur de fond des légendes */
    .chart-container .chart-legend li span {
        display: inline-block;
        height: 12px;
        width: 12px;
        margin-right: 10px;
        border-radius: 50%;
        background-color: #008080; /* couleur de votre choix */
    }

    h2 {
        font-weight: bold;
        font-style: italic;
        text-align: center; /* Ajout d'un alignement horizontal */
        margin-bottom: 20px;
        color: black; /* couleur de votre choix */
    }
</style>
<script>
    $(document).ready(function(){
        <?php for($i=1;$i<15;$i++){?>
        $('#successMsg<?php echo $i;?>').hide();
        $('#role<?php echo $i;?>').change(function(){
            var role_val<?php echo $i;?> = $('#role<?php echo $i;?>').val();
            var userId<?php echo $i;?> = $('#userId<?php echo $i;?>').val();
            $.ajax({
                type: 'get',
                data: 'userID='+userId<?php echo $i;?> + '&role_val=' + role_val<?php echo $i;?>,
                url: '<?php echo url('/admin/updateRole');?>',
                success: function(response){
                    console.log(response);
                    $('#successMsg<?php echo $i;?>').show();
                    $('#successMsg<?php echo $i;?>').html(response);
                }
            });
        });
        $('#banUser<?php echo $i;?>').click(function(){
            //alert('yes');
            if(document.getElementById('banUser<?php echo $i;?>').checked){
                alert('checked');
            }else{
                alert('uncheck');
            }
        });
        <?php }?>
    });
</script>
<div class="content">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="fa fa-users text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Clients</p>
                                @if( !empty($dataaaa[0]))
                                    <p class="card-title">{{ $dataaaa[0] }}</p>
                                @else
                                    <p class="card-title">0</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-history"></i>
                        Just been Updated
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-briefcase-24 text-danger"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Partenaires</p>
                                @if( !empty($dataaaa[1]))
                                    <p class="card-title">{{ $dataaaa[1] }}</p>
                                @else
                                    <p class="card-title">0</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-history"></i>
                        Just been Updated
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <span style="font-size: 40px;">😀</span>
                            </div>
                        </div>

                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Good reviews</p>
                                @if(!empty($datta[1]))
                                    <p class="card-title">{{ $datta[1] }}</p>
                                @else
                                    <p class="card-title">0</p>
                                @endif
                            </div>


                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-history"></i>
                        Just been Updated
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-danger">
                                <i class="nc-icon nc-simple-remove text-danger"></i>
                            </div>

                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Bad reviews</p>
                                @if(!empty($datta[0]))
                                    <p class="card-title">{{ $datta[0] }}</p>
                                @else
                                    <p class="card-title">0</p>
                                @endif
                            </div>


                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-history"></i>
                        Just been Updated
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="container-fluid" style="margin-top: 80px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="chart-container">
                    <h2>Number of requests per month</h2>
                    <canvas id="myChart2" ></canvas>
                </div>
                <div class="chart-container">
                    <h2>Number of ads per month</h2>
                    <canvas id="myChart"></canvas>
                </div>

                <div class="chart-container">
                    <h2>Number of ads per city</h2>
                    <canvas id="myChart3"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="../assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/demo/demo.js"></script>
<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
        demo.initChartsPages();
    });
</script>
</body>

</html>





<!-- Importation de Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- Script pour créer le graphique -->
<script>




    // Récupérer les données depuis le contrôleur
    var labels = {!! json_encode($labels) !!};
    var data = {!! json_encode($data) !!};

    // Vérifier si les données existent
    if (data.length > 0) {

        // Créer le graphique
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of requests per month',
                    data: data,
                    borderColor: '#00FF7F',
                    backgroundColor: ['#FF6347', '#6495ED', '#FFA500', '#32CD32', '#FF69B4', '#BA55D3', '#00FFFF'],
                    borderWidth: 1
                }]
            },
            options: {}
        });

    } else {

        // Afficher le message si aucune donnée n'est disponible
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Aucune donnée disponible'],
                datasets: [{
                    data: [1],
                    backgroundColor: ['#DCDCDC'],
                }]
            },
            options: {}
        });

    }



    // Récupérer les données depuis le contrôleur
    var labels = {!! json_encode($labelss) !!};
    var data = {!! json_encode($dataa) !!};

    // Vérifier si les données sont vides
    if (labels.length === 0 || data.length === 0) {
        // Afficher un message d'erreur
        var ctx = document.getElementById('myChart2').getContext('2d');
        ctx.textAlign = 'center';
        ctx.fillText('Aucune donnée disponible', ctx.canvas.width / 2, ctx.canvas.height / 2);
    } else {
        // Créer le graphique
        var ctx = document.getElementById('myChart2').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of requests per month',
                    data: data,
                    borderColor: '#00FF7F',
                    backgroundColor: '#FF6347',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }





    // Récupérer les données depuis le contrôleur
    var labels = {!! count($labelsss) ? json_encode($labelsss) : "[]" !!};
    var data = {!! count($dataaa) ? json_encode($dataaa) : "[]" !!};

    // Vérifier si les tableaux sont vides
    if (labels.length == 0 || data.length == 0) {
        // Afficher "Aucune donnée disponible"
        var ctx = document.getElementById('myChart3').getContext('2d');
        ctx.font = "15px Arial";
        ctx.fillText("Aucune donnée disponible", 50, 50);
    } else {
        // Créer le graphique
        var ctx = document.getElementById('myChart3').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of ads per city',
                    data: data,
                    borderColor: '#00FF7F',
                    backgroundColor: '#FF6347',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }


</script>
