<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: index.php?error=Login%20First");
        die();
    }

    include 'config.php';

    $email = $_SESSION['email'];
    $conn_String = mysqli_connect("localhost", "root", "", "billing");
    $stmt = $conn_String->prepare("SELECT * FROM tableusers WHERE email = '{$_SESSION['email']}'");
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    
    if (!$result) {
        header("Location: index.php?error=Login%20First");
        exit();
    }

?>


<?php include('sidebar.php'); ?>

   <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Homeowner Homepage</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h4>Welcome Back, <?php echo $result['fname']; ?>   </h4>
                                                <p class="mb-0">Date: <?php echo $result['Logintime']; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-end">
                                            <img src="image/bills.png" class="img-fluid illustration-img"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                           include 'config.php';
                           $email = $_SESSION['email'];

                           $query = mysqli_query($conn_String, "SELECT COUNT(id) AS numberofpending FROM tablebilling_list WHERE status = 2");
                           $row = mysqli_fetch_assoc($query);

                           if (mysqli_num_rows($query) > 0) { 
                            $numberofpending = $row['numberofpending'];
                           } else {
                           $numberofpending = 2;
                          }
                        ?>
                        <div class="col-12 col-md-3 d-flex">
                           <div class="card flex-fill border-0">
                              <div class="card-body py-4">
                                <div class="d-flex align-items-start">
                                  <div class="flex-grow-1">
                                     <h4 class="mb-2">
                                         New Bills
                                     </h4>
                                    <h4 class="mb-2" style="font-weight: bold; color: darkred;">
                                      <?php echo $numberofpending ?>
                                    </h4>
                                   </div>
                                   <div class="ms-2" style="margin-top: 10px;">
                                   <i class="fa-regular fa-envelope" style="font-size: 60px;"></i>
                                    </div>
                                 </div>
                              </div>
                           </div>
                       </div> 
                        <div class="col-12 col-md-3 d-flex">
                           <div class="card flex-fill border-0">
                              <div class="card-body py-4">
                                <div class="d-flex align-items-start">
                                  <div class="flex-grow-1">
                                     <h4 class="mb-2">
                                         Date Registered
                                     </h4>
                                    <p class="mb-2">
                                                <?php echo $result['datereg']; ?>
                                            </p>
                                   </div>
                                   <div class="ms-2" style="margin-top: 10px;">
                                   <i class="fa-regular fa-calendar-days" style="font-size: 60px;"></i>
                                    </div>
                                 </div>
                              </div>
                           </div>
                       </div>
                         <!--<div class="col-12 col-md-3 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <h4 class="mb-2">
                                                Registered Date
                                            </h4>
                                            <p class="mb-2">
                                                <?php echo $result['datereg']; ?>
                                            </p>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                        
                    </div>
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Announcement
                            </h5>
                            <h6 class="card-subtitle text-muted">
                                This announcement provides information about scheduled maintenance for our billing system. 
                            </h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Message</th>
                                        <th scope="col">Date</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">System maintainance.</th>
                                        <td>Febuary 10, 2023</td>
                                        
                                    </tr>
                                    <tr>
                                        <th scope="row">System maintainance.</th>
                                        <td>Febuary 10, 2023</td>
                                        
                                    </tr>
                                    <tr>
                                        <th scope="row">System maintainance.</th>
                                        <td colspan="2">Febuary 10, 2023</td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <!--<a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    <strong>RRBMS</strong>
                                </a>
                            </p>
                        </div>
                        
                    </div>
                </div>
            </footer>
        </div>
    </div>
 