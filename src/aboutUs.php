<?php

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Avis Motors</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <style>
          /*Cover whole html*/
          html {
              height: 100%;
              max-width: 100%;
              overflow-x: hidden;
              /*padding: 0;
              margin: 0;*/
              box-sizing: border-box;
              font-family: "Poppins",sans-serif;
            }
            
            /*Cover whole body*/
            body {
              margin:0;
              padding:0;
              /*font-family: sans-serif;*/
              background: linear-gradient(to left, #63A4FF, #83EAF1); 
              background-size: cover;
              max-width: 100%;
            }
            
            /*HEADER*/
            
                /* Control main header */
                .header {
                  overflow: hidden;
                  background-color: #1d1d1d; /*Header background is 'black'*/
                  padding: 1px 1px; 
                  color:white; /*Header text color when NOT hover*/
                  font-family: Arial, Helvetica, sans-serif; /* Font family for header */
                }
            
                /* Style the header links */
                .header a {
                  float: left;
                  color: rgb(255, 253, 253);
                  text-align: center;
                  padding: 20px;
                  text-decoration: none;
                  font-size: 18px;
                  line-height: 25px;
                  border-radius: 4px;
                }
            
                /* Style the logo link (notice that we set the same value of line-height and font-size to prevent the header to increase when the font gets bigger */
                .header a.logo {
                  font-size: 25px;
                  font-weight: bold;
                }
            
                /* Hover change header background to 'white' & text to 'black' */
                .header a:hover {
                  background-color: white;
                  color: black;
                }
            
                /* Style the active/current link*/
                .header a.active {
                  color: white;
                }
            
                /* Float the link section to the right */
                .header-right {
                  float: right;
                }
            
                /* Add media queries for responsiveness - when the screen is 500px wide or less, stack the links on top of each other */
                @media screen and (max-width: 500px) {
                  .header a {
                    float: none;
                    display: block;
                    text-align: left;
                  }
                  .header-right {
                    float: none;
                  }
                }
            
                /*NOTE: NOT MUCH USE SINCE IT IS AN IMAGE NOT TEXT*/
                .header-logo {
                  font-family: Brush Script MT;
                  font-size: large;
                  font-stretch: expanded;
                }
            
                .center {
                  text-align: center;
                  color: azure;
                }

                /*SCROLLBAR*/

              ::-webkit-scrollbar {
                  width: 15px;
                  height: 10px;
                }
            
                ::-webkit-scrollbar-track { background: hsl(0, 0%, 100%); }
            
                ::-webkit-scrollbar-thumb {
                  /* background: hsla(219, 14%, 60%, 0.3); */
                  background: hsl(0, 0%, 30%);
                  border: 2px solid hsl(0, 0%, 100%);
                }
            
                /* ::-webkit-scrollbar-thumb:hover { background: hsla(219, 14%, 60%, 0.5); } */

                ::-webkit-scrollbar-thumb:hover { background: hsl(0, 0%, 40%); }

                /*FOOTER*/

              

          /*OUR TEAM SECTION*/

                .row {
                  display: flex;
                  flex-wrap: wrap;
                  padding: 2em 1em;
                  text-align: center;
                  /* gap: 0.5%; */
                  
                }

                .column {
                  /* width: 100%;
                  padding: 0.5em 0;

                  margin-bottom: 1em; */

                  flex-basis: 33.33%;
                }

                h1 {
                  width: 100%;
                  text-align: center;
                  font-size: 3.5em;
                  color: #1f003b;
                }

                .highlight{
                  background: linear-gradient(to left, #63A4FF, #83EAF1);
                  transition: font-size 0.2s ease-in-out; 
                }

                .highlight:hover{
                  color: darkblue;
                  font-size: 1.2em;
                }

                .highlight2{
                  /* background: linear-gradient(to left, #63A4FF, #83EAF1); */
                  transition: font-size 0.2s ease-in-out; 
                }

                .highlight2:hover{
                  color: white;
                  font-size: 1.2em;
                }

                .card {
                  box-shadow: 0 0 2.4em rgba(25, 0, 58, 0.1);
                  padding: 3.5em 1em;
                  border-radius: 0.6em;
                  color: #1f003b;
                  cursor: pointer;
                  transition: 0.3s;
                  background-color: #ffffff;
                }

                .card .img-container {
                  width: 8em;
                  height: 8em;
                  background-color: #a993ff;
                  padding: 0.5em;
                  border-radius: 50%;
                  margin: 0 auto 2em auto;
                }

                .card img {
                  width: 100%;
                  border-radius: 50%;
                }

                .card h3 {
                  font-weight: 500;
                }

                .card p {
                  font-weight: 300;
                  text-transform: uppercase;
                  margin: 0.5em 0 2em 0;
                  letter-spacing: 2px;
                }

                .icons {
                  width: 50%;
                  min-width: 180px;
                  margin: auto;
                  display: flex;
                  justify-content: space-between;
                }

                .card a {
                  text-decoration: none;
                  color: inherit;
                  font-size: 1.4em;
                }

                .card:hover {
                  background: linear-gradient(#6045ea, #8567f7);
                  color: #ffffff;
                }

                .card:hover .img-container {
                  transform: scale(1.15);
                }

                @media screen and (min-width: 768px) {
                  section {
                    padding: 1em 7em;
                  }
                }

                @media screen and (min-width: 992px) {
                  section {
                    padding: 1em;
                  }
                  .column {
                    flex: 0 0 33.33%;
                    max-width: 33.33%;
                    padding: 0;
                    margin: 0;
                  }
                }

                /* Paragraph & Text */
                h1:hover {
                    color: #6045ea;
                  }

                  .header-animation {
                    position: relative;
                    display: inline-block;
                  }

                .header-animation::before {
                    content: "";
                    position: absolute;
                    left: 0;
                    right: 0;
                    bottom: -5px;
                    height: 2px;
                    background-color: #6045ea;
                    transform: scaleX(0);
                    transition: transform 0.3s ease-out;
                    transform-origin: center;
                  }

                .header-animation:hover::before {
                    transform: scaleX(1);
                  }

          </style>
                  
                  <!-- favicon -->
                  <link rel="shortcut icon" href="Images/logo.jpg" type="image/svg+xml">

                  <!-- Font Awesome -->
                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

                  <!-- Google Font -->
                  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap"
                  rel="stylesheet"

                  <script src="script.js"></script>

    </head>

    <body>

    <?php include 'header.php';?>

  
        <div style="text-align: center;">
          <h1 class="header-animation">Welcome to Avis Motors</h1>
          <div class="highlight">
            <p>Where you can experience the thrill of driving a premium car without the hassle of ownership.</p>
            <p>We are dedicated to providing our clients with an <span class="highlight2">exceptional</span> and <span class="highlight2">unforgettable</span> experience,</p> 
            <p>whether it's for a special occasion or just a weekend getaway.</p>
            
          </div>
        </div>
        
    

        <br><br>

        <div style="text-align: center;">
          <h1 class="header-animation">We offer a wide range of vehicles</h1>
          <div class="highlight">
            <p>From <span class="highlight2">luxury cars</span> to <span class="highlight2">sports cars</span> to <span class="highlight2">classics</span>,</p>
            <p>all meticulously maintained to ensure maximum performance and safety.</p> 
            <p>We pride ourselves on delivering exceptional customer service,</p>
            <p>and our team is always ready to help you choose the perfect car for your needs.</p>
          </div>
        </div>

        <br><br>

        <div style="text-align: center;">
          <h1 class="header-animation">Our mission</h1>
          <div class="highlight">
            <p>To exceed our clients' expectations, and we achieve this by</p>
            <p>delivering a seamless rental experience.</p> 
            <p>From the moment you contact us to the moment you return the car, we strive to</p>
            <p>make every step of the process as <span class="highlight2">easy</span> and <span class="highlight2">enjoyable</span> as possible.</p>
          </div>
        </div>

        <br><br>

        <div style="text-align: center;">
          <h1 class="header-animation">Dress for the occasion</h1>
          <div class="highlight">
            <p>Whether you're looking to rent a luxury car for a wedding, a special occasion,</p>
            <p>or just to experience the thrill of driving a</p> 
            <p><span class="highlight2">high-end vehicle</span>, we have the perfect car for you.</p>
            <p>Our team is passionate about luxury cars and we are dedicated to helping our clients experience </p>
            <p>the ultimate driving experience.</p>
         </div>
        </div>

        <br><br>

        <section>
            <div class="row">
              <h1 class="header-animation">Our Team</h1>
            </div>
            
            <div class="row">
              <!-- Column 1-->
              <div class="column">
                <div class="card">
                  <div class="img-container">
                    <img src="Images/EddyWong.jpg" />
                  </div>
                  <h3>Eddy Wong</h3>
                  <p>Founder</p>
                  <div class="icons">
                    <a href="https://twitter.com/login?lang=en">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/login">
                      <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="https://github.com/login">
                      <i class="fab fa-github"></i>
                    </a>
                    <a href="https://mail.yahoo.com/">
                      <i class="fas fa-envelope"></i>
                    </a>
                  </div>
                </div>
              </div>

              <!-- Column 2-->
              <div class="column">
                <div class="card">
                  <div class="img-container">
                    <img src="Images/JasonHo.jpg" />
                  </div>
                  <h3>Jason Ho</h3>
                  <p>Chief Operation Officer</p>
                  <div class="icons">
                  <a href="https://twitter.com/login?lang=en">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/login">
                      <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="https://github.com/login">
                      <i class="fab fa-github"></i>
                    </a>
                    <a href="https://mail.yahoo.com/">
                      <i class="fas fa-envelope"></i>
                    </a>
                  </div>
                </div>
              </div>

              <!-- Column 3-->
              <div class="column">
                <div class="card">
                  <div class="img-container">
                    <img src="Images/AnthonyTan.jpg" />
                  </div>
                  <h3>Anthony Tan</h3>
                  <p>Chief Marketing Officer</p>
                  <div class="icons">
                  <a href="https://twitter.com/login?lang=en">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/login">
                      <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="https://github.com/login">
                      <i class="fab fa-github"></i>
                    </a>
                    <a href="https://mail.yahoo.com/">
                      <i class="fas fa-envelope"></i>
                    </a>
                  </div>
                </div>
              </div>

               <!-- Column 1, Row 2-->
               <div class="column">
                <div class="card">
                  <div class="img-container">
                    <img src="Images/MelindaGates.jpg" />
                  </div>
                  <h3>Melinda Gates</h3>
                  <p>Chief Actuarial & Product Officer</p>
                  <div class="icons">
                  <a href="https://twitter.com/login?lang=en">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/login">
                      <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="https://github.com/login">
                      <i class="fab fa-github"></i>
                    </a>
                    <a href="https://mail.yahoo.com/">
                      <i class="fas fa-envelope"></i>
                    </a>
                  </div>
                </div>
              </div>

              <!-- Column 2, Row 3-->
              <div class="column">
                <div class="card">
                  <div class="img-container">
                    <img src="Images/KellyPiquet.jpg" />
                  </div>
                  <h3>Kelly Piquet</h3>
                  <p>Head of Marketing</p>
                  <div class="icons">
                  <a href="https://twitter.com/login?lang=en">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/login">
                      <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="https://github.com/login">
                      <i class="fab fa-github"></i>
                    </a>
                    <a href="https://mail.yahoo.com/">
                      <i class="fas fa-envelope"></i>
                    </a>
                  </div>
                </div>
              </div>

              <!-- Column 3, Row 3-->
              <div class="column">
                <div class="card">
                  <div class="img-container">
                    <img src="Images/AlexYoong.jpg" />
                  </div>
                  <h3>Alex Yoong</h3>
                  <p>Head of Operations</p>
                  <div class="icons">
                  <a href="https://twitter.com/login?lang=en">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/login">
                      <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="https://github.com/login">
                      <i class="fab fa-github"></i>
                    </a>
                    <a href="https://mail.yahoo.com/">
                      <i class="fas fa-envelope"></i>
                    </a>
                  </div>
                </div>
              </div>

            </div>
          </section>

    </body>
</html>