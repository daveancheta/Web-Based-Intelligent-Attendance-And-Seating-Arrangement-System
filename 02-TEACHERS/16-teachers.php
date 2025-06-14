<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Teachers</title>
  <link rel="stylesheet" href="homepage.css" />
  <link rel="icon" type="image/png" href="image/ntc-logo-1.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Poppins:wght@400;600&family=Sigmar&family=Winky+Sans:wght@400;600&display=swap"
    rel="stylesheet" />
     <link
        href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sigmar&family=Winky+Sans:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }
        .navbar {
        background-color: white;
        /* Dark background color */
        overflow: hidden;
        /* Clear floats */
        padding: 10px 20px;
        /* Padding inside the navbar */
    }

    /* Logo styling */
    .navbar img {
        height: 60px;
        /* Adjust the height of your logo */
        vertical-align: middle;
        /* Align vertically */
    }

    /* Text styling */
    .navbar a {
        float: left;
        /* Float text to the left */
        color: #160893;
        /* Text color */
        text-align: center;
        /* Center text vertically */
        padding: 14px 16px;
        /* Padding around text */
        text-decoration: none;
        /* Remove underline */
        font-size: 24px;
        /* Font size */
        font-weight: 600;
        font-family: 'Winky sans', sans-serif;
    }

    hr {
        border: none;
        height: 2px;
        background-color: #444;
        /* Dark line color */
        margin: 0;
        opacity: 1;
        /* Adjust spacing if needed */
    }

    body {
      background: #f8f9fc;
    }

    

    h3.page-title {
      text-align: center;
      margin: 40px 0 20px;
      color: #160893;
      font-size: 32px;
      font-weight: bold;
      text-transform: uppercase;
    }

    .subject-card {
      border: none;
      border-radius: 10px;
      overflow: hidden;
      transition: all 0.3s ease-in-out;
      background: #ffffff;
      box-shadow: 0 6px 20px rgba(22, 8, 147, 0.1);
    }

    .subject-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 25px rgba(22, 8, 147, 0.2);
    }

    .subject-header {
      background: linear-gradient(135deg, #160893, #4e44d2);
      padding: 20px;
      position: relative;
      color: white;
      min-height: 140px;
      transition: 0.3s;
    }

    .subject-title {
      font-size: 1.4rem;
      font-weight: 600;
      margin-bottom: 8px;
    }

    .teacher-name {
      font-weight: 500;
      margin-bottom: 5px;
      font-size: 1rem;
    }

    .teacher-image {
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      width: 80px;
      height: 80px;
      border-radius: 50%;
      border: 3px solid #ffffff;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .subject-card:hover .teacher-image {
      transform: translateY(-50%) scale(1.1);
    }

    .subject-body {
      padding: 15px 20px;
      background-color: #f9f9f9;
    }

    .class-section {
      font-weight: 500;
      margin: 6px 0;
      color: #333;
    }

    @media screen and (max-width: 768px) {
      .teacher-image {
        width: 60px;
        height: 60px;
      }

      .subject-title {
        font-size: 1.2rem;
      }
    }
  </style>
</head>

<body>
 <div class="navbar">
        <a href="04-home.php">
            <img src="image\ntc-logo-1.png" alt="Logo">
            NATIONAL TEACHERS COLLEGE
        </a>
        
    </div>
    <!-- You can add more links here for other navigation items -->

    <hr>

  <h3 class="page-title">Teachers</h3>

  <div class="container mb-5">
    <div class="row g-4">

      <!-- Card 1 -->
      <div class="col-md-6 col-lg-6">
        <div class="subject-card">
          <div class="subject-header">
            <h3 class="subject-title">DATABASE MANAGEMENT SYSTEM</h3>
            <p class="teacher-name">John Wick</p>
            <img src="https://variety.com/wp-content/uploads/2023/03/John-Wick-3.jpg?w=1000&h=562&crop=1" alt="John Wick"
              class="teacher-image" />
          </div>
          <div class="subject-body">
            <p class="class-section">2.3 BSIT</p>
            <p class="class-section">2.5 BSIT</p>
            <p class="class-section">2.9 BSIT</p>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-6 col-lg-6">
        <div class="subject-card">
          <div class="subject-header">
            <h3 class="subject-title">PYTHON PROGRAMMING W/LAB</h3>
            <p class="teacher-name">Tyler Ryke</p>
            <img
              src="https://hips.hearstapps.com/hmg-prod/images/screen-shot-2023-06-09-at-12-58-57-pm-64835a56f39f8.png"
              alt="Tyler Ryke" class="teacher-image" />
          </div>
          <div class="subject-body">
            <p class="class-section">2.3 BSIT</p>
            <p class="class-section">2.5 BSIT</p>
            <p class="class-section">2.9 BSIT</p>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-6 col-lg-6">
        <div class="subject-card">
          <div class="subject-header">
            <h3 class="subject-title">SYSTEM ANALYSIS AND DESIGN W/LAB</h3>
            <p class="teacher-name">Mike Lowrey</p>
            <img
              src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbEfLJIk95ppZ-e3IRUcP4Y1K9yH2jd-tXRw&s"
              alt="Mike Lowrey" class="teacher-image" />
          </div>
          <div class="subject-body">
            <p class="class-section">2.3 BSIT</p>
            <p class="class-section">2.5 BSIT</p>
            <p class="class-section">2.9 BSIT</p>
          </div>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="col-md-6 col-lg-6">
        <div class="subject-card">
          <div class="subject-header">
            <h3 class="subject-title">BIBLE STUDY: THE IMPORTANCE OF PAGES</h3>
            <p class="teacher-name">Reggie MacDonald</p>
            <img src="https://i.ytimg.com/vi/81_YSLDSuMI/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLCIggB9Ov2QtOsgk9jEQ_9VbOc92w" alt="Reggie MacDonald"
              class="teacher-image" />
          </div>
          <div class="subject-body">
            <p class="class-section">2.3 BSIT</p>
            <p class="class-section">2.5 BSIT</p>
            <p class="class-section">2.9 BSIT</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</body>

</html>
