<?php

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Avis Motors</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="style.css">
        
        <!--Favicon-->

        <link rel="shortcut icon" href="Images/logo.jpg" type="image/svg+xml">

        <!--custom js link-->
        <script src="script.js"></script>

    </head>
    <style type="text/css">
h3 {
    font-size: 6em;
    color: transparent;
    animation: fadeIn 3s ease-in-out forwards;
}

@keyframes fadeIn {
    0% {
        color: transparent;
        font-size: 0em;
    }
    100% {
        color: #fff;
        font-size: 10em;
    }
}

.blur {
    position: relative;
    text-align: center;
    color: white;
}

.center {
    position: absolute;
    top: 15%;
    left: 50%;
    transform: translate(-50%, -50%);

}

@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0);
    }
    100% {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }
}
</style>
    <body>

          <?php include 'header.php';?>

          <!--Home Banner-->

          <div class="blur">
            <h1 class="appear">Welcome to Avis Motors</h1>
          <img src="Images/homeBanner.jpg" style="width: 100%; height:30%;" alt="Home Banner">
          <h3 class="center">Welcome to Avis Motors</h3>
          </div>

          <br><br><br><br><br><br><br>

          <div class="zoom">
            <div class="introduction">
              <section style="text-align: center;">
              <h2><u>Why Choose Us?</u></h2> <!--How to do jumplink-->
              </section>  
                <p>At Avis Motors, we take pride in offering an unmatched selection of high-end vehicles that are sure to impress.  
                    Our team of dedicated professionals is committed to providing you with exceptional customer service and ensuring that your rental 
                    experience is as seamless as possible. We offer competitive pricing and flexible rental terms, so you can enjoy the thrill of driving 
                    a luxury car without breaking the bank. Our online booking process is quick and easy, and we also offer convenient delivery options to 
                    save you time and hassle. 
                </p>
                
            </div>
          </div>
          <?php include 'footer.php';?>

    </body>
</html>

