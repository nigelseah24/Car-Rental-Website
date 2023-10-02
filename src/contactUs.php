<?php
session_start();

include("connection.php");
include("functions.php");

  // Check if the form has been submitted
  if ($_SERVER['REQUEST_METHOD'] == "POST") {

      // Get the form data
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $message = $_POST['message'];

      // Create the SQL query
      $sql = "INSERT INTO `Customer Enquiry` (customer_number, customer_name, customer_email, message) VALUES ('$phone', '$name', '$email', '$message')";
      $result = mysqli_query($con, $sql);
      echo"<script>alert('Your message has been sent!');</script>";
  }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Avis Motors</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!--favicon-->
        <link rel="shortcut icon" href="Images/logo.jpg" type="image/svg+xml">

        <script>
          function resetForm() {
              document.getElementById("contact-form").reset();
          }

          document.getElementById("contact-form").addEventListener("submit", function(event) {
              event.preventDefault();
              // You can add your form submission logic here
              alert("Form submitted successfully!");
          });
        </script>

        <style>
          /*Cover whole html*/
html {
    height: 100%;
    max-width: 100%;
    overflow-x: hidden;
  }
  
  /*Cover whole body*/
  body {
    margin:0;
    padding:0;
    font-family: sans-serif;
    background-image: url(Images/homeBanner2.jpg);
    max-height: 100%;
    background-size: cover;
    max-width: 100%;
    /* font-size: 12px; */
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

      /*SCROLLBAR*/

    ::-webkit-scrollbar {
        width: 15px;
        height: 10px;
      }
  
      ::-webkit-scrollbar-track { background: hsl(0, 0%, 100%); }
  
      ::-webkit-scrollbar-thumb {
        background: hsl(0, 0%, 30%);
        border: 2px solid hsl(0, 0%, 100%);
      }
  
      ::-webkit-scrollbar-thumb:hover { background: hsl(0, 0%, 40%); }

      /*CONTACT US FORM*/

      *, *:before, *:after {
        box-sizing: border-box;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }

      button {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }

      input {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .background {
        display: flex;
        min-height: 100vh;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .container {
        flex: 0 1 700px;
        margin: auto;
        padding: 10px;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .screen {
        position: relative;
        background: #3e3e3e;
        border-radius: 15px;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .screen:after {
        content: '';
        display: block;
        position: absolute;
        top: 0;
        left: 20px;
        right: 20px;
        bottom: 0;
        border-radius: 15px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, .4);
        z-index: -1;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .screen-header {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        background: #4d4d4f;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .screen-header-left {
        margin-right: auto;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .screen-header-button {
        display: inline-block;
        width: 8px;
        height: 8px;
        margin-right: 3px;
        border-radius: 8px;
        background: white;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .screen-header-button.close {
        background: #ed1c6f;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .screen-header-button.maximize {
        background: #e8e925;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .screen-header-button.minimize {
        background: #74c54f;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .screen-header-right {
        display: flex;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .screen-header-ellipsis {
        width: 3px;
        height: 3px;
        margin-left: 2px;
        border-radius: 8px;
        background: #999;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .screen-body {
        display: flex;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .screen-body-item {
        flex: 1;
        padding: 50px;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .screen-body-item.left {
        display: flex;
        flex-direction: column;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .app-title {
        display: flex;
        flex-direction: column;
        position: relative;
        color: #ea1d6f;
        font-size: 26px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .app-title:after {
        content: '';
        display: block;
        position: absolute;
        left: 0;
        bottom: -10px;
        width: 25px;
        height: 4px;
        background: #ea1d6f;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .app-contact {
        margin-top: auto;
        color: #888;
        font-size: 11px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .app-form-group {
        margin-bottom: 15px;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .app-form-group.message {
        margin-top: 40px;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .app-form-group.buttons {
        margin-bottom: 0;
        text-align: right;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .app-form-control {
        width: 100%;
        padding: 10px 0;
        background: none;
        border: none;
        border-bottom: 1px solid #666;
        color: #ddd;
        font-size: 14px;
        text-transform: uppercase;
        outline: none;
        transition: border-color .2s;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .app-form-control::placeholder {
        color: #666;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .app-form-control:focus {
        border-bottom-color: #ddd;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .app-form-button {
        background: none;
        border: none;
        color: #ea1d6f;
        font-size: 14px;
        cursor: pointer;
        outline: none;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .app-form-button:hover {
        color: #b9134f;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .credits {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        color: #ffa4bd;
        font-family: 'Roboto Condensed', sans-serif;
        font-size: 16px;
        font-weight: normal;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .credits-link {
        display: flex;
        align-items: center;
        color: #fff;
        font-weight: bold;
        text-decoration: none;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      .dribbble {
        width: 20px;
        height: 20px;
        margin: 0 5px;
        font-size: 12px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 1.4px;
      }
      
      @media screen and (max-width: 520px) {
        .screen-body {
          flex-direction: column;
        }
      
        .screen-body-item.left {
          margin-bottom: 30px;
        }
      
        .app-title {
          flex-direction: row;
        }
      
        .app-title span {
          margin-right: 12px;
        }
      
        .app-title:after {
          display: none;
        }
      }
      
      @media screen and (max-width: 600px) {
        .screen-body {
          padding: 40px;
        }
      
        .screen-body-item {
          padding: 0;
        }
      }
        </style>

    </head>

    <body>

    <?php include 'header.php';?>

            <div class="background">
            <div class="container">
              <div class="screen">
                <div class="screen-header">
                  <div class="screen-header-left">
                    <div class="screen-header-button close"></div>
                    <div class="screen-header-button maximize"></div>
                    <div class="screen-header-button minimize"></div>
                  </div>
                  <div class="screen-header-right">
                    <div class="screen-header-ellipsis"></div>
                    <div class="screen-header-ellipsis"></div>
                    <div class="screen-header-ellipsis"></div>
                  </div>
                </div>
                <div class="screen-body">
                  <div class="screen-body-item left">
                    <div class="app-title">
                      <span>CONTACT</span>
                      <span>US</span>
                    </div>
                    <div class="app-contact">CONTACT INFO : +60 18 514 928 595</div>
                  </div>
                  <form class="screen-body-item" id="contact-form" method="post">
                    <div class="app-form">
                        <div class="app-form-group">
                            <input class="app-form-control" type="text" placeholder="NAME" name="name">
                        </div>
                        <div class="app-form-group">
                            <input class="app-form-control" type="email" placeholder="EMAIL" name="email">
                        </div>
                        <div class="app-form-group">
                            <input class="app-form-control" type="tel" placeholder="CONTACT NO" name="phone">
                        </div>
                        <div class="app-form-group message">
                            <textarea class="app-form-control" placeholder="MESSAGE" name="message"></textarea>
                        </div>
                        <div class="app-form-group buttons">
                            <button class="app-form-button" type="reset" onclick="resetForm()">CANCEL</button>
                            <button class="app-form-button" type="submit">SEND</button>
                        </div>
                    </div>
                </form>
                </div>
              </div>
            </div>
          </div>

    </body>
</html>