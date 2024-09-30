<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Finder - Donor List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrapwebsite2.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>BLOOD BUDDY 2</title>

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        #h1find{
            text-align:center;

        }

    table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            max-width: 100%;
            overflow-x: auto;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #c0392b;
            color: white;
        }

</style>
<script src="https://cdn.tailwindcss.com"></script>
<script>
    function toggleMenu() {
        const menu = document.querySelector("#mobile-menu");
        menu.classList.toggle("hidden");
    }
</script>
</head>
<body class="bg-gray-100">
<nav class="bg-red-600 p-4">
      <div class="container mx-auto flex justify-between items-center">
          <a href="#" class="text-white text-2xl font-bold">BloodBuddy</a>
          
          <!-- Desktop Menu -->
          <div class="hidden md:flex space-x-4">
              <a href="home.html" class="text-white hover:text-red-200">Home</a>
              <a href="submit_donor.php" class="text-white hover:text-red-200">Donor Registration</a>
              <a href="find_donors.php" class="text-white hover:text-red-200">Find Blood</a>
              
              <a href="center.html" class="text-white hover:text-red-200">Blood Center</a>
              <a href="camps.html" class="text-white hover:text-red-200">Camps</a>
              <a href="comic.html" class="text-white hover:text-red-200">Comic</a>
              <a href="contact.html" class="text-white hover:text-red-200">Contact</a>
          </div>
          
          <!-- Mobile Menu Button -->
          <button class="md:hidden text-white" onclick="toggleMenu()">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
          </button>
      </div>
      
      <!-- Mobile Menu -->
      <div id="mobile-menu" class="hidden md:hidden mt-2">
          <a href="home.html" class="block text-white py-2 px-4 hover:bg-red-700">Home</a>
          <a href="submit_donor.php" class="block text-white py-2 px-4 hover:bg-red-700">Donor Registration</a>
          <a href="find_donors.php" class="block text-white py-2 px-4 hover:bg-red-700">Find Blood</a>
          <a href="center.html" class="block text-white py-2 px-4 hover:bg-red-700">Blood Center</a>
          <a href="camps.html" class="block text-white py-2 px-4 hover:bg-red-700">Camps</a>
          <a href="comic.html" class="block text-white py-2 px-4 hover:bg-red-700">Comic</a>
          <a href="contact.html" class="block text-white py-2 px-4 hover:bg-red-700">Contact</a>
           </div>
  </nav>
    
<?php

$host = "localhost"; 
$dbname = "blood_donors"; 
$username = "root"; 
$password = ""; 


$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $bloodType = $conn->real_escape_string($_POST['bloodType']);


    $sql = "SELECT full_name, dob, age, gender, email, phone, address, location, dnd FROM donors WHERE blood_type = '$bloodType'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h1 id='h1find'>Donors with Blood Type: " . htmlspecialchars($bloodType) . "</h1>";
        echo "<table border='1'>
                <tr>
                    <th>Name</th>
                    <th>Date Of Birth</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Location</th>
                    <th>Do Not Distrub Between</th>
                </tr>";

        
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["full_name"]) . "</td>
                    <td>" . htmlspecialchars($row["dob"]) . "</td>
                    <td>" . htmlspecialchars($row["age"]) . "</td>
                    <td>" . htmlspecialchars($row["gender"]) . "</td>
                    <td>" . htmlspecialchars($row["email"]) . "</td>
                    <td>" . htmlspecialchars($row["phone"]) . "</td>
                    <td>" . htmlspecialchars($row["address"]) . "</td>
                    <td>" . htmlspecialchars($row["location"]) . "</td>
                    <td>" . htmlspecialchars($row["dnd"]) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No donors found with blood type " . htmlspecialchars($bloodType) . ".</p>";
    }
}


$conn->close();
?>

    <footer>
            <div class="footer-content">
                <p>&copy; 2024 Blood Finder. All Rights Reserved.</p>
                <p>Follow us on:</p>
                <div class="social-icons">
                    <a href="#"><img src="images/facebook.png" alt="Facebook"></a>
                    <a href="#"><img src="images/twitter.png" alt="Twitter"></a>
                    <a href="#"><img src="images/instagram.png" alt="Instagram"></a>
                </div>
            </div>
    </footer>
    <script>
    // JavaScript to toggle the mobile menu
            const menuButton = document.getElementById('menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
    
            menuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        </script> 
</body>  
</html>