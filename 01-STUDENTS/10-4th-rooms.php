<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fourth Floor Rooms</title>
    <link rel="stylesheet" href="homepage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sigmar&family=Winky+Sans:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
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

    .middle-content h1 {
        color: #160893;
        font-size: 2.5rem;


    }

    .middle-content p {
        font-size: 1.2rem;
        margin-top: 10px;
        color: #000000;
        font-weight: 500;

    }

    /* Right content (Box Grid) */
    .box-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 35px;
        width: 100%;
        height: 100%;
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
    .middle-content {
        text-align: center;
        padding: 20px;
        margin: 0;
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
            grid-template-columns: repeat(4, 1fr);
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
    <hr>

    <div class="middle-content">
        <h1>Fourth Floor Rooms</h1>
    </div>
    
    <div class="container">
        <div class="box-container">
            <div class="box" onclick="window.location.href='14-401-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 401</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-402-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 402</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-403-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 403</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-404-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 404</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-405-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 405</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-406-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 406</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-407-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 407</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-408-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 408</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-409-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 409</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-410-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 410</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-411-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 411</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-412-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 412</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-413-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 413</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-414-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 414</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-415-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 415</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-416-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 416</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-417-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 417</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-418-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 418</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-419-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 419</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-420-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 420</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-421-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 421</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-422-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 422</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-423-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 423</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-424-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 424</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-425-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 425</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-426-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 426</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-427-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 427</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-428-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 428</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-429-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 429</h3>
                <p>Fourth floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='14-430-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 430</h3>
                <p>Fourth floor classroom.</p>
            </div>
        </div>
    </div>

</body>
</html>