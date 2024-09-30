<?php
$insert = false;

$host = "localhost"; 
$dbname = "blood_donors"; 
$username = "root";
$password = ""; 


$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $fullName = $conn->real_escape_string($_POST['fullName']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $age = $conn->real_escape_string($_POST['age']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $bloodType = $conn->real_escape_string($_POST['bloodType']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $location = $conn->real_escape_string($_POST['location']);
    $dnd = $conn->real_escape_string($_POST['dnd']);
    
    if (!empty($fullName) && !empty($dob) && !empty($age) && !empty($gender) && !empty($bloodType) && !empty($email) && !empty($phone) && !empty($address) && !empty($location) && !empty($dnd)) {
        
        $sql = "INSERT INTO donors (full_name, dob, age, gender, blood_type, email, phone, address, location, dnd) 
                VALUES ('$fullName', '$dob', '$age', '$gender', '$bloodType', '$email', '$phone', '$address', '$location', '$dnd')";
        
        if ($conn->query($sql) === TRUE) {
            // echo "Donor information saved successfully!";
            $insert = true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Please fill in all the fields.";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Buddy</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', serif;
            background-color: #f8f8f8;
            /* padding: 20px; */
        }
        #h2D {
            color: #c0392b;
            text-align: center;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], input[type="email"], input[type="tel"], select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #c0392b;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #e74c3c;
        }
        .message {
            color: green;
            margin-top: 15px;
            text-align: center;
        }
        #pTHX{
            text-align: center;
            font-family: "Caveat", cursive;
            font-optical-sizing: auto;
            font-weight: weight;
            font-style: normal;
            color:green;
        }
    </style>
</head>

<header class="bg-red-600 text-white p-4">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl md:text-3xl font-bold">Blood Buddy</h1>
            <nav class="hidden md:flex mt-2 space-x-10">
                <ul class="flex space-x-6">
                    <li><a href="home.html" class="hover:underline">Home</a></li>
                    <li><a href="submit_donor.php" class="hover:underline">Donor Registration </a></li>
                    <li><a href="center.html" class="hover:underline">Blood Center</a></li>
                    <li><a href="receiver.html" class="hover:underline">Find Blood </a></li>
                   
                    <li><a href="camps.html" class="hover:underline">Camps</a></li>
                    <li><a href="comic.html" class="hover:underline">Comic</a></li>
                    <li><a href="contact.html" class="hover:underline">Contact Us</a></li>
                </ul>
            </nav>
            <button id="menu-button" class="md:hidden flex items-center px-3 py-2 border rounded text-white border-white hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
        <div id="mobile-menu" class="md:hidden hidden mt-2">
            <ul class="flex flex-col space-y-4">
                <li><a href="home.html" class="hover:underline">Home</a></li>
                <li><a href="submit_donor.html" class="hover:underline">Donor Registration </a></li>
                <li><a href="center.html" class="hover:underline">Blood Center</a></li>
                <li><a href="receiver.html" class="hover:underline">Find Blood </a></li>
                
                <li><a href="camps.html" class="hover:underline">Camps</a></li>
                <li><a href="comic.html" class="hover:underline">Comic</a></li>
                <li><a href="contact.html" class="hover:underline">Contact Us</a></li>
            </ul>
        </div>
    </div>
</header>
    


 

    <form id="donorForm" action="submit_donor.php" method="POST">

        <?php 
        if($insert == true){
        echo "<p id='pTHX'> Thank you for submitting your form. Donor information saved successfully </p>";
        }
        ?>

        <h2 id="h2D">Personal Details</h2>
        
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" required>

        <label for="dob">Date Of Birth:</label>
        <input type="date" id="dob" name="dob" placeholder="Enter Your Date Of Birth" required>

        <label for="age">Age:</label>
        <input type="text" id="age" name="age" placeholder="Enter your age" required>

        <label for="gender">Gender:</label>
       <select id="gender" name="gender" required>
            <option value="">Select your gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label for="bloodType">Blood Type:</label>
        <select id="bloodType" name="bloodType" required>
            <option value="">Select your blood type</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
        </select>

        <h2>Contact Details</h2>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>

        <label for="Address">Address:</label>
        <input type="text" id="address" name="address" placeholder="Enter your address" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" placeholder="Enter your city or town" required>
    

        <h2>More Information</h2>
        <label for="dnd">Dont want to distrubed between (DND)</label>
        <select id="dnd" name="dnd" required>
            <option value="">Select DND</option>
            <option value="night">At Night</option>
            <option value="only weekend">Only Weekend</option>
            <option value="only weekdays">Only Weekdays</option>
        </select>

        <button type="submit">Save</button>
        <button type="reset">Reset</button>

        <div class="message" id="message"></div>
    </form>

    <script>
       
            document.getElementById('donorForm').reset();

            const menuButton = document.getElementById('menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
    
            menuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
    </script>

</body>
</html>
