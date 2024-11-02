<?php
$allServices = [
    [
        'id' => 1,
        'name' => 'Breast Screening Package',
        'image' => 'images/breast.png',
        'description' => [
            'Consultation with a Breast Specialist',
            'Mammography',
            'Breast Ultrasound',
        ],
        'price' => 1499000,
    ],
    [
        'id' => 2,
        'name' => 'Heart Screening Package',
        'image' => 'images/heart.png',
        'description' => [
            'Consultation with a Cardiologist',
            'Electrocardiogram (ECG)',
            'Echocardiogram',
        ],
        'price' => 2499000,
    ],
    [
        'id' => 3,
        'name' => 'Stroke Screening Package',
        'image' => 'images/stroke.png',
        'description' => [
            'Consultation with a Neurologist or Neurosurgeon',
            'Doppler Carotid Ultrasound',
            'Laboratory examination',
        ],
        'price' => 1999000,
    ],
    [
        'id' => 4,
        'name' => 'MCU Comprehensive Package',
        'image' => 'images/mcu.png',
        'description' => [
            'Comprehensive health assessment',
            'Blood tests and screening',
            'Physical examination',
        ],
        'price' => 1450000,
    ],
    [
        'id' => 5,
        'name' => 'Cervix Cancer Screening Package',
        'image' => 'images/cervix.png',
        'description' => [
            'Consultation with a Gynecologist',
            'Pap Smear Test',
            'HPV Testing',
        ],
        'price' => 2599000,
    ],
    [
        'id' => 6,
        'name' => 'Gastrointestinal Screening Package',
        'image' => 'images/gastro.png',
        'description' => [
            'Consultation with a Gastroenterologist',
            'Endoscopy',
            'Colonoscopy',
        ],
        'price' => 3499000,
    ],
];
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
    <link rel="stylesheet" href="css/medical.css" />
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
                <h1 class="fw-medium">Registration > <span class="fw-bold">Medical Check Up</span></h1>
                <div style="background-color: white;" class="d-flex justify-content-center flex-column align-items-center p-4">
                    <h2 class="text-center m-3 p-3">Choose your Medical Check Up!</h2>
                    <div class="row" id="serviceList">
                        <?php foreach ($allServices as $service): ?>
                            <div class="col-md-4 mb-4">
                                <?php
                                $serviceDetails = json_encode([
                                    'id' => $service['id'],
                                    'name' => $service['name'],
                                    'image' => $service['image'],
                                    'description' => $service['description'],
                                    'price' => $service['price'],
                                ]);
                                $encodedServiceDetails = urlencode($serviceDetails); 
                                $_SESSION['test'] = $serviceDetails;
                                ?>
                                <a href="mcu_details.php?service=<?php echo $encodedServiceDetails; ?>" style="text-decoration: none; color: inherit;">
                                    <div class="service-item d-flex justify-content-center align-items-center p-3 rounded m-4" style="height: 150px; min-width: 200px;">
                                        <img src="<?php echo $service['image']; ?>" alt="<?php echo htmlspecialchars($service['name']); ?>" width="100px" height="100px">
                                        <h3 class="text-center"><?php echo $service['name']; ?></h3>
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