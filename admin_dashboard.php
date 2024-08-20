<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin.html');
    exit;
}

include 'db.php';

// Default SQL query
$sql = "SELECT * FROM schools";

// Check if a district filter is set
if (isset($_GET['district']) && $_GET['district'] != '') {
    $district = $_GET['district'];
    $sql .= " WHERE district = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $district);
} else {
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITKC - Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<header>
        <img src="./itglogo.png" alt="Dashboard Image" class="dashboard-img">
        <nav>
            <img src="./itkclogo.png" alt="Logo" class="logo">
            <ul class="Navbar">
                <li><div class="dropdown">
                    <button class="dropbtn">Login
                      <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                      <a href="admin.html">Admin Login</a>
                      <a href="#">Supervisor Login</a>
                    </div></li>
                <li><a href="index.html">Home</a></li>
                <li><a href="index.html#about">About</a></li>
                <li><a href="coursestable.html">Courses</a></li>

                <li><a href="faq.html">FAQ</a></li>
                <li><a href="index.html#contact">Contact</a></li>
                <li><a href="admin_logout.php">Logout</a></li>
                
            </ul>
        </nav>
    </header>
    <main>
    <h1>Admin Dashboard</h1>
    
    <!-- Filter Form -->
    <form method="GET" action="">
        <label for="district">Filter by District:</label>
        <select name="district" id="district">
            <option value="">All Districts</option>
            <option value="North Goa" <?php echo isset($_GET['district']) && $_GET['district'] == 'North Goa' ? 'selected' : ''; ?>>North Goa</option>
            <option value="South Goa" <?php echo isset($_GET['district']) && $_GET['district'] == 'South Goa' ? 'selected' : ''; ?>>South Goa</option>
        </select>
        <button type="submit">Filter</button>
    </form>
    
    <!-- Table -->
    <table>
        <tr>
            <th>Name of the School</th>
            <th>District</th>
            <th>Survey Report</th>
            <th>PDF</th>
            <th></th>
        </tr>
        <?php
        include 'db.php';

        // Default SQL query
        $sql = "SELECT * FROM schools";
        
        // Check if a district filter is set
        if (isset($_GET['district']) && $_GET['district'] != '') {
            $district = $_GET['district'];
            $sql .= " WHERE district = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $district);
        } else {
            $stmt = $conn->prepare($sql);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['school_name'] . "</td>";
                echo "<td>" . $row['district'] . "</td>";
                echo "<td><a href='survey_report.php?id=" . $row['id'] . "'>View Report</a></td>";
                echo "<td><a href='generate_pdf.php?id=" . $row['id'] . "'>Generate PDF</a></td>";
                echo "<td><a href='delete_school.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this entry?\")'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found.</td></tr>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </table>
</main>

    <footer>
        <p>&copy; 2024 IT Knowledge Centre. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
