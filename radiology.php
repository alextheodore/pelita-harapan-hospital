<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/radiology.css" />
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
                <h1>Registration - Radiology Test</h1>
                <div class="radiology-test">
                    <h2>Radiology Test</h2>
                    <div class="test-options">
                        <button class="test-btn">3T MRI</button>
                        <button class="test-btn" id="angiography-btn">Angiography</button>
                        <button class="test-btn">C Arm</button>
                        <button class="test-btn">CT Scan</button>
                        <button class="test-btn">Digital X-ray</button>
                        <button class="test-btn">Mammography</button>
                        <button class="test-btn">4D Ultrasound</button>
                        <button class="test-btn">Bone Mineral Densitometry</button>
                        <button class="test-btn">Cath Lab</button>
                        <button class="test-btn">Digital Panoramic</button>
                        <button class="test-btn">Fluoroscopic Examination</button>
                        <button class="test-btn">PET Scan</button>
                    </div>

                    <!-- Submenu for Angiography -->
                    <div id="angiography-menu" class="submenu">
                        <button>Coronary Angiography (2.000.000)</button>
                        <button>Pulmonary Angiography (2.000.000)</button>
                        <button>Cerebral Angiography (2.000.000)</button>
                        <button>Renal Angiography (2.000.000)</button>
                    </div>

                    <!-- Next Button -->
                    <a href="radiologyschedule.php" class="next-btn">Next</a>
                </div>



            </div>
        </div>
    </div>
</body>

</html>