@extends('layouts.master')

{{-- Browser tab title --}}
@section('title', 'Dashboard')

<?php
$host = 'localhost';
$db = 'candy';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sql_products = 'SELECT name, quantity FROM products';
$result_products = $conn->query($sql_products);

$data = [['Product', 'Sales']];
if ($result_products->num_rows > 0) {
    while ($row = $result_products->fetch_assoc()) {
        $data[] = [$row['name'], (int) $row['quantity']];
    }
}

// ORDER COUNT
$sql_orders = 'SELECT COUNT(*) as order_count FROM orders';
$result_orders = $conn->query($sql_orders);
$order_count = 0;

if ($result_orders->num_rows > 0) {
    $row = $result_orders->fetch_assoc();
    $order_count = $row['order_count'];
}

// EXPENDITURE COUNT
$sql_sum = 'SELECT SUM(paid_amount) as total_paid FROM orders';
$result_sum = $conn->query($sql_sum);
$total_paid = 0;

if ($result_sum->num_rows > 0) {
    $row = $result_sum->fetch_assoc();
    $total_paid = $row['total_paid'];
}

// STOCK ORDERED COUNT
$sql_total_amount = 'SELECT SUM(total_amount) as total_amount_sum FROM orders';
$result_total_amount = $conn->query($sql_total_amount);
$total_amount_sum = 0;

if ($result_total_amount->num_rows > 0) {
    $row = $result_total_amount->fetch_assoc();
    $total_amount_sum = $row['total_amount_sum'];
}

// ORDERS GRAPH RECORD
$sql = 'SELECT delivery_date, paid_amount FROM orders ORDER BY delivery_date';
$result = $conn->query($sql);

$data = [['Delivery Date', 'Paid Amount']];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [$row['delivery_date'], (float) $row['paid_amount']];
    }
} else {
    $data[] = [null, 0];
}

$chart_data = json_encode($data);
//$conn->close();
?>

