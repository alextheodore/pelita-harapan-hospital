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
        <h1>Registration > Emergency</h1>
        <div class="col-md-12">
          <div class="form-section ">


            <h1>Patient Registration Form</h1>
            <p>Please fill in the following data</p>
            <form>
              <div class="form-group">
                <input type="text" placeholder="Name">
              </div>
              <div class="form-group">
                <input type="date">
                <select name="gender">
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
              <div class="form-group">
                <input type="text" placeholder="Phone number">
                <input type="text" placeholder="Phone number 2">
              </div>
              <div class="form-group">
                <input type="text" placeholder="NIK">
                <input type="email" placeholder="Email">
              </div>
              <div class="form-group">
                <input type="text" placeholder="Address">
              </div>
              <div class="form-group">
                <label>Payment</label>
                <select>
                  <option>Prudential</option>
                  <option>Alianz</option>
                  <option>OCBC</option>
                  <option>Manulife</option>
                  <option>AXA</option>
                </select>
                <label>Inpatient/Outpatient</label>
                <select>
                  <option>Inpatient</option>
                  <option>Outpatient</option>
                </select>
              </div>
              <div class="form-group">
                <label>Ambulance</label>
                <select>
                  <option>Yes</option>
                  <option>No</option>
                </select>
                <label>Actions</label>
                <select>
                  <option>Observed</option>
                  <option>Call for Specialist</option>
                </select>
              </div>
              <button type="button" onclick="window.location.href='registration.php'">Submit</button>

            </form>

          </div>
        </div>


      </div>

    </div>
  </div>

</body>

</html>