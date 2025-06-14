<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="homepage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sigmar&family=Winky+Sans:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="image/ntc-logo-1.png">

</head>
<style>
    /* Basic CSS Reset */

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Winky Sans", sans-serif;
    }

    /* Styling the navigation bar */
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
    }

    hr {
        border: none;
        height: 2px;
        background-color: #444;
        /* Dark line color */
        margin: 0;
        /* Adjust spacing if needed */
    }


    /* Main container */
    .container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 80vh;
        padding: 0 10%;
    }

    /* Left content */
    .left-content {
        width: 50%;
        margin-left: -60px;
        text-align: center;
    }

    .left-content h1 {
        color: #160893;
        font-size: 2.5rem;


    }

    .left-content p {
        font-size: 1.2rem;
        margin-top: 10px;
        color: #000000;
        font-weight: 500;

    }

    /* Right content (Box Grid) */
    .box-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 35px;
        width: 50%;
        height: 80%;

    }

    /* Individual Box */
    .box {
        background-color: #ffffff;
        padding: 20px;
        text-align: center;
        border-radius: 10px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        border: 2px solid #160893;
        /* Adds a border around the container */
        transition: 0.3s;
    }

    .box:hover {
        box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.5);
    }

    /* Icon Placeholder */
    .box .icon {
        font-size: 40px;
        margin-bottom: 10px;
    }

    .icon i {
        font-size: 40px;
        /* Adjust size */
        color: #160893;
        /* Change to your desired color */
    }


    /* Description Text */
    .box p {
        font-size: 1rem;
        color: #555;
        margin-top: 5px;
    }
    .bar {
        width: 30px;
        height: 5px;
        background-color: white;
        margin: 5px 0;
        transition: transform 0.3s ease;
        border-radius: 100px;

    }

    /* The X transformation */
    .bar1.toggle {
        transform: rotate(45deg) translate(7.5px, 7px);
    }

    .bar2.toggle {
        opacity: 0;
    }

    .bar3.toggle {
        transform: rotate(-45deg) translate(7px, -7px);
    }

    /* Button styles */
    .button {
        background-color: #4b024b;
        border: transparent;
        cursor: pointer;
        padding: 8px;
        border-radius: 10px;
    }

    a {
        text-decoration: none;
        color: inherit;
    }
    #menu {
        opacity: 0;
        transform: translateX(100%);
        transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
        position: fixed;
        top: 0px;
        right: 0px;
        z-index: 1;
    }

    #menu.show {
        opacity: 1;
        transform: translateX(0);
    }


    @media screen and (max-width: 768px) {
        .container {
            flex-direction: column;
            /* Stack elements vertically */
            align-items: center;
            /* Center align everything */
            padding: 20px;
            /* Reduce padding for smaller screens */
            height: auto;
            /* Adjust height */
        }

        .left-content {
            width: 100%;
            /* Allow it to take full width */
            text-align: center;
            /* Ensure text is centered */
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Centers text horizontally */
            justify-content: center;
            /* Centers text vertically */
            margin: 0 auto;
            /* Ensures it stays in the center */
            padding: 10px;
            /* Adds spacing */
        }

        .box-container {
            width: 100%;
            grid-template-columns: repeat(2, 1fr);
            /* 2 columns instead of 4 */
            gap: 10px;
        }

        .box {
            padding: 15px;
            /* Reduce padding for smaller screens */
            font-size: 14px;
            /* Adjust text size */
        }

        .icon i {
            font-size: 30px;
            /* Adjust icon size */
        }
    }

    h3 {
        text-transform: uppercase;
    }

    /* Even Smaller Screens (Phones) */
    @media screen and (max-width: 480px) {
        .box-container {
            grid-template-columns: repeat(1, 1fr);
            /* 1 column for small phones */
        }

        .box {
            width: 90%;
            /* Make boxes smaller */
            margin: auto;
            /* Center boxes */
        }
    }
</style>

<body>

    <div class="navbar">
        <a href="04-home.php">
            <img src="image\ntc-logo-1.png" alt="Logo">
            NATIONAL TEACHERS COLLEGE
        </a>
        
    </div>
    <!-- You can add more links here for other navigation items -->

    <hr>

    <!-- Other content of your webpage -->
    <div class="container">
        <!-- Left Side -->
        <div class="left-content">
            <h1>WELCOME, KAKAMPI!</h1>
            <p>Navigate through the boxes to find what you need. Enjoy your experience!</p>
        </div>
        <!-- Right Side (Boxes) -->
        <div class="box-container">
            <div class="box" onclick="window.location.href='06-profile.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-user"></i></div>
                <h3>Profile</h3>
                <p>Manage your student profile and details.</p>
            </div>
            <div class="box" onclick="window.location.href='05-attendance.php';" style="cursor: pointer;">
                <div class="icon"><i class="fa-solid fa-circle-check"></i></i></div>
                <h3>Attendance</h3>
                <p>Check your attendance records here.</p>
            </div>
            <div class="box" onclick="window.location.href='chat room/index.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-comments"></i></div>
                <h3>Chat Room</h3>
                <p>Connect and communicate with others.</p>
            </div>
            
            <div class="box" onclick="window.location.href='16-teachers.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <h3>Teacher</h3>
                <p>Check All Teachers Here</p>
            </div>
            
        </div>

</body>

</html>