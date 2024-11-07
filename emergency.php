<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pelita Harapan Hospital - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/emergency.css" />
</head>

<body>
  <div class="container-fluid">
    <div class="row">

      <!-- Sidebar -->
      <?php include 'sidebar.php' ?>

      <!-- Main Content -->
      <div class="col-md-10 content">

        <!-- Header and Search Bar -->
        <?php include 'topbar.php' ?>

        <!-- Welcome Section -->
        <h1 class="fw-medium">Registration > Emergency > <span class="fw-bold"><?php echo $_SESSION['patient_name'] ?></span></h1>
        <div class="col-md-12">
          <div class="form-section ">


            <h1>Patient Emergency Registration Form</h1>
            <p>Please fill in the following data</p>
            <form method="POST" action="conf/create_emergency.php">
              <div class="form-group">
                <input type="text" name="name" value="<?php echo $_SESSION['patient_name']; ?>">
              </div>
              <div class="form-group">
                <input type="date" name="dob" value="<?= htmlspecialchars(date('Y-m-d', strtotime($_SESSION['patient_dob']))) ?>">
                <select name="gender">
                  <option value="male" <?= $_SESSION['patient_gender'] == 'male' ? 'selected' : '' ?>>Male</option>
                  <option value="female" <?= $_SESSION['patient_gender'] == 'female' ? 'selected' : '' ?>>Female</option>
                </select>
              </div>
              <div class="form-group">
                <input type="text" name="phone1" value="<?php echo $_SESSION['patient_phone']; ?>">
                <input type="text" name="phone2" placeholder="Phone number 2 (optional) ">
              </div>
              <div class="form-group">
                <input type="text" name="nik" value="<?php echo $_SESSION['patient_nik']; ?>">
                <input type="email" name="email" value="<?php echo $_SESSION['patient_email']; ?>">
              </div>
              <div class="form-group">
                <input type="text" name="address" value="<?php echo $_SESSION['patient_address']; ?>">
              </div>
              <div class="form-group">
                <label>Payment</label>
                <select name="payment">
                  <option>Prudential</option>
                  <option>Alianz</option>
                  <option>OCBC</option>
                  <option>Manulife</option>
                  <option>AXA</option>
                </select>
                <label>Inpatient/Outpatient</label>
                <select name="inpatient_outpatient">
                  <option>Inpatient</option>
                  <option>Outpatient</option>
                </select>
              </div>
              <div class="form-group">
                <label>Ambulance</label>
                <select name="ambulance">
                  <option>1</option>
                  <option>0</option>
                </select>
                <label>Actions</label>
                <select name="actions">
                  <option>Observed</option>
                  <option>Call for Specialist</option>
                </select>
              </div>
              <div class="form-group">
                <input type="text" name="note" placeholder="Note (fill '-' if null)">
              </div>

              <?php if (isset($_SESSION['error'])) {
                echo '<div id="errorMessage" class="alert alert-danger animate__animated animate__fadeInDown" role="alert" style="background-color: #fe4949; color: white; text-align: center; margin: 20px auto; padding: 15px; border-radius: 5px; width: 30%">'
                  . htmlspecialchars($_SESSION['error']) . '</div>';
                unset($_SESSION['error']);
              } ?>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>

</body>

</html>