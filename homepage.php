<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pelita Harapan Hospital</title>
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
        <div
          class="header d-flex justify-content-start align-items-center py-3 gap-5">
          <form class="d-flex search-form">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search" />
            <button class="btn btn-outline-success" type="submit">
              Search
            </button>
          </form>
          <div class="d-flex gap-5 navigasi flex-fill">
            <a href="#" class="btn btn-link">Help</a>
            <a href="#" class="btn btn-link">Contact</a>
          </div>
        </div>

        <h1>Pelita Harapan Hospital</h1>
        <div class="image-container mb-4 bg-white">
          <img
            src="images/doctor.png"
            class="img-fluid"
            alt="Doctors" />
        </div>

        <div class="hospital-description p-3">
          <p>
            Pelita Harapan Hospital is the largest private hospital network
            providing healthcare services in the form of hospitals and clinics
            across various cities in Indonesia. With over 41 hospital branches
            that reaches all segments of society with comprehensive facilities
            and professional medical staff ready to deliver high-quality,
            internationally standardized medical services.
          </p>
        </div>
      </div>
    </div>
  </div>
</body>

</html>