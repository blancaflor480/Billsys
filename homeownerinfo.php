<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php?error=Login%20First");
    die();
}

include 'config.php';
include 'Sidebar.php';

$email = $_SESSION['email'];
$conn_String = mysqli_connect("localhost", "root", "", "billing");

$stmt = $conn_String->prepare("SELECT * FROM tableusers WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$meta = $stmt->get_result()->fetch_assoc();

if (!$meta) {
    header("Location: index.php?error=Login%20First");
    exit();
}

if (isset($_POST['update'])) {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $bday = $_POST['bday'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $category = $_POST['category'];

    // Check if an image file was uploaded
    if ($_FILES["image"]["error"] == 0) {
        $image_name = addslashes($_FILES['image']['name']);
        $image_size = $_FILES["image"]["size"];

        if ($image_size > 10000000) {
            die("File size is too big!");
        }

        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $image_name);

        // Update the user with the new image using parameterized query
        $stmt = $conn_String->prepare("UPDATE tableusers SET fname=?, mname=?, lname=?, bday=?, gender=?, contact=?, address=?, category=?, image=? WHERE email=?");
        $stmt->bind_param("ssssssssss", $fname, $mname, $lname, $bday, $gender, $contact, $address, $category, $image_name, $email);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo '<div class="alert alert-success alert-dismissible fade show ms-4" role="alert" style="width: 95%;">
            Successfully updated customer info!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            echo '<script>window.setTimeout(function(){window.location.href="homeownerinfo.php";}, 2000);</script>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show ms-4" role="alert" style="width: 95%;">
            Update failed!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        $stmt->close();
    } else {
        // Update the user without changing the image using parameterized query
        $stmt = $conn_String->prepare("UPDATE tableusers SET fname=?, mname=?, lname=?, bday=?, gender=?, contact=?, address=?, category=? WHERE email=?");
        $stmt->bind_param("sssssssss", $fname, $mname, $lname, $bday, $gender, $contact, $address, $category, $email);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo '<div class="alert alert-success alert-dismissible fade show ms-4" role="alert" style="width: 95%;">
            Successfully updated customer info!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            echo '<script>window.setTimeout(function(){window.location.href="homeownerinfo.php";}, 2000);</script>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show ms-4" role="alert" style="width: 95%;">
            Update failed!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        $stmt->close();
    }
}
?>


<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-3">
            <h4>Homeowner's information</h4>
        </div>
        <div class="card">
            <div class="card-header" style="font-size: 1.2rem;">
                Personal Details
            </div>
            
<form method="POST" id="billing-form" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
        <input type="hidden" name="id" value="<?= isset($meta['email']) ? $meta['email'] : '' ?>">
                            
            <div class="card-body">

<div class="mb-3 row ms-2">
    <label for="fname" class="col-sm-3 col-form-label">First Name</label>
    <div class="col-sm-7">
        <input type="text" name="fname" class="form-control form-control-sm" style="background-color: #D5D5D5" id="fname" value="<?= isset($meta['fname']) ? $meta['fname'] : '' ?>" required>
         <div class="invalid-feedback">
      Please enter your firstname
    </div>

    </div>
</div>

<div class="mb-3 row ms-2">
    <label for="mname" class="col-sm-3 col-form-label">Middle Name</label>
    <div class="col-sm-7">
        <input type="text" name="mname" class="form-control form-control-sm" style="background-color: #D5D5D5" id="mname" value="<?= isset($meta['mname']) ? $meta['mname'] : '' ?>" required>
    <div class="invalid-feedback">
      Please enter your middle name
    </div>

    </div>
</div>

<div class="mb-3 row ms-2">
    <label for="lname" class="col-sm-3 col-form-label">Last Name</label>
    <div class="col-sm-7">
        <input type="text" name="lname" class="form-control form-control-sm" style="background-color: #D5D5D5" id="lname" value="<?= isset($meta['lname']) ? $meta['lname'] : '' ?>" required>
    <div class="invalid-feedback">
      Please enter your lastname
    </div>

    </div>
</div>
<div class="mb-3 row ms-2">
    <label for="email" class="col-sm-3 col-form-label">Email</label>
    <div class="col-sm-7">
        <input type="email" name="email" class="form-control form-control-sm" style="background-color: #D5D5D5" id="email" value="<?= isset($meta['email']) ? $meta['email'] : '' ?>" disabled>
    </div>
</div>
<div class="mb-3 row ms-2">
    <label for="bday" class="col-sm-3 col-form-label">Birthday</label>
    <div class="col-sm-7">
        <input type="date" name="bday" class="form-control form-control-sm" style="background-color: #D5D5D5" id="bday" value="<?= isset($meta['bday']) ? $meta['bday'] : '' ?>" required>
    <div class="invalid-feedback">
      Please select your birthday
    </div>

    </div>
</div>
<div class="mb-3 row ms-2">
    <label for="gender" class="col-sm-3 col-form-label">Gender</label>
    <div class="col-sm-7">
        <select class="form-select form-select-sm" name="gender" style="background-color: #D5D5D5" aria-label="Default select example">
            <option selected disabled>Please Select Here</option>
            <option <?php if ($result['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option <?php if ($result['gender'] == 'Female') echo 'selected'; ?>>Female</option>
        </select>
        <div class="invalid-feedback">
      Please select your gender
    </div>

    </div>
</div>
<div class="mb-3 row ms-2">
    <label for="address" class="col-sm-3 col-form-label">Address</label>
    <div class="col-sm-7">
        <input type="text" name="address" class="form-control form-control-sm" style="background-color: #D5D5D5" id="address" value="<?= isset($meta['address']) ? $meta['address'] : '' ?>" required>
        <div class="invalid-feedback">
      Please enter your complete address
    </div>

    </div>
</div>
<div class="mb-3 row ms-2">
    <label for="category" class="col-sm-3 col-form-label">Category</label>
    <div class="col-sm-7">
        <select name="category" class="form-select form-select-sm" style="background-color: #D5D5D5" aria-label="Default select example">
            <option selected disabled>Select Category</option>
            <option <?php if ($result['category'] == 'Residences') echo 'selected'; ?>>Residences</option>
            <option <?php if ($result['category'] == 'Business') echo 'selected'; ?>>Business</option>
            <option <?php if ($result['category'] == 'Others') echo 'selected'; ?>>Others</option>
        </select>
<div class="invalid-feedback">
      Please select category
    </div>
    </div>
</div>

<div class="mb-3 row ms-2">
    <label for="contact" class="col-sm-3 col-form-label">Contact No.</label>
    <div class="col-sm-7">
        <input type="number" name="contact" class="form-control form-control-sm" style="background-color: #D5D5D5" id="contact" value="<?= isset($meta['contact']) ? $meta['contact'] : '' ?>" required>
         <div class="invalid-feedback">
      Please enter your contact number
    </div>
    </div>
</div>

<div class="mb-3 row ms-2">
    <label for="" class="col-sm-3 col-form-label">Profile Image</label>
    <div class="col-sm-7">
        <input type="file" name="image" class="form-control form-control-sm" style="background-color: #D5D5D5" id="image" value="<?= isset($meta['image']) ? $meta['image'] : '' ?>">
    </div>
</div>

                 
                 </form>

            </div>
<div class="card-footer d-flex justify-content-center mt-2  ">
        <button type="button" class="btn btn-success me-2 btn-sm" data-bs-toggle="modal" data-bs-target="#confirmationModal">Update</button>
        <button type="button" class="btn btn-secondary btn-sm">Close</button>
    </div>

        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="confirmationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         Are you sure you want to update the homeowner information?
      </div>
      <div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-success" form="billing-form" name="update">Save</button>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    </div>
    </div>
  </div>
</div>
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

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>