<?php include 'conf/session_check.php'; ?>
<div
    class="col-md-2 sidebar d-flex flex-column align-items-center py-3">
    <a href="index.php">
        <img
            src="images/image/logo.png"
            class="img-fluid mb-3"
            alt="Logo" />
        <nav class="nav flex-column w-100">
            <a class="nav-link active" href="home.php">
                <div
                    class="d-flex flex-column flex-wrap justify-content-center align-items-center gap-4 w-100">
                    <img src="images/image/home.png" alt="Home" style="background-color: var(--accent-color); border-radius: 30px; width: 65px;" />
                    <p>Home</p>
                </div>
            </a>
            <a class="nav-link" href="registrationland.php">
                <div
                    class="d-flex flex-column flex-wrap justify-content-center align-items-center gap-4 w-100">
                    <img
                        src="images/image/registration.jpeg"
                        style="width: 65px;"
                        alt="Registration" />
                    <p>Registration</p>
                </div>
            </a>
            <a class="nav-link" href="patientstatus.php">
                <div
                    class="d-flex flex-column flex-wrap justify-content-center align-items-center gap-4 w-100">
                    <img
                        src="images/image/patient_status.jpeg"
                        style="width: 65px;"
                        alt="Patient Status" />
                    <p>Patient Status</p>
                </div>
            </a>
            <a class="nav-link" href="conf/logout.php">
                <div class="d-flex flex-column flex-wrap justify-content-center align-items-center gap-4 w-100" style="background-color: #aaaaaa; border-radius: 30px;">
                    <img src="images/image/login.png" style="width: 65px;" alt="Logout" />
                    <p class="text-white">Logout</p>
                </div>
            </a>
        </nav>
</div>