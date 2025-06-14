<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Second Floor Rooms</title>
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
        <h1>Second Floor Rooms</h1>
    </div>
    
    <div class="container">
        <div class="box-container">
            <div class="box" onclick="window.location.href='12-201-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 201</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-202-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 202</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-203-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 203</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-204-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 204</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-205-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 205</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-206-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 206</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-207-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 207</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-208-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 208</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-209-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 209</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-210-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 210</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-211-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 211</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-212-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 212</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-213-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 213</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-214-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 214</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-215-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 215</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-216-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 216</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-217-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 217</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-218-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 218</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-219-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 219</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-220-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 220</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-221-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 221</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-222-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 222</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-223-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 223</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-224-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 224</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-225-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 225</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-226-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 226</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-227-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 227</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-228-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 228</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-229-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 229</h3>
                <p>Second floor classroom.</p>
            </div>
            <div class="box" onclick="window.location.href='12-230-class-time.php';" style="cursor: pointer;">
                <div class="icon"><i class="fas fa-door-open"></i></div>
                <h3>Room 230</h3>
                <p>Second floor classroom.</p>
            </div>
        </div>
    </div>

</body>
</html>