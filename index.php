<?php
// Database connection
$host = 'localhost';
$user = 'root';
$pass = ''; // Adjust if needed
$dbname = 'faculty'; // Change to your DB name

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch faculty data
$query = "SELECT faculty_id, full_name, email, department_id, position, background, areas_of_expertise, teaching_workload, profile_picture, password_hash FROM faculty";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Faculty Listing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="css/test_css.css">
</head>


<body>


 <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a  class="navbar-brand" href="#home">
        <img id="logo_img" src="trimex.png" alt="Logo" width="200" height="90">
      </a>
      <!-- Custom toggler with dynamic icon -->
      <button 
        id="navbarToggler" 
        class="navbar-toggler" 
        type="button" 
        data-bs-toggle="collapse" 
        data-bs-target="#mynavbar"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i id="togglerIcon" class="bi bi-list"></i>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="mynavbar">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="#explore">Explore</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>


<div id="home" class="container-fluid header-section">

  <!-- 🎥 Background Video -->
  <video class="bg-video" autoplay muted loop playsinline>
    <source src="trimex.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <!-- 🌟 Foreground Content -->
  <div class="content">
    <h1 class="fw-bold">Meet our professors and faculty members</h1>
    <p>Explore our faculty and academic leaders</p>
  </div>
</div>




<section id="about" class="m-0 py-3">
   <div class="p-3 mt-5 m-0">
  <div class="container p-3 px-4 px-md-5   rounded bg-light">
   
    <!-- Title -->
    <div class="text-start mb-5 showbtn bg-light">
      <h2 class="fw-bold text-uppercase text-start">About Us</h2>
      <p class="text-muted">Want to learn more about our departments or connect with our faculty?</p>
    </div>

    <!-- Mission & Vision -->
    <div class="row mb-4 gy-4">
      <div class="col-md-6">
        <div class="p-4 border-start border-success border-3 bg-success bg-opacity-10 rounded-3 h-100">
          <h4 class="text-success fw-semibold">Our Mission</h4>
          <p class="text-muted mb-0">To provide quality education by fostering academic excellence, integrity, and inclusivity.</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="p-4 border-start border-primary border-3 bg-primary bg-opacity-10 rounded-3 h-100">
          <h4 class="text-primary fw-semibold">Our Vision</h4>
          <p class="text-muted mb-0">To be a leading institution known for outstanding faculty, innovative research, and transformative impact on society.</p>
        </div>
      </div>
    </div>

    <!-- Who We Are -->
    <div class="mb-4">
      <h4 class="text-primary fw-semibold">Who We Are</h4>
      <p class="text-muted">We are a team of dedicated educators and administrators working together to create a supportive and dynamic academic environment. Our faculty members bring diverse expertise and a passion for teaching that inspires students to reach their full potential.</p>
    </div>

    <!-- Our Story -->
    <div class="mb-4">
      <h4 class="text-primary fw-semibold">Our Story</h4>
      <p class="text-muted">Founded in <strong>2010</strong>, our institution has grown from a small department into a thriving academic community. Over the years, we’ve expanded our programs, facilities, and faculty to better serve our students and partners.</p>
    </div>

    <!-- Core Values -->
    <div class="mb-4">
      <h4 class="text-primary fw-semibold">Core Values</h4>
      <ul class="list-unstyled ms-3 text-muted">
        <li>✔️ Excellence in Teaching and Learning</li>
        <li>✔️ Innovation and Research</li>
        <li>✔️ Integrity and Accountability</li>
        <li>✔️ Inclusivity and Diversity</li>
        <li>✔️ Service to the Community</li>
      </ul>
    </div>

    <!-- CTA -->
    <div class="text-center mt-5">
      <p class="text-muted">Want to learn more about our departments or connect with our faculty?</p>
      <a href="login.php" class="btn btn-outline-primary px-4 py-2">Get in Touch</a>
    </div>
</div>
  </div>
</section>





   <section class=" p-3 pt-5 m-0 " id="explore">
    <div class="text-center mb-3 rounded bg-success mt-5 bg-opacity-10 p-3">
  <h2 class=" text-start ">Faculty Members</h2>


<div class="d-flex justify-content-end mb-3">
  <button id="toggleBtn">Show More</button>
</div>



    <div class="row g-4 mt-0 " id="facultyContainer">
        <?php
        $faculties = $conn->query("SELECT f.*, d.name AS department FROM faculty f JOIN department d ON f.department_id = d.department_id");
        $index = 0;
        while ($f = $faculties->fetch_assoc()):
            $img = $f['profile_picture'] ? "uploads/{$f['profile_picture']}" : "https://via.placeholder.com/100";
            $hiddenClass = $index >= 4 ? 'd-none extra-card' : ''; // Hide cards after 5
        ?>
        <div class="col-md-3 d-flex justify-content-center <?= $hiddenClass ?>">
            <div class="faculty-card text-center bg-white p-4 shadow-sm rounded-2 w-100" style="max-width: 300px;">
                <img src="<?= $img ?>" alt="Profile Picture" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 1rem;">
                <h5 class="fw-bold"><?= htmlspecialchars($f['full_name']) ?></h5>
                <p class="text-muted mb-1"><strong>Position:</strong> <?= htmlspecialchars($f['position']) ?></p>
                <p class="text-muted mb-1"><strong>Expertise:</strong> <?= htmlspecialchars($f['areas_of_expertise']) ?></p>
                <a href="login.php" class="btn btn-know-more mt-2">Know More</a>
            </div>
        </div>
        <?php
            $index++;
        endwhile;
        ?>
    </div>
