<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Page</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="image/ntc-logo-1.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Bungee+Tint&family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Winky+Sans:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<style>
    body {
        background-image: url('image/ntc.jpg');
        /* Replace with your image */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        /* Fix space issue */
        margin: 0;
        position: relative;
        /* Ensure overlay works properly */
        display: flex;
        flex-direction: column;

    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: -1;
    }


    .box {
        width: 100%;
        max-width: 350px;
        padding: 20px;
        background: white;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .box:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }

    .icon {
        font-size: 40px;
        color: #333;
    }

    .title {
        font-weight: bold;
        margin-top: 10px;
    }

    footer {
        size: 20px;
        width: 100%;
        color: white;
        padding: 10px 0;
    }

    .ntc {
        font-family: 'Winky sans', sans serif;
        font-size: 30px;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        body {
            height: auto;
            padding: 20px;
        }

        .box {
            max-width: 100%;
        }
    }
</style>

<body>
    <!-- Logo & Title -->
    <div class="container-fluid p-3 d-flex align-items-left justify-content-left">
        <a href="01-sign-in.php" style="cursor: pointer; color: inherit; text-decoration: none;">
        <img src="image\ntc-logo-1.png" alt="NTC Logo" class="img-fluid me-2" style="max-width: 75px;">
        <span class="text-white fw-bold fs-4 ntc">National Teachers College</span>
        </a>
    </div>

    <!-- Heading -->
    <div class="text-center text-white my-4">
        <h1 class="fw-bold">CAN'T SIGN IN?</h1>
        <p class="fs-5">There are a few reasons you might not be able to sign in.<br>Check the options below for possible solutions.</p>
    </div>

    <!-- Boxes Section -->
    <div class="container">
        <div class="row justify-content-center g-4">
            <div class="col-md-4 col-sm-12">
                <div class="box text-center" onclick="window.location.href='18-forgot-password.php'">
                    <div class="icon">🔒</div>
                    <div class="title">FORGOT PASSWORD?</div>
                    <p>Reset your password here if you’ve forgotten it.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="box text-center" onclick="window.location.href='19-forgot-student-number.php'">
                    <div class="icon">👤</div>
                    <div class="title">FORGOT STUDENT NUMBER?</div>
                    <p>You can request your student number to be sent to your linked Gmail here.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="box text-center" onclick="window.location.href='02-register.php'">
                    <div class="icon">👤</div>
                    <div class="title">No account yet? Sign up now!</div>
                    <p>Don't have an account yet? Sign up now by clicking here.</p>
                </div>
            </div>
        </div>
    </div>

    <br><br><br><br><br><br>

    <!-- Footer -->
    <footer class="text-center mt-5 p-3 text-white">
        <a href="privacy-policy.html" class="text-white me-3" style="text-decoration: none;">Privacy Policy</a> |
        <a href="terms-of-use.html" class="text-white mx-3" style="text-decoration: none;">Terms of Use</a> |
        <a href="bot-assistant\gizmo.php" class="text-white ms-3" style="text-decoration: none;">Support</a>
    </footer>

</body>

</html>