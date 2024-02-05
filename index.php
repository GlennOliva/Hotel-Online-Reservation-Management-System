
      <?php
        include('components/header.php');
        include('connection/dbcon.php');
      ?>

      <?php
        include('components/sidebar.php');
      ?>




<?php
if(!isset($_SESSION['admin_id']))
{
    echo '<script>
                                    swal({
                                        title: "Error",
                                        text: "You must login first before you proceed!",
                                        icon: "error"
                                    }).then(function() {
                                        window.location = "admin_login.php";
                                    });
                                </script>';
                                exit;
}

?>
    

      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">DASHBOARD</p>
        </div>

        <?php
if(isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $sql = "SELECT COUNT(*) as total_rooms FROM tbl_room WHERE admin_id = $admin_id";
    
    // Assuming you are using mysqli for database operations
    $result = mysqli_query($conn, $sql);

    if($result) {
        $row = mysqli_fetch_assoc($result);
        $total_rooms = $row['total_rooms'];
    } else {
        // Handle the query error if needed
        $total_rooms = 0;
    }
}
?>

        <div class="main-cards">

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">Total Rooms</p>
              <span class="material-icons-outlined text-blue">hotel</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $total_rooms; ?></span>
          </div>

          <?php

    $admin_id = $_SESSION['admin_id'];
    $sql = "SELECT SUM(total_price) as total_sales FROM tbl_book WHERE status = 'Booked'";
    
    // Assuming you are using mysqli for database operations
    $result = mysqli_query($conn, $sql);

    if($result) {
        $row = mysqli_fetch_assoc($result);
        $total_sales = $row['total_sales'];
    } else {
        // Handle the query error if needed
        $total_sales = 0;
    }

?>

<div class="card">
    <div class="card-inner">
        <p class="text-primary">Total Sales </p>
        <span class="material-icons-outlined text-orange">money</span>
    </div>
    <span class="text-primary font-weight-bold">&#8369; <?php echo number_format($total_sales, 2);?></span>
</div>



          <?php

    $sql = "SELECT COUNT(*) as total_user FROM tbl_user";
    
    // Assuming you are using mysqli for database operations
    $result = mysqli_query($conn, $sql);

    if($result) {
        $row = mysqli_fetch_assoc($result);
        $total_user = $row['total_user'];
    } else {
        // Handle the query error if needed
        $total_user = 0;
    }

?>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">Total Users</p>
              <span class="material-icons-outlined text-green">group</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $total_user;?></span>
          </div>


          <?php
if(isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $sql = "SELECT COUNT(DISTINCT category) as total_categories FROM tbl_room WHERE admin_id = $admin_id";
    
    // Assuming you are using mysqli for database operations
    $result = mysqli_query($conn, $sql);

    if($result) {
        $row = mysqli_fetch_assoc($result);
        $total_categories = $row['total_categories'];
    } else {
        // Handle the query error if needed
        $total_categories = 0;
    }
}
?>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">Total Category Room</p>
              <span class="material-icons-outlined text-red">list_alt</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $total_categories; ?></span>
          </div>

        </div>

        <div class="charts">





<div class="charts">

<div class="charts-card" style="width: 140%;">
  <p class="chart-title">Top 5 Rooms Category</p>
  <div id="bar-chart"></div>
  <?php
// Assuming you have a database connection in $conn

$sql = "SELECT category, COUNT(*) as count FROM tbl_room GROUP BY category ORDER BY count DESC LIMIT 5";

$result = mysqli_query($conn, $sql);

$categories = [];
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row['category'];
    $data[] = $row['count'];
}

// Convert data to JSON format for use in JavaScript
$categories_json = json_encode($categories);
$data_json = json_encode($data);  // Remove the extra array
?>

<script>
    const barChartOptions = {
        series: [
            {
                data: <?php echo $data_json; ?>,
            },
        ],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: {
                show: false,
            },
        },
        colors: ['#246dec', '#cc3c43', '#367952', '#f5b74f', '#4f35a1'],
        plotOptions: {
            bar: {
                distributed: true,
                borderRadius: 6,
                horizontal: false,
                columnWidth: '35%',
            },
        },
        dataLabels: {
            enabled: true, // Set this to true to display data labels
            formatter: function (val) {
                return val; // You can customize the format here if needed
            },
            offsetY: -20, // Adjust the offset to position the labels correctly
        },
        legend: {
            show: false,
        },
        xaxis: {
            categories: <?php echo $categories_json; ?>,
        },
        yaxis: {
            title: {
                text: 'Count',
            },
        },
    };

    const barChart = new ApexCharts(
        document.querySelector('#bar-chart'),
        barChartOptions
    );
    barChart.render();
</script>

</div>





    
          </div>

          <?php
// Assuming you have a database connection in $conn

$sql = "SELECT 
            DATE_FORMAT(created_at, '%b') as month,
            SUM(total_price) as total_revenue
        FROM 
            tbl_book
        WHERE 
                 status = 'Booked'
        GROUP BY 
            MONTH(created_at)
        ORDER BY 
            MONTH(created_at)";

$result = mysqli_query($conn, $sql);

$months = [];
$revenues = [];

while ($row = mysqli_fetch_assoc($result)) {
    $months[] = $row['month'];
    $revenues[] = $row['total_revenue'];
}

// Convert data to JSON format for use in JavaScript
$months_json = json_encode($months);
$revenues_json = json_encode($revenues);
?>

<div class="charts-card">
    <p class="chart-title">Revenue Sales Per Month</p>
    <div id="area-chart"></div>

    <script>
        const areaChartOptions = {
            series: [
                {
                    name: 'Total Revenue',
                    data: <?php echo $revenues_json; ?>,
                },
            ],
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false,
                },
            },
            colors: ['#4f35a1'],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: 'smooth',
            },
            labels: <?php echo $months_json; ?>,
            markers: {
                size: 0,
            },
            yaxis: [
                {
                    title: {
                        text: 'Total Revenue',
                    },
                },
            ],
            tooltip: {
                shared: true,
                intersect: false,
            },
        };

        const areaChart = new ApexCharts(
            document.querySelector('#area-chart'),
            areaChartOptions
        );
        areaChart.render();
    </script>
</div>

        </div>
      </main>
      <!-- End Main -->


      <?php
        include('components/footer.php');
      ?>
   