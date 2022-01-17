<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>

    <link rel="stylesheet" href="/assets/css/main-style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="/assets/js/signup.js" type="module"></script>
</head>

<body>
    <!-- Navbar (sit on top) -->
    <div class="w3-top">
        <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
            <a href="index" class="w3-bar-item w3-button">Task Keeper</a>
            <!-- Right-sided navbar -->
            <div class="w3-right w3-hide-small">
                <a href="index" class="w3-bar-item w3-button">Home</a>
                <a href="login" class="w3-bar-item w3-button">Login</a>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
        <img class="w3-image" src="/image/Tasks.png" width="1600" height="800">
        <div class="w3-display-center w3-padding-large w3-opacity">
            <div class="centered" style="font-size: 48px;">Task management tools for you!</div>
        </div>
    </header>

    <hr>

    <!-- Signup Form -->
    <main>
        <div class="container">
            <h1><u>Sign up</u></h1>
            <p><i>Already have an account? <a href="login">Login</a></i></p>
            <p id="error-box" class="error-box" style="display: none;"></p>

            <form id="form">
                <label>E-mail address:<br><input type="email" name="email" required></label><br>
                <label>First name:<br><input type="text" name="first-name" required></label><br>
                <label>Last name:<br><input type="text" name="last-name" required></label><br>
                <label>Password:<br><input type="password" name="password" id="password-input" required></label><br>
                <label>Password (Confirm):<br><input type="password" name="password-confirmation" id="password-confirmation-input" required></label><br>
                <button type="submit" id="submit-button">Signup</button>
            </form>

        </div>
    </main>

    <hr>

    <!-- Footer -->

    <footer>
        <div class="container">
            <div class="information about">
                <h2>About Us</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tortor metus, commodo in rhoncus
                    accumsan, suscipit efficitur orci. Duis laoreet massa purus, suscipit lacinia urna maximus eu. Nam
                    commodo luctus luctus.</p>
                <ul class="social-icon">
                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                    <li><a href=""><i class="fa fa-instagram"></i></a></li>
                    <li><a href=""><i class="fa fa-youtube"></i></a></li>
                </ul>
            </div>

            <div class="information contact">
                <h2>Contact Us</h2>
                <ul class="info">
                    <li>
                        <span><i class="fa fa-map-marker"></i></span>
                        <span>Viện Nghiên cứu và Đào tạo Việt – Anh (VNUK)
                            <br>158A Lê Lợi, Hải Châu 1, Hải Châu, Đà Nẵng</span>
                    </li>
                    <li>
                        <span><i class="fa fa-phone"></i></span>
                        <p><a>+84 123 456 789</a>
                        </p>
                    </li>
                    <li>
                        <span><i class="fa fa-envelope"></i></span>
                        <p><a>quan.pham190208@vnuk.edu.vn</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</body>

</html>