 <!DOCTYPE html>
 <html lang="en">


 <head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>Pelita Harapan Hospital - Home</title>
     <link
         href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
         rel="stylesheet" />
     <link rel="stylesheet" href="css/neurology.css" />
 </head>

 <style>
     .service-item {
         background-color: #e895b7;
         transition: .3s ease;
         cursor: pointer;
         color: white;
     }

     .service-item:hover {
         background-color: whitesmoke;
         transition: .3s ease;
         transform: scale(1.07);
         color: #e895b7;
         ;
     }
 </style>

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
                 <h1 class="fw-medium">Registration > Book Appointment > <?php 
                 if($_SESSION['specialist'] == "Specialist"){
                    echo "Specialist > ";
                 }
                 else{

                 }
                 ?>
                 <span class="fw-bold">
                    <?php echo $_GET['specialist'] . " Practicioner" ?>
                </span></h1>
                 <div style="background-color: white;" class="d-flex justify-content-center flex-column align-items-center">
                     <h2 class="text-center m-3 p-3">Choose your specialist doctor!</h2>
                     <input type="text" id="searchInput" placeholder="Search doctor..." class="form-control mb-3" style="width: 300px;" oninput="filterDoctors()">
                     <div class="row" id="serviceList">
                         <?php foreach ($_SESSION['doctors'] as $doctor): ?>
                             <?php
                                // Create a JSON object for the doctor's details and encode it for the URL
                                $doctorDetails = json_encode([
                                    'id' => $doctor['doctor_id'],
                                    'name' => $doctor['name']
                                ]);
                                $_SESSION['selectedDoctor'] = $doctorDetails;
                                $_SESSION['selectedSpecialist'] = $_GET['specialist'];
                                $encodedDoctorDetails = urlencode($doctorDetails);
                                ?>
                             <div class="col-md-4 mb-4">
                                 <a href="doctorschedule.php?specialist=<?php echo urlencode($_GET['specialist']); ?>&doctor=<?php echo $encodedDoctorDetails; ?>" style="text-decoration: none; color: inherit;">
                                     <div class="service-item d-flex justify-content-around align-items-center p-3 rounded m-4 flex-row" style="height: 150px; min-width: 200px;">
                                         <img src="/images/gambar_dokter.png" width="100px" height="100px">
                                         <h3 class="text-center"><?php echo $doctor['name'] ?></h3>
                                     </div>
                                 </a>
                             </div>
                         <?php endforeach; ?>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </body>

 </html>

 <script>
     function filterDoctors() {
         const input = document.getElementById('searchInput').value.toLowerCase();
         const doctorItems = document.querySelectorAll('#serviceList .col-md-4');

         doctorItems.forEach(item => {
             const doctorName = item.querySelector('h3').textContent.toLowerCase();
             if (doctorName.includes(input)) {
                 item.style.display = ''; // Show the item
             } else {
                 item.style.display = 'none'; // Hide the item
             }
         });
     }
 </script>