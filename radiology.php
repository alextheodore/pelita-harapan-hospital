<?php
$allServices = [
    [
        'id' => 1,
        'name' => '3T MRI',
        'description' => [
            'High-resolution imaging for detailed body scans',
            'Ideal for brain, spine, and musculoskeletal imaging',
            'Non-invasive and painless procedure',
        ],
        'price' => 1200000,
    ],
    [
        'id' => 2,
        'name' => 'Angiography',
        'description' => [
            'Visualizes blood vessels and flow in detail',
            'Used to diagnose vascular conditions',
            'Minimally invasive with a catheter and dye',
        ],
        'price' => 1000000,
    ],
    [
        'id' => 3,
        'name' => 'C Arm',
        'description' => [
            'Real-time imaging during surgical procedures',
            'Portable X-ray machine for intraoperative use',
            'Helps guide precision in minimally invasive surgery',
        ],
        'price' => 900000,
    ],
    [
        'id' => 4,
        'name' => 'CT Scan',
        'description' => [
            'Produces cross-sectional images of body tissues',
            'Effective for detecting tumors and injuries',
            'Quick and accurate diagnosis tool',
        ],
        'price' => 800000,
    ],
    [
        'id' => 5,
        'name' => 'Digital X-ray',
        'description' => [
            'High-quality images with minimal radiation',
            'Used for diagnosing bone fractures and chest issues',
            'Quick and efficient imaging process',
        ],
        'price' => 700000,
    ],
    [
        'id' => 6,
        'name' => 'Mammography',
        'description' => [
            'Specialized X-ray for breast tissue examination',
            'Helps in early detection of breast cancer',
            'Recommended for routine breast screening',
        ],
        'price' => 1500000,
    ],
    [
        'id' => 7,
        'name' => '4D Ultrasound',
        'description' => [
            'Advanced imaging for real-time fetal visualization',
            'Commonly used in prenatal examinations',
            'Safe and non-invasive ultrasound technology',
        ],
        'price' => 1100000,
    ],
    [
        'id' => 8,
        'name' => 'Bone Mineral Densitometry',
        'description' => [
            'Measures bone density for osteoporosis diagnosis',
            'Quick and non-invasive scanning method',
            'Helps assess fracture risk and bone health',
        ],
        'price' => 950000,
    ],
    [
        'id' => 9,
        'name' => 'Cath Lab',
        'description' => [
            'Facility for specialized cardiovascular procedures',
            'Used for angioplasties and cardiac catheterizations',
            'Advanced equipment for heart and blood vessel imaging',
        ],
        'price' => 2000000,
    ],
    [
        'id' => 10,
        'name' => 'Digital Panoramic',
        'description' => [
            'Wide-view X-ray of the entire jaw and teeth',
            'Essential for dental and orthodontic assessments',
            'Quick and comfortable for patients',
        ],
        'price' => 850000,
    ],
    [
        'id' => 11,
        'name' => 'Fluoroscopic Examination',
        'description' => [
            'Real-time imaging of internal organs in motion',
            'Ideal for gastrointestinal and joint examinations',
            'Uses contrast dye for clearer visuals',
        ],
        'price' => 1300000,
    ],
    [
        'id' => 12,
        'name' => 'PET Scan',
        'description' => [
            'Detects metabolic activity in tissues',
            'Effective for cancer and neurological diagnosis',
            'Combines with CT for detailed imaging',
        ],
        'price' => 2500000,
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
    <link rel="stylesheet" href="css/radiology.css" />
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
            <h1 class="fw-medium">Registration > <span class="fw-bold">Radiology Test</span></h1>
                <div style="background-color: white;" class="d-flex justify-content-center flex-column align-items-center p-4">
                    <h2 class="text-center m-3 p-3">Choose your Radiology Test!</h2>
                    <div class="row" id="serviceList">
                        <?php foreach ($allServices as $service): ?>
                            <div class="col-md-4 mb-4">
                                <?php
                                $serviceDetails = json_encode([
                                    'id' => $service['id'],
                                    'name' => $service['name'],
                                    'price' => $service['price'],
                                    'description' => $service['description'],
                                    'type' => "Radiology",
                                ]);
                                $_SESSION['test'] = $serviceDetails;
                                $encodedServiceDetails = urlencode($serviceDetails);
                                ?>
                                <a href="radiology_details.php?service=<?php echo $encodedServiceDetails; ?>" style="text-decoration: none; color: inherit;">
                                    <div class="service-item d-flex justify-content-center align-items-center p-3 rounded m-4" style="height: 150px; min-width: 200px;">
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