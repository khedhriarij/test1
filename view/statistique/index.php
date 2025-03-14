<?php require_once "header_admin.php"; 
 require_once('../../controller/fonctions_new.php'); 
 require __DIR__ . '/../../configuration/config.php';
 $nombre_auteurs=nombre_auteurs();
 $nombre_evaluateurs=nombre_evaluateurs();
 $nombre_membres=nombre_membres();
 $nombre_admin=nombre_admin();

?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
<!-- Sidebar -->
<?php require_once "sidebar_admin.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once "topbar_admin.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">tableau de bord</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i>generer un rapport</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Nombres d'articles</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                            $nombre_article=nombre_articles();
                                            echo $nombre_article;
                                            ?> 

                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                nombres de categories</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                             $nombre_categorie=nombre_categories();
                                             echo $nombre_categorie;
                                            ?> 
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                nombres d'utilisateurs inscrits</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                              $nombre_utilisateur=nombre_utilisateurs();
                                              echo $nombre_utilisateur;
                                            ?> 
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                nombres de clubs</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?php
                                              $nombre_club=4;
                                              echo $nombre_club;
                                            ?> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Representation du nombre
                                         du nombre d'articles ,de commentaires , de categories , de clubs , et d'utilisateurs</h6>
                                 
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div id="chart_div" style="height:320px;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">utilisateurs selon leurs roles</h6>
                                   
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> admin
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> evaluateurs
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> auteurs
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-danger"></i> membres
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                 

                         

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php require_once "../statistique/footer_admin.php"; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Logout Modal-->

    <?php require_once "../statistique/mode_deconnexion.php"; ?>
   
    <?php require_once "../statistique/bootstrap_js.php"; ?>
    <!-- script pour la representation graphique du nombre d'articles,
      de commentaires , de categories , de clubs , et d'utilisateurs-->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Items', 'Nombre'],
          ['Articles',  <?php  echo $nombre_article; ?> ],
          ['categories',   <?php  echo $nombre_categorie; ?>],
          ['clubs',   <?php  echo $nombre_club; ?>],
          ['utilisateurs',   <?php  echo $nombre_utilisateur; ?>]
        ]);

        var options = {
          title : 'nombre :articles , categories , utilisateurs , clubs',
          vAxis: {title: 'nombre'},
          hAxis: {title: 'item'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>



<script type="text/javascript">
    // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["admin", "evaluateurs", "auteurs","membres"],
    datasets: [{
      data: [<?php echo $nombre_admin ; ?>,
      <?php echo $nombre_evaluateurs ; ?>,
      <?php echo $nombre_auteurs ; ?>,
      <?php echo $nombre_membres ; ?>
    ],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc','#e74a3b'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf','#7F05F9'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

</script>
</body>

</html>