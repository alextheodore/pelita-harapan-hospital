<?php
$allServices = ['Acupuncture', 'Clinical Nutrition', 'Dermatology', 'Dentistry', 'Internal Medicine', 'Cardiology', 'Ophtalmology', 'Pediatrics', 'Orthopedics'];
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/specialist.css" />
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
                <h1 class="fw-medium">Registration > Book Appointment > <span class="fw-bold">Specialist</span></h1>
                <br>
                <div style="background-color: white;" class="d-flex justify-content-center flex-column align-items-center">
                    <h2 class="text-center m-3 p-3">Choose your specialist fields!</h2>
                    <input type="text" id="searchInput" placeholder="Search specialist fields..." class="form-control mb-3" style="width: 300px;">
                    <div class="row" id="serviceList">
                        <?php foreach ($allServices as $service): ?>
                            <div class="col-md-4 mb-4">
                                <a href="conf/get_doctors.php?specialist=<?php echo urlencode($service); ?>" style="text-decoration: none; color: inherit;">
                                    <div class="service-item d-flex justify-content-center align-items-center p-3 rounded m-4" style="height: 150px; min-width: 200px;">
                                        <h3 class="text-center"><?php echo $service; ?></h3>
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
    document.getElementById('searchInput').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let items = document.querySelectorAll('.service-item');

        items.forEach(function(item) {
            let text = item.textContent.toLowerCase();
            if (text.includes(filter)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>