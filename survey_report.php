<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin.html');
    exit;
}

include 'db.php';

if (isset($_GET['id'])) {
    $school_id = $_GET['id'];


    // Query to get the school details
    $sql = "SELECT * FROM schools WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $school_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $school = $result->fetch_assoc();
    } else {
        echo "No record found.";
        exit;
    }
} else {
    echo "No school ID provided.";
    exit;
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITKC - Survey Report</title>
    <link rel="stylesheet" href="survey.css">
</head>
<body>
<header>
        <img src="./itglogo.png" alt="Dashboard Image" class="dashboard-img">
        <nav>
            <img src="./itkclogo.png" alt="Logo" class="logo">
            <ul class="Navbar">
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="index.html#about">About</a></li>
                <li><a href="coursestable.html">Courses</a></li>
                <li><a href="faq.html">FAQ</a></li>
                <li><a href="index.html#contact">Contact</a></li>
                <li><a href="admin_logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Survey Report for <?php echo $school['school_name']; ?></h1>
        
        <table class="report-table">
            <tr><th>School Name:</th><td><?php echo $school['school_name']; ?></td></tr>
            <tr><th>Registration Number:</th><td><?php echo $school['reg_no']; ?></td></tr>
            <tr><th>Principal Name:</th><td><?php echo $school['principal_name']; ?></td></tr>
            <tr><th>Contact Information:</th><td><?php echo $school['contact_info']; ?></td></tr>
            <tr><th>CARES Scheme:</th><td><?php echo $school['cares_scheme']; ?></td></tr>
            <tr><th>Road Name:</th><td><?php echo $school['road_name']; ?></td></tr>
            <tr><th>City/Town:</th><td><?php echo $school['city_town']; ?></td></tr>
            <tr><th>Pincode:</th><td><?php echo $school['pincode']; ?></td></tr>
            <tr><th>District:</th><td><?php echo $school['district']; ?></td></tr>
            <tr><th>Principal Phone:</th><td><?php echo $school['principal_phone']; ?></td></tr>
            <tr><th>Total Students:</th><td><?php echo $school['total_students']; ?></td></tr>
            <tr><th>Total Systems:</th><td><?php echo $school['total_systems']; ?></td></tr>
            <tr><th>System OS:</th><td><?php echo $school['system_os']; ?></td></tr>
            <tr><th>System Manufacturer:</th><td><?php echo $school['system_manufacturer']; ?></td></tr>
            <tr><th>Ethernet Connection:</th><td><?php echo $school['ethernet_connection']; ?></td></tr>
            <tr><th>Internet Connection:</th><td><?php echo $school['internet_connection']; ?></td></tr>
            <tr><th>Online Assessments:</th><td><?php echo $school['online_assessments']; ?></td></tr>
            <tr><th>Internal Storage:</th><td><?php echo $school['internal_storage']; ?></td></tr>
            <tr><th>Processor:</th><td><?php echo $school['processor']; ?></td></tr>
            <tr><th>RAM:</th><td><?php echo $school['ram']; ?></td></tr>
            <tr><th>Applications:</th><td><?php echo $school['applications']; ?></td></tr>
            <tr><th>Other Applications:</th><td><?php echo $school['other_apps']; ?></td></tr>
            <tr><th>Lecture Timings:</th><td><?php echo $school['lecture_timings']; ?></td></tr>
            <tr><th>Lab Timings:</th><td><?php echo $school['lab_timings']; ?></td></tr>
            <tr><th>Transportation Issues:</th><td><?php echo $school['transportation_issues']; ?></td></tr>
            <tr><th>Surrounding Environment:</th><td><?php echo $school['surrounding_environment']; ?></td></tr>
            <tr><th>Environment Cleanliness:</th><td><?php echo $school['environment_cleanliness']; ?></td></tr>
            <tr><th>Parking Space:</th><td><?php echo $school['parking_space']; ?></td></tr>
            <tr><th>Residential Areas Nearby:</th><td><?php echo $school['residential_areas']; ?></td></tr>
            <tr><th>Shortcomings:</th><td><?php echo $school['shortcomings']; ?></td></tr>
            <tr>
    <th>Lab Picture:</th>
    <td>
        <div class="image-zoom-container">
            <img src="uploads/<?php echo $school['lab_picture']; ?>" alt="Lab Picture" width="200">
            <button class="zoom-btn" onclick="zoomImage('uploads/<?php echo $school['lab_picture']; ?>')">Zoom</button>
        </div>
    </td>
</tr>
<tr>
    <th>Environment Picture:</th>
    <td>
        <div class="image-zoom-container">
            <img src="uploads/<?php echo $school['environment_picture']; ?>" alt="Environment Picture" width="200">
            <button class="zoom-btn" onclick="zoomImage('uploads/<?php echo $school['environment_picture']; ?>')">Zoom</button>
        </div>
    </td>
</tr>
<tr>
    <th>School Picture:</th>
    <td>
        <div class="image-zoom-container">
            <img src="uploads/<?php echo $school['school_picture']; ?>" alt="School Picture" width="200">
            <button class="zoom-btn" onclick="zoomImage('uploads/<?php echo $school['school_picture']; ?>')">Zoom</button>
        </div>
    </td>
</tr>
    </main>
    <footer>
        <p>&copy; 2024 IT Knowledge Centre. All rights reserved.</p>
    </footer>
    <script>
function zoomImage(imageSrc) {
    // Create an overlay
    const overlay = document.createElement('div');
    overlay.style.position = 'fixed';
    overlay.style.top = '0';
    overlay.style.left = '0';
    overlay.style.width = '100vw';
    overlay.style.height = '100vh';
    overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
    overlay.style.display = 'flex';
    overlay.style.alignItems = 'center';
    overlay.style.justifyContent = 'center';
    overlay.style.zIndex = '1000';
    overlay.style.cursor = 'pointer';

    // Create the enlarged image
    const img = document.createElement('img');
    img.src = imageSrc;
    img.style.maxWidth = '90vw';
    img.style.maxHeight = '90vh';
    img.style.objectFit = 'contain';
    img.style.border = '2px solid #fff';

    // Append the image to the overlay
    overlay.appendChild(img);

    // Close the overlay when clicked
    overlay.onclick = function() {
        document.body.removeChild(overlay);
    }

    // Append the overlay to the body
    document.body.appendChild(overlay);
}
</script>

</body>
</html>

<?php
$conn->close();
?>
    