</div>
  
    <div class="text-center p-3 mb-0 rounded bg-success  shadow-sm mt-5 bg-opacity-10 ">
  <h2 class=" text-center mt-2 mb-0">Departments</h2>


<div class="d-flex justify-content-end mb-3 d-none">
  <button id="toggleBtn">Show More</button>
</div>

<div class="row g-4">

    <?php
    $departments = $conn->query("SELECT department_id, name, dep_profile FROM department ");
    while ($d = $departments->fetch_assoc()):
        $img = $d['dep_profile'] ? "uploads/dep_profile/{$d['dep_profile']}" : "https://via.placeholder.com/300x150?text=No+Image";
    ?>
    <div class="col-md-3">
        <div class="card department-card overflow-hidden">
            <img src="<?= $img ?>" class="dep-img w-100">
            <div class="card-body text-center">
                <h5 class="card-title mb-2"><?= htmlspecialchars($d['name']) ?></h5>
                 <a href="login.php" class="btn btn-know-more mt-2">Show More</a>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>
</div>
    </section>
  



<section id="contact" class="bg-success bg-opacity-10 p-5 align-content-center mb-3">
  <div class="container bg-light mt-5 py-3 my-1 rounded">
    <div class="row justify-content-center">
      
      <!-- Contact Form Section -->
      <div class="col-md-8">
        <div class="d-flex align-items-center mb-4">
          <img src="https://cdn-icons-png.flaticon.com/512/561/561127.png" width="40" class="me-2" alt="Mail Icon">
          <h3 class="mb-0">Contact us</h3>
        </div>
        

      <!-- Contact Info -->
      <div class="col-md-4 mt-5 mt-md-0">
        <h5 class="fw-bold">Contacts info</h5>
        <p class="mb-1">Trojan bldg Poblacion Binan Laguna</p>
        <a href="mailto:support@trimexcolleges.edu.ph" class="text-decoration-none">support@trimexcolleges.edu.ph</a>
      </div>

        <form action="contact_process.php" method="POST">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="firstName" class="form-label">First name</label>
              <input type="text" class="form-control" id="firstName" name="first_name" placeholder="First name" required>
            </div>
            <div class="col-md-6">
              <label for="lastName" class="form-label">Last name</label>
              <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Last name" required>
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
            </div>
            <div class="col-md-6">
              <label for="phone" class="form-label">Phone number</label>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number">
            </div>
            <div class="col-12">
              <label for="message" class="form-label">Your message</label>
              <textarea class="form-control" id="message" name="message" rows="4" placeholder="Your message" required></textarea>
            </div>
          </div>

          <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Submit</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</section>


<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">User Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body d-flex flex-column flex-md-row align-items-center">
        <img src="profile.jpg" alt="Profile Picture" class="rounded-circle me-md-4 mb-3 mb-md-0" width="120" height="120">
        <div>
          <h4 class="fw-bold mb-1">Jhonel Q. Bua</h4>
          <p class="mb-1">Email: jhonel@example.com</p>
          <p class="mb-1">Department: Computer Science</p>
          <p class="mb-0">Position: Assistant Professor</p>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
      </div>

    </div>
  </div>
</div>


</div>
<footer class="footer">
  <div class="container-fluid">
    <div class="footer-row">
      
      <div class="footer-col">
        <h5>About Us</h5>
        <p>We are committed to providing the best service and products. Your satisfaction is our priority.</p>
      </div>

      <div class="footer-col">
        <h5>Quick Links</h5>
        <ul>
          <li><a href="#home">Home</a></li>
          <li><a href="#explore">Departments</a></li>
          <li><a href="#explore">Faculty</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h5>Contact Info</h5>
        <ul>
          <li>Email: info@example.com</li>
          <li>Phone: +1 234 567 890</li>
          <li>Address: 123 Main St, City, Country</li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom text-center">
      <p>&copy; <?= date('Y') ?> Your Company Name. All rights reserved.</p>
    </div>
  </div>
</footer>

<script>
    const toggleBtn = document.getElementById("toggleBtn");
    const extraCards = document.querySelectorAll(".extra-card");

    let isExpanded = false;

    toggleBtn.addEventListener("click", function () {
        isExpanded = !isExpanded;

        extraCards.forEach(card => {
            if (isExpanded) {
                card.classList.remove("d-none");
            } else {
                card.classList.add("d-none");
            }
        });

        toggleBtn.textContent = isExpanded ? "Show Less" : "Show More";
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const navbarToggler = document.getElementById('navbarToggler');
    const togglerIcon = document.getElementById('togglerIcon');
    const myNavbar = document.getElementById('mynavbar');
    const navLinks = document.querySelectorAll('#mynavbar .nav-link'); // Select all links inside the navbar

    // Listen for Bootstrap's collapse events
    myNavbar.addEventListener('show.bs.collapse', function() {
      togglerIcon.className = 'bi bi-x-lg'; // Change to "X" icon
    });

    myNavbar.addEventListener('hide.bs.collapse', function() {
      togglerIcon.className = 'bi bi-list'; // Revert to burger icon
    });

    // Close the navbar when a link is clicked
    navLinks.forEach(link => {
      link.addEventListener('click', function() {
        const bsCollapse = new bootstrap.Collapse(myNavbar);
        bsCollapse.hide(); // Collapse the navbar
      });
    });
  });
</script>


</body>
</html>
