<?php

require 'vendor/autoload.php';
include 'db.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Check if admin is logged in
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin.html');
    exit();
}

if (isset($_GET['id'])) {
    $school_id = $_GET['id'];

    // Fetch school data
    $sql = "SELECT * FROM schools WHERE id = '$school_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $school = $result->fetch_assoc();

        // Initialize Dompdf and set options
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        // Generate HTML content
        $html = '<h1>Survey Report</h1>';
        $html .= '<p><strong>School Name:</strong> ' . $school['school_name'] . '</p>';
        $html .= '<p><strong>School Registration Number:</strong> ' . $school['reg_no'] . '</p>';
        $html .= '<p><strong>Principal Name:</strong> ' . $school['principal_name'] . '</p>';
        $html .= '<p><strong>Contact Info:</strong> ' . $school['contact_info'] . '</p>';
        $html .= '<p><strong>CARES Scheme Beneficiary:</strong> ' . $school['cares_scheme'] . '</p>';
        $html .= '<p><strong>Roadname/area/colony:</strong> ' . $school['road_name'] . '</p>';
        $html .= '<p><strong>City/Town:</strong> ' . $school['city_town'] . '</p>';
        $html .= '<p><strong>Pincode:</strong> ' . $school['pincode'] . '</p>';
        $html .= '<p><strong>District:</strong> ' . $school['district'] . '</p>';
        $html .= '<p><strong>Principal Phone:</strong> ' . $school['principal_phone'] . '</p>';
        $html .= '<p><strong>Total Students:</strong> ' . $school['total_students'] . '</p>';
        $html .= '<p><strong>Total Systems:</strong> ' . $school['total_systems'] . '</p>';
        $html .= '<p><strong>System OS:</strong> ' . $school['system_os'] . '</p>';
        $html .= '<p><strong>System Manufacturer:</strong> ' . $school['system_manufacturer'] . '</p>';
        $html .= '<p><strong>Ethernet Connection:</strong> ' . $school['ethernet_connection'] . '</p>';
        $html .= '<p><strong>Internet Connection:</strong> ' . $school['internet_connection'] . '</p>';
        $html .= '<p><strong>Online Assessments Feasibility:</strong> ' . $school['online_assessments'] . '</p>';
        $html .= '<p><strong>Internal Storage:</strong> ' . $school['internal_storage'] . '</p>';
        $html .= '<p><strong>Processor:</strong> ' . $school['processor'] . '</p>';
        $html .= '<p><strong>RAM:</strong> ' . $school['ram'] . '</p>';
        $html .= '<p><strong>Applications:</strong> ' . $school['applications'] . '</p>';
        $html .= '<p><strong>Other Applications:</strong> ' . $school['other_apps'] . '</p>';
        $html .= '<p><strong>Lecture Timings:</strong> ' . $school['lecture_timings'] . '</p>';
        $html .= '<p><strong>Lab Timings:</strong> ' . $school['lab_timings'] . '</p>';
        $html .= '<p><strong>Transportation Issues:</strong> ' . $school['transportation_issues'] . '</p>';
        $html .= '<p><strong>Surrounding Environment:</strong> ' . $school['surrounding_environment'] . '</p>';
        $html .= '<p><strong>Environment Cleanliness:</strong> ' . $school['environment_cleanliness'] . '</p>';
        $html .= '<p><strong>Parking Space:</strong> ' . $school['parking_space'] . '</p>';
        $html .= '<p><strong>Residential Areas:</strong> ' . $school['residential_areas'] . '</p>';
        $html .= '<p><strong>Shortcomings:</strong> ' . $school['shortcomings'] . '</p>';

        // Include images if present using absolute URLs
        // if (!empty($school['lab_picture'])) {
        //     $html .= '<p><strong>Lab Picture:</strong> <img src="http://localhost/Itkcproj-main/uploads/' . $school['lab_picture'] . '" alt="Lab Picture" style="max-width: 300px;"></p>';
        // }
        // if (!empty($school['environment_picture'])) {
        //     $html .= '<p><strong>Environment Picture:</strong> <img src="http://localhost/Itkcproj-main/uploads/' . $school['environment_picture'] . '" alt="Environment Picture" style="max-width: 300px;"></p>';
        // }
        // if (!empty($school['school_picture'])) {
        //     $html .= '<p><strong>School Picture:</strong> <img src="http://localhost/Itkcproj-main/uploads/' . $school['school_picture'] . '" alt="School Picture" style="max-width: 300px;"></p>';
        // }

        // Full path to the project directory


        $projectRoot = 'http://localhost/itkcproj-main/uploads/';
        // $projectRoot = 'localhost/itkcproj-main/uploads/';

        // Include images if present using absolute file paths
        if (!empty($school['lab_picture'])) {
            $html .= '<p><strong>Lab Picture:</strong> <img src="' . $projectRoot . $school['lab_picture'] . '" alt="Lab Picture" style="max-width: 300px;"></p>';
        }
        if (!empty($school['environment_picture'])) {
            $html .= '<p><strong>Environment Picture:</strong> <img src="' . $projectRoot . $school['environment_picture'] . '" alt="Environment Picture" style="max-width: 300px;"></p>';
        }
        if (!empty($school['school_picture'])) {
            $html .= '<p><strong>School Picture:</strong> <img src="' . $projectRoot . $school['school_picture'] . '" alt="School Picture" style="max-width: 300px;"></p>';
        }
        // echo $projectRoot . $school['lab_picture'];
        // die();
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('survey_report.pdf', array("Attachment" => 1));

    } else {
        echo "No data found for the provided school ID.";
    }

} else {
    echo "Invalid request. No school ID provided.";
}


?>

