<!DOCTYPE html>
<html lang="en" data-bs-theme="white">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rosedale E-Billing System</title>
    <link rel="icon" href="image/rosedalelogo.png" type="image/icon type">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">

    <!-- Include Alertify CSS for styling -->
   
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
     
</head>
<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">E-BILLING SYSTEM</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Main
                    </li>
                    <li class="sidebar-item">
                        <a href="dashboard.php" class="sidebar-link">
                            <i class="fa fa-home pe-2"></i>
                            Home
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Billing
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item ">
                                <a href="billing.php" class="sidebar-link"><i class="fa-solid fa-scroll pe-2"></i> Billing Dues</a>
                            </li>
                            <!--<li class="sidebar-item">
                                <a href="#" class="sidebar-link">Page 2</a>
                            </li>-->
                        </ul>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item ">
                                <a href="history_transaction.php" class="sidebar-link"><i class="fa-solid fa-scroll pe-2"></i> History Transaction</a>
                            </li>
                            <!--<li class="sidebar-item">
                                <a href="#" class="sidebar-link">Page 2</a>
                            </li>-->
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="homeownerinfo.php" class="sidebar-link collapsed"><i class="fa-solid fa-user pe-2"></i>
                            User Information
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="complaint.php" class="sidebar-link collapsed"><i class="fa-solid fa-message pe-2"></i>
                           Complaint
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="setting.php" class="sidebar-link collapsed"><i class="fa-solid fa-gear pe-2"></i>
                            Settings
                        </a>
                   </li> 

                       <!--<ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Login</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Register</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Forgot Password</a>
                            </li>
                        </ul>-->
                   
                    <!--<li class="sidebar-header">
                        Multi Level Menu
                    </li>-->
                    <!--<li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#multi" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-share-nodes pe-2"></i>
                            Multi Dropdown
                        </a>
                        <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link collapsed" data-bs-target="#level-1"
                                    data-bs-toggle="collapse" aria-expanded="false">Level 1</a>
                                <ul id="level-1" class="sidebar-dropdown list-unstyled collapse">
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Level 1.1</a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Level 1.2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>-->
                </ul>
            </div>
        </aside>
        <?php 
include ('config.php');
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
} else {
  // Handle the case when the session variable is not set, redirect or show an error.
  header("Location: index.php");
  exit();
}

$conn_String = mysqli_connect("localhost", "root", "", "billing");
$stmt = $conn_String->prepare("SELECT * FROM tableusers WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

$query = mysqli_query($conn, "SELECT fname, category, image from tableusers");
if (mysqli_num_rows($query) > 0){
     $row = mysqli_fetch_assoc($query);
     if(isset($row['image'])&& $row['image'] != ""){
     }
 }
?>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">

                    
                    <button type="button" class="btn btn-dark position-relative me-4" style="font-size: 0.7rem;">
                          <i class="fa-regular fa-bell"></i> Notification
                       <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            99+
                       <span class="visually-hidden">unread messages</span>
                      </span>
                    </button>
                        
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                             <div class="d-flex align-items-center"> <!-- Container for image and text -->
                            <!-- "JADE" text on the left -->
                             
                            <img src="image/profile.jpg" class="avatar img-fluid rounded" alt="">
                            <!--&nbsp;<p class="navbar-brand mb-0 me-2" style="font-size: 0.6rem">Logout</p>-->
                        
                        </div>
                        </a>
                            

                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">Profile</a>
                                <a href="logout.php" class="dropdown-item">Log-out</a>
                            </div>

            
            
                        
                    </ul>
                </div>
            </nav>
           <!-- <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Admin Dashboard</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h4>Welcome Back, Admin</h4>
                                                <p class="mb-0">Admin Dashboard, CodzSword</p>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-end">
                                            <img src="image/customer-support.jpg" class="img-fluid illustration-img"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <h4 class="mb-2">
                                                $ 78.00
                                            </h4>
                                            <p class="mb-2">
                                                Total Earnings
                                            </p>
                                            <div class="mb-0">
                                                <span class="badge text-success me-2">
                                                    +9.0%
                                                </span>
                                                <span class="text-muted">
                                                    Since Last Month
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Basic Table
                            </h5>
                            <h6 class="card-subtitle text-muted">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum ducimus,
                                necessitatibus reprehenderit itaque!
                            </h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td colspan="2">Larry the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    <strong>CodzSwod</strong>
                                </a>
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Contact</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">About Us</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Terms</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Booking</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
