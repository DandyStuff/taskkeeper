<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>

    <link rel="stylesheet" href="/assets/css/main-style.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <!-- Navbar (sit on top) -->
    <div class="w3-top">
        <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
            <a href="#" class="w3-bar-item w3-button">Task Keeper</a>
            <!-- Right-sided navbar -->
            <div class="w3-right w3-hide-small">
                <a href="#" class="w3-bar-item w3-button">Home</a>
                <a href="#about" class="w3-bar-item w3-button">About</a>
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

    <!-- Page content -->
    <div class="w3-content" style="max-width:1100px">

        <!-- About -->
        <div class="w3-row w3-padding-64" id="about">
            <div class="w3-col m6 w3-padding-large w3-hide-small">
                <img src="/image/Task1.png" class="w3-round w3-image w3-opacity-min" alt="Table Setting" width="600"
                    height="750">
            </div>

            <div class="w3-col m6 w3-padding-large">
                <h1 class="w3-center">About Task Keeper</h1><br>
                <p class="w3-large">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In imperdiet lacinia ex, a
                    auctor arcu pellentesque sed. Praesent luctus vitae enim ut vulputate. Praesent finibus, mi sit amet
                    ultricies malesuada, nisl ex tempor erat, ut pulvinar lectus quam non tortor. Etiam sodales, erat eu
                    feugiat tincidunt, nulla magna laoreet turpis, fringilla tempus arcu dui imperdiet leo. Proin
                    pharetra, enim interdum posuere congue, turpis leo porttitor felis, ac euismod magna arcu nec justo.
                </p>
            </div>
        </div>

    </div>

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
                        <span>Vi???n Nghi??n c???u v?? ????o t???o Vi???t ??? Anh (VNUK)
                            <br>158A L?? L???i, H???i Ch??u 1, H???i Ch??u, ???? N???ng</span>
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