<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<div
    class="header d-flex justify-content-between gap-5 align-items-center py-3">
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
    <div class="d-flex justify-content-end gap-5 flex-fill align-items-center navigasi">
        <a href="#" class="btn btn-link">Help</a>
        <a href="#" class="btn btn-link">Contact</a>
        <a href="#" class="btn btn-link">
            <img
                src="images/image/profile.png"
                class="img-fluid"
                width="50"
                alt="Logo"
                style="margin-left: -30px; margin-top: -15px;" />
            <?php echo $_SESSION['fullname'] ?>
        </a>
    </div>
</div>