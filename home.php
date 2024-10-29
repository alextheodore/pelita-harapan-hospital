<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pelita Harapan Hospital - Home</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="css/home.css" />
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
        <h1>Home</h1>
        <div class="welcome-section text-center p-0 my-4 d-flex flex-row justify-content-start align-items-top">
          <img
            src="images/image/ornament.png"
            class="img-fluid"
            width="200"
            alt="Logo"
            style="margin-left: -30px; margin-top: -15px;" />
          <div class="hero-text flex-fill p-2">
            <h2 class="fs-2 mt-2">Welcome, Marchella!</h2>
            <div class="d-flex justify-content-center align-items-center">
              <p style="font-size: 26px;">
                Let’s check your health with us, care with your health from <br> now to
                get more live better.
              </p>
            </div>
          </div>
        </div>

        <!-- Package Section -->
        <div class="row">
          <div class="col-md-9">
            <div class="image-container text-center mb-4">
              <img
                src="images/poster.jpg"
                class="img-fluid"
                alt="Health Package" />
            </div>
          </div>

          <!-- Upcoming Patients Section -->
          <div class="col-md-3">
            <div class="upcoming-patients p-5">
              <div class="d-flex justify-content-between">
                <h5>Upcoming Patients</h5>
                <img
                  src="images/image/notif.png"
                  class="img-fluid"
                  style="width: 50px;"
                  alt="Logo"
                  style="margin-left: -30px; margin-top: -15px;" />
              </div>
              <a href="#" class="text-secondary text-decoration-none fw-bold d-block text-end">View All</a>
              <ul class="list-group gap-3 rounded-0">
                <li
                  class="list-group-item d-flex justify-content-between align-items-center">
                  <span>A2307 <br> Counter no. 5</span>
                  <img
                    src="images/image/registration.png"
                    class="img-fluid"
                    style="width: 65px;"
                    alt="Logo" />
                </li>
                <li
                  class="list-group-item d-flex justify-content-between align-items-center">
                  <span>A2308 <br> Counter no. 7</span>
                  <img
                    src="images/image/registration.png"
                    class="img-fluid"
                    style="width: 65px;"
                    alt="Logo" />
                </li>
                <li
                  class="list-group-item d-flex justify-content-between align-items-center">
                  <span>A2309 <br> Waiting</span>
                  <img
                    src="images/image/registration.png"
                    class="img-fluid"
                    style="width: 65px;"
                    alt="Logo" />
                </li>
                <li
                  class="list-group-item d-flex justify-content-between align-items-center">
                  <span>A2310 <br> Waiting</span>
                  <img
                    src="images/image/registration.png"
                    class="img-fluid"
                    style="width: 65px;"
                    alt="Logo" />
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>