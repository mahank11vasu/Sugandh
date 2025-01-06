<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
    <link rel="stylesheet" href="/CSS/contact.css" />
  </head>
  <body>
    <div id="container1" class="your-class">
      <div id="nav">
        <div id="logo">
          <img src="/Images/Sugandh logo png.png" id="logoimg" alt="" />
        </div>
        <div id="navitems">
          <div class="navitemstxt">Home</div>
          <div id="forarrow">
            <div class="navitemstxt" id="orders">Shop</div>
            <div id="arrow"></div>
          </div>
          <div class="navitemstxt"><a href="/about.php">About Us</a></div>
          <div class="navitemstxt"><a href="/contact.php">Contact Us</a></div>
        </div>
        <div id="log">
          <?php if (isset($_SESSION['email'])) {
            if ($_SESSION['isAdmin']) {
                 // Redirect the admin user to admin.php
                 header("Location: admin.php");
                 exit();
            } else {
          ?>
          <img src="/Images/user.png" alt="" id="user">
        <?php
         }
       } else {
       ?>
       <button id="logbtn">Log In/Sign Up</button>

      <?php } ?>
      </div>
      </div>
      <div id="con1box2">
          <div id="intro">Get in touch</div>
          <div id="intro2">Don't be shy. Give us a call or drop us a line.</div>
      </div>
    </div>
    <div id="container3">
        <div id="con3box2">
            <div id="con3box2_1">
                <div id="con3box2_1head">Contact Us</div>
                <div id="box103">
                    <div class="row">
                      <img src="/Images/location.png" alt="" class="ficons">
                      <div class="fdesc">456, Hawa Mahal Road,Pink City,Jaipur - 302002,Rajasthan, India</div>
                    </div>
                </div>
                <div class="row">
                    <img src="/Images/call.png" alt="" class="ficons">
                    <div class="fdesc">+91 1234567890</div>
                </div>
                <div class="row">
                    <img src="/Images/call.png" alt="" class="ficons">
                    <div class="fdesc">+91 1234567890</div>
                </div>
                <div id="box104">
                    <div class="row">
                      <img src="/Images/facebook.png" alt="" class="ficons">
                      <img src="/Images/whatsapp.png" alt="" class="ficons">
                      <img src="/Images/instagram.png" alt="" class="ficons">
                    </div>
                </div>
            </div>
            <div id="con3box2_2">
                <form method="POST" action="query.php" id="forform">
                    <label for="name" class="labels">Full name</label>
                    <input type="text" name="name" id="name" class="fields">
                    <label for="number" class="labels">Phone number</label>
                    <input type="text" name="number" id="number" class="fields">
                    <label for="email" class="labels">Email address</label>
                    <input type="email" name="email" id="email" class="fields">
                  <div id="submit"><button id="submitbtn">Submit</button></div>
                </form>
            </div>
            </div>
            </div>
        </div>
    </div>
    <div id="container10">
      <div id="box101">
        <img src="/Images/Sugandh logo png.png" alt="" id="box101logo" />
      </div>
      <div id="box102">
        <div class="row">
          <img src="/Images/call.png" alt="" class="ficons" />
          <div class="fdesc">+91 1234567890</div>
        </div>
        <div class="row">
          <img src="/Images/call.png" alt="" class="ficons" />
          <div class="fdesc">+91 1234567890</div>
        </div>
      </div>
      <div id="box103">
        <div class="row">
          <img src="/Images/location.png" alt="" class="ficons" />
          <div class="fdesc">
            456, Hawa Mahal Road,Pink City,Jaipur - 302002,Rajasthan, India
          </div>
        </div>
      </div>
      <div id="box104">
        <div class="row">
          <img src="/Images/facebook.png" alt="" class="ficons" />
          <img src="/Images/whatsapp.png" alt="" class="ficons" />
          <img src="/Images/instagram.png" alt="" class="ficons" />
        </div>
      </div>
    </div>
    <script src="JS/app.js"></script>
  </body>
</html>