@section('content')
    <section class="section">

        {{-- Page title --}}
        <h1 id="dashboard-heading">Dashboard</h1>
        <div class="row">

            {{-- Order statistics box --}}
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title">Order Statistics</div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">1</div>
                                <div class="card-stats-item-label">Pending</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">3</div>
                                <div class="card-stats-item-label">Shipping</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">1</div>
                                <div class="card-stats-item-label">Completed</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h2 class="dashboard-text">Total Orders</h2>
                        </div>
                        <div class="card-body">
                            <?php echo $order_count; ?>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Expenditure box --}}
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="balance-chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h2 class="dashboard-text">Total Expenditure</h2>
                        </div>
                        <div class="card-body">
                            $<?php echo number_format($total_paid, 2); ?>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stock ordered box --}}
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="sales-chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h2 class="dashboard-text">Stock Ordered</h2>
                        </div>
                        <div class="card-body">
                            <?php echo number_format($total_amount_sum, 0); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <html>

                        {{-- Sales record graph --}}

                        <head>
                            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                            <script type="text/javascript">
                                google.charts.load('current', {
                                    packages: ['corechart']
                                });
                                google.charts.setOnLoadCallback(drawChart);

                                function drawChart() {
                                    // Parse the data passed from PHP.
                                    var rawData = <?php echo $chart_data; ?>;

                                    // Check if there's any meaningful data besides the header row.
                                    if (rawData.length <= 1 || rawData[1][0] === null) {
                                        document.getElementById('curve_chart').innerHTML =
                                            '<p>No data available to display yet. Please input Orders in order to track Sales Records.</p>';
                                        return;
                                    }

                                    // Prepare the data for the chart.
                                    var data = google.visualization.arrayToDataTable(rawData);

                                    var options = {
                                        title: 'Orders',
                                        titleTextStyle: {
                                            fontSize: 18,
                                            fontName: 'Arial'
                                        },
                                        curveType: 'function',
                                        legend: {
                                            position: 'bottom'
                                        },
                                        chartArea: {
                                            left: 50,
                                            top: 50,
                                            right: 20,
                                            bottom: 50,
                                            width: '80%',
                                            height: '70%'
                                        },
                                        hAxis: {
                                            title: 'Date',
                                            titleTextStyle: {
                                                italic: false
                                            },
                                            format: 'yyyy-MM-dd'
                                        },
                                        vAxis: {
                                            title: 'Amount of Stock Ordered',
                                            titleTextStyle: {
                                                italic: false
                                            }
                                        }
                                    };

                                    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                                    chart.draw(data, options);
                                }
                            </script>
                        </head>

                        <body>
                            <div class="chart-container">
                                <div id="curve_chart" style="width: 800px; height: 450px"></div>
                            </div>
                        </body>

                        </html>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card gradient-bottom">
                    <div class="card-header">
                        <h2 class="card-stats-title">Employee Count</h2>
                    </div>
                    <div class="card-body" id="top-5-scroll">
                        <ul class="list-unstyled list-unstyled-border">
                            <li class="media">
                                <div id="bar_chart" style="width: 800px; height: 400px;">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <html>

                        <head>
                            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        </head>

                        <body>
                            <div class="chart-container">
                                <div id="piechart" style="width: 900px; height: 400px;"></div>
                            </div>
                        </body>

                        </html>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-stats-title">Top Countries</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-title mb-2">July</div>
                                <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow"
                                            src="assets/modules/flag-icon-css/flags/4x3/id.svg" alt="Flag of Indonesia"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Indonesia</div>
                                            <div class="text-small">3,282 <i class="fas fa-caret-down text-danger"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow"
                                            src="assets/modules/flag-icon-css/flags/4x3/my.svg" alt="Flag of Malaysia"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Malaysia</div>
                                            <div class="text-small">2,976 <i class="fas fa-caret-down text-danger"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow"
                                            src="assets/modules/flag-icon-css/flags/4x3/us.svg"
                                            alt="Flag of the United States" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">United States</div>
                                            <div class="text-small">1,576 <i class="fas fa-caret-up text-success"></i>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 mt-sm-0 mt-4">
                                <div class="text-title mb-2">August</div>
                                <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow"
                                            src="assets/modules/flag-icon-css/flags/4x3/id.svg" alt="Flag of Indonesia"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Indonesia</div>
                                            <div class="text-small">3,486 <i class="fas fa-caret-up text-success"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow"
                                            src="assets/modules/flag-icon-css/flags/4x3/ps.svg" alt="Flag of Palestine"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Palestine</div>
                                            <div class="text-small">3,182 <i class="fas fa-caret-up text-success"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow"
                                            src="assets/modules/flag-icon-css/flags/4x3/de.svg" alt="Flag of Germany"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Germany</div>
                                            <div class="text-small">2,317 <i class="fas fa-caret-down text-danger"></i>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @role('Admin|Manager')
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" style= "justify-content: space-between;">
                            <h2 class="card-stats-title">
                                Orders</h2>
                            <div class="card-header-action">
                                <a href="order" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Order No</th>
                                        <th>Paid Amount</th>
                                        <th>Delivery Date</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    // Fetch data from the 'orders' table
                                    $query = 'SELECT id, order_no, paid_amount, delivery_date FROM orders';
                                    $result = $conn->query($query);
                                    
                                    if ($result && $result->num_rows > 0) {
                                        // Loop through each row and display it
                                        while ($row = $result->fetch_assoc()) {
                                            $orderNo = htmlspecialchars($row['order_no']);
                                            $paidAmount = htmlspecialchars($row['paid_amount']);
                                            $deliveryDate = htmlspecialchars($row['delivery_date']);
                                            $orderId = htmlspecialchars($row['id']);
                                    
                                            echo "<tr>
                                                                                                                                                <td>{$orderNo}</td>
                                                                                                                                                <td class='font-weight-600'>£" .
                                                number_format($paidAmount, 2) .
                                                "</td>
                                                                                                                                                <td>{$deliveryDate}</td>
                                                                                                                                                <td>
                                                                                                                                                <a href=\"" .
                                                route('order.show', ['order' => $orderId]) .
                                                "\" class='btn btn-primary'>Detail</a>
                                                                                                                                                </td>
                                                                                                                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No records found</td></tr>";
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
            <div class="col-md-4">
                <div class="card card-hero">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="far fa-question-circle"></i>
                        </div>
                        <h3>2</h3>
                        <div class="card-description">Staff members need assistance</div>
                    </div>
                    <div class="card-body p-0">
                        <div class="tickets-list">
                            <div class="ticket-item">
                                <div class="ticket-title">
                                    <h4>Customer requesting refund for damaged product</h4>
                                </div>
                                <div class="ticket-info">
                                    <div>Sal Clarkson</div>
                                    <div class="bullet"></div>
                                    <div class="text-primary time-text">1 min ago</div>
                                </div>
                            </div>
                            <div class="ticket-item">
                                <div class="ticket-title">
                                    <h4>Pending: Team performance review from last month</h4>
                                </div>
                                <div class="ticket-info">
                                    <div>Sue Pervisor</div>
                                    <div class="bullet"></div>
                                    <div class="time-text">2 hours ago</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);
            // EMPLOYEE BAR CHART
            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Locations', 'Employees'],
                    <?php
                    
                    $host = 'localhost';
                    $db = 'candy';
                    $user = 'root';
                    $pass = '';
                    
                    $conn = new mysqli($host, $user, $pass, $db);
                    
                    if ($conn->connect_error) {
                        die('Connection failed: ' . $conn->connect_error);
                    }
                    
                    $branches = [
                        1 => 'Sheffield',
                        2 => 'Manchester',
                        3 => 'London',
                    ];
                    $data_array = [];
                    foreach ($branches as $id => $name) {
                        $sql = "SELECT COUNT(*) as count FROM users WHERE branch_id = $id";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $data_array[] = "['$name', {$row['count']}]";
                        }
                    }
                    echo implode(",\n", $data_array);
                    $conn->close();
                    ?>
                ]);

                var options = {
                    title: 'Number of Employees in Each Branch',
                    hAxis: {
                        title: 'Locations',
                        titleTextStyle: {
                            italic: false
                        }
                    },
                    vAxis: {
                        title: 'Employees',
                        titleTextStyle: {
                            italic: false
                        },
                        viewWindow: {
                            min: 0
                        }
                    },
                    legend: {
                        position: 'none'
                    },
                    bar: {
                        groupWidth: '50%'
                    },
                    chartArea: {
                        left: 70,
                        top: 50,
                        right: 20,
                        bottom: 50,
                        width: '80%',
                        height: '70%'
                    }
                };

                var chart = new google.visualization.ColumnChart(document.getElementById('bar_chart'));
                chart.draw(data, options);
            }
        </script>
        <?php
        
        $host = 'localhost';
        $db = 'candy';
        $user = 'root';
        $pass = '';
        
        $conn = new mysqli($host, $user, $pass, $db);
        
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }
        
        // PIE CHART PRODUCTS
        $sql = 'SELECT name, quantity FROM products WHERE quantity > 200';
        $result = $conn->query($sql);
        
        $data = [['Product', 'Quantity']];
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = [$row['name'], (int) $row['quantity']];
            }
        }
        
        $conn->close();
        ?>

        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                const data = <?php echo json_encode($data); ?>;


                const googleData = google.visualization.arrayToDataTable(data);

                const options = {
                    title: 'Best Products',
                    titleTextStyle: {
                        fontSize: 18,
                        fontName: 'Arial'
                    },
                    is3D: true,
                    pieSliceText: 'label',
                    tooltip: {
                        isHtml: true
                    },
                    legend: {
                        position: 'right',
                        textStyle: {
                            fontSize: 12,
                            maxLines: 3
                        }
                    },
                    chartArea: {
                        left: 0,
                        top: 50,
                        right: 0,
                        bottom: 20,
                        width: '70%',
                        height: '70%'
                    }
                };


                const chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(googleData, options);
            }
        </script>
        </body>

        </html>
    </section>
@endsection
