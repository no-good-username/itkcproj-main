<?php
include 'db.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $school_name = $_POST['school_name'];
    $reg_no = $_POST['reg_no'];
    $principal_name = $_POST['principal_name'];
    $contact_info = $_POST['contact_info'];
    $cares_scheme = $_POST['cares_scheme'];
    $road_name = $_POST['road_name'];
    $city_town = $_POST['city_town'];
    $pincode = $_POST['pincode'];
    $district = $_POST['district'];
    $principal_phone = $_POST['principal_phone'];
    $total_students = $_POST['total_students'];
    $total_systems = $_POST['total_systems'];
    $system_os = implode(", ", $_POST['system_os']);
    $system_manufacturer = implode(", ", $_POST['system_manufacturer']);
    $ethernet_connection = $_POST['ethernet_connection'];
    $internet_connection = $_POST['internet_connection'];
    $online_assessments = $_POST['online_assessments'];
    $internal_storage = $_POST['internal_storage'];
    $processor = $_POST['processor'];
    $ram = $_POST['ram'];
    $applications = implode(", ", $_POST['applications']);
    $other_apps = $_POST['other_apps'];
    $lecture_timings = $_POST['lecture_timings'];
    $lab_timings = $_POST['lab_timings'];
    $transportation_issues = $_POST['transportation_issues'];
    $surrounding_environment = $_POST['surrounding_environment'];
    $environment_cleanliness = $_POST['environment_cleanliness'];
    $parking_space = $_POST['parking_space'];
    $residential_areas = $_POST['residential_areas'];
    $shortcomings = $_POST['shortcomings'];
    // Handle file uploads
    $lab_picture = $_FILES['lab_picture']['name'];
    $env_picture = $_FILES['env_picture']['name'];
    $school_picture = $_FILES['school_picture']['name'];
    
    $lab_tmp_name = $_FILES['lab_picture']['tmp_name'];
    $env_tmp_name = $_FILES['env_picture']['tmp_name'];
    $school_tmp_name = $_FILES['school_picture']['tmp_name'];
    
    $uploads_dir = 'uploads';
    $lab_target_file = $uploads_dir . '/' . basename($lab_picture);
    $env_target_file = $uploads_dir . '/' . basename($env_picture);
    $school_target_file = $uploads_dir . '/' . basename($school_picture);
    
    if (move_uploaded_file($lab_tmp_name, $lab_target_file) && 
    move_uploaded_file($env_tmp_name, $env_target_file) && 
    move_uploaded_file($school_tmp_name, $school_target_file)) {
        echo "Files have been uploaded successfully!";
    } else {
        echo "Failed to upload files.";
    }
    
    $sql = "INSERT INTO schools (school_name, reg_no, principal_name, contact_info, cares_scheme, road_name , city_town , pincode , district , principal_phone, total_students, total_systems, system_os, system_manufacturer, ethernet_connection, internet_connection, online_assessments, internal_storage, processor, ram, applications, other_apps, lecture_timings, lab_timings, transportation_issues, surrounding_environment, environment_cleanliness, parking_space, residential_areas, shortcomings, lab_picture, environment_picture, school_picture) 
            VALUES ('$school_name', '$reg_no', '$principal_name', '$contact_info', '$cares_scheme','$road_name' , '$city_town' , '$pincode' , '$district', '$principal_phone', '$total_students', '$total_systems', '$system_os', '$system_manufacturer', '$ethernet_connection', '$internet_connection', '$online_assessments', '$internal_storage', '$processor', '$ram', '$applications', '$other_apps', '$lecture_timings', '$lab_timings', '$transportation_issues', '$surrounding_environment', '$environment_cleanliness', '$parking_space', '$residential_areas', '$shortcomings', '$lab_picture', '$env_picture', '$school_picture')";

