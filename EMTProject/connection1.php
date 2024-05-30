<?php
// Replace these values with your actual database credentials
$host = 'localhost'; // Change this if your database is hosted elsewhere
$dbname = 'emtproject';
$username = 'root';
$password = '';

try {
    // Establish a connection to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO student_info (Fname, Mname, Lname, Street_Address, City_Address, Province_Address, BirthDate, Age, Gender, BirthPlace, Cnumber, Email, Mother_FirstName, Mother_LastName, Mother_Occupation, Father_FirstName, Father_LastName, Father_Occupation, EnrollmentDate, Esignature) 
            VALUES (:Fname, :Mname, :Lname, :Street_Address, :City_Address, :Province_Address, :BirthDate, :Age, :Gender, :BirthPlace, :Cnumber, :Email, :Mother_FirstName, :Mother_LastName, :Mother_Occupation, :Father_FirstName, :Father_LastName, :Father_Occupation, :EnrollmentDate, :Esignature)";
    
    $stmt = $pdo->prepare($sql);
    
    // Combine day, month, and year into a single date value
    $birthdate = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
    
    // Bind parameters to the prepared statement
    $stmt->bindParam(':Fname', $_POST['Fname']);
    $stmt->bindParam(':Mname', $_POST['Mname']);
    $stmt->bindParam(':Lname', $_POST['Lname']);
    $stmt->bindParam(':Street_Address', $_POST['Street_Address']);
    $stmt->bindParam(':City_Address', $_POST['City_Address']);
    $stmt->bindParam(':Province_Address', $_POST['Province_Address']);
    $stmt->bindParam(':BirthDate', $birthdate);
    $stmt->bindParam(':Age', $_POST['Age']);
    $stmt->bindParam(':Gender', $_POST['Gender']);
    $stmt->bindParam(':BirthPlace', $_POST['BirthPlace']);
    $stmt->bindParam(':Cnumber', $_POST['Cnumber']);
    $stmt->bindParam(':Email', $_POST['Email']);
    $stmt->bindParam(':Mother_FirstName', $_POST['Mother_FirstName']);
    $stmt->bindParam(':Mother_LastName', $_POST['Mother_LastName']);
    $stmt->bindParam(':Mother_Occupation', $_POST['Mother_Occupation']);
    $stmt->bindParam(':Father_FirstName', $_POST['Father_FirstName']);
    $stmt->bindParam(':Father_LastName', $_POST['Father_LastName']);
    $stmt->bindParam(':Father_Occupation', $_POST['Father_Occupation']);
    $stmt->bindParam(':EnrollmentDate', $_POST['EnrollmentDate']);
    $stmt->bindParam(':Esignature', $_POST['Esignature']);
    
    // Execute the prepared statement
    $stmt->execute();
    
    // Redirect to a success page or do something else upon successful insertion
    header("Location: success.php");
    exit();
    
} catch(PDOException $e) {
    // Handle database connection errors
    echo "Connection failed: " . $e->getMessage();
}