if ($conn->query($sql) === TRUE) {
    echo "Survey submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die();
    }

    // Generate PDF
    $options = new Options();
    $options->set('defaultFont', 'Courier');
    $dompdf = new Dompdf($options);

    $html = '<h1>Survey Report</h1>';
    $html .= '<p><strong>School Name:</strong> ' . $school_name . '</p>';
    $html .= '<p><strong>School Registration Number:</strong> ' . $reg_no . '</p>';
    $html .= '<p><strong>Principal Name:</strong> ' . $principal_name . '</p>';
    $html .= '<p><strong>Contact Info:</strong> ' . $contact_info . '</p>';
    $html .= '<p><strong>Is the school a beneficiary of the CARES SCHEME:</strong> ' . $cares_scheme . '</p>';
    $html .= '<p><strong>Roadname/area/colony:</strong> ' . $road_name . '</p>';
    $html .= '<p><strong>City/Town:</strong> ' . $city_town . '</p>';
    $html .= '<p><strong>Pincode:</strong> ' . $pincode . '</p>';
    $html .= '<p><strong>District:</strong> ' . $district . '</p>';
    $html .= '<p><strong>Principal Phone:</strong> ' . $principal_phone . '</p>';
    $html .= '<p><strong>Total Students:</strong> ' . $total_students . '</p>';
    $html .= '<p><strong>Total Systems:</strong> ' . $total_systems . '</p>';
    $html .= '<p><strong>System OS:</strong> ' . $system_os . '</p>';
    $html .= '<p><strong>System Manufacturer:</strong> ' . $system_manufacturer . '</p>';
    $html .= '<p><strong>Ethernet Connection:</strong> ' . $ethernet_connection . '</p>';
    $html .= '<p><strong>Internet Connection:</strong> ' . $internet_connection . '</p>';
    $html .= '<p><strong>Online Assessments:</strong> ' . $online_assessments . '</p>';
    $html .= '<p><strong>Internal Storage:</strong> ' . $internal_storage . '</p>';
    $html .= '<p><strong>Processor:</strong> ' . $processor . '</p>';
    $html .= '<p><strong>RAM:</strong> ' . $ram . '</p>';
    $html .= '<p><strong>Applications:</strong> ' . $applications . '</p>';
    $html .= '<p><strong>Other Apps:</strong> ' . $other_apps . '</p>';
    $html .= '<p><strong>Lecture Timings:</strong> ' . $lecture_timings . '</p>';
    $html .= '<p><strong>Lab Timings:</strong> ' . $lab_timings . '</p>';
    $html .= '<p><strong>Transportation Issues:</strong> ' . $transportation_issues . '</p>';
    $html .= '<p><strong>Surrounding Environment:</strong> ' . $surrounding_environment . '</p>';
    $html .= '<p><strong>Environment Cleanliness:</strong> ' . $environment_cleanliness . '</p>';
    $html .= '<p><strong>Parking Space:</strong> ' . $parking_space . '</p>';
    $html .= '<p><strong>Residential Areas:</strong> ' . $residential_areas . '</p>';
    $html .= '<p><strong>Shortcomings:</strong> ' . $shortcomings . '</p>';
    $html .= '<p><strong>Lab Picture:</strong> <img src="uploads/' . $lab_picture . '" alt="Lab Picture" style="max-width: 300px;"></p>';
    $html .= '<p><strong>Environment Picture:</strong> <img src="uploads/' . $env_picture . '" alt="Environment Picture" style="max-width: 300px;"></p>';
    $html .= '<p><strong>School Picture:</strong> <img src="uploads/' . $school_picture . '" alt="School Picture" style="max-width: 300px;"></p>';
    
    $projectRoot = 'http://localhost/itkcproj-main/uploads/';
    // $projectRoot = 'localhost/itkcproj-main/uploads/';
    
    // Include images if present using absolute file paths
    if (!empty($school['lab_picture'])) {
        $html .= '<p><strong>Lab Picture:</strong> <img src="' . $projectRoot . $lab_picture . '" alt="Lab Picture" style="max-width: 300px;"></p>';
    }
    if (!empty($school['environment_picture'])) {
        $html .= '<p><strong>Environment Picture:</strong> <img src="' . $projectRoot . $env_picture . '" alt="Environment Picture" style="max-width: 300px;"></p>';
    }
    if (!empty($school['school_picture'])) {
        $html .= '<p><strong>School Picture:</strong> <img src="' . $projectRoot . $school_picture . '" alt="School Picture" style="max-width: 300px;"></p>';
    }
    // echo "<br>skdhb";
    // die();
    
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('survey_report.pdf', array("Attachment" => 1));

    $conn->close();
}
?>

