<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us</title>
    <link rel="stylesheet" href="/CSS/about.css" />
  </head>
  <body>
    <div id="container1" class="your-class">
      <div id="nav">
        <div id="logo">
          <img src="/Images/Sugandh logo png.png" id="logoimg" alt="" />
        </div>
        <div id="navitems">
          <div class="navitemstxt"><a href="/index.php">Home</div>
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
    </div>
    <div id="container2">
      <div id="forimg2">
        <img src="/Images/wbgflower1-01.png" alt="" id="flowerimg2" />
      </div>
      <div id="con2box201">
        <div id="con2head1">Unveiling Our Roots</div>
        <div id="con2head2">Crafting memories through flowers</div>
      </div>
      <div id="forimg2">
        <img src="/Images/wbgflower5-01.png" alt="" id="flowerimg2_1" />
      </div>
    </div>
    <div id="container3">
      <div id="con3_1">
        <div id="box3O1">
          <div id="headbox3O1">Our Vision</div>
          <div id="descbox3O1">
            At Sugandh, our vision is to spread happiness and create lasting
            memories through the beauty of flowers. We believe that every
            occasion deserves to be celebrated with exquisite floral
            arrangements that capture the essence of love, joy, and
            appreciation.
          </div>
        </div>
        <div id="box3O2"></div>
      </div>
    </div>
    <div id="container4">
      <div id="con4_1">
        <div id="box4O2"></div>
        <div id="box4O1">
          <div id="headbox4O1">Our Approach</div>
          <div id="descbox4O1">
            With a passion for creativity and a keen eye for detail, we approach
            floral design as an art form. We carefully select the finest blooms
            and combine them in unique and imaginative ways, showcasing the
            natural beauty of each flower. Our approach is driven by a
            commitment to excellence, craftsmanship, and the desire to exceed
            our customers' expectations.
          </div>
        </div>
      </div>
    </div>
    <div id="container3">
      <div id="con3_1">
        <div id="box3O1">
          <div id="headbox3O1">Our Process</div>
          <div id="descbox3O1">
            From the initial consultation to the final delivery, our process is
            built on personalized attention and meticulous care. We begin by
            listening to your vision, understanding your preferences, and taking
            into account the specific nuances of the occasion. Our experienced
            team of florists then works their magic, carefully selecting each
            flower, considering color palettes, textures, and scent
            combinations.
          </div>
        </div>
        <div id="box3O2"></div>
      </div>
    </div>
    <div id="container9">
      <div id="box901">
        <div id="con9head">Connect with us</div>
        <form method="POST" action="query.php">
        <div id="forform">
          <label for="name" class="labels">Full name</label>
          <input type="text" name="name" id="name" class="fields">
          <label for="number" class="labels">Phone number</label>
          <input type="text" name="number" id="number" class="fields">
          <label for="email" class="labels">Email address</label>
          <input type="email" name="email" id="email" class="fields">
        </div>
        <div id="submit"><button type="submit" id="submitbtn">Submit</button></div>
      </form>
      </div>
      <div id="box902">

      </div>
    </div>
    <div id="container10">
      <div id="box101"><img src="/Images/Sugandh logo png.png" alt="" id="box101logo"></div>
      <div id="box102">
        <div class="row">
          <img src="" alt="" class="ficons">
          <div class="fdesc">+91 1234567890</div>
        </div>
        <div class="row">
          <img src="" alt="" class="ficons">
          <div class="fdesc">+91 1234567890</div>
        </div>
      </div>
      <div id="box103">
        <div class="row">
          <img src="" alt="" class="ficons">
          <div class="fdesc">456, Hawa Mahal Road,Pink City,Jaipur - 302002,Rajasthan, India</div>
        </div>
      </div>
      <div id="box104">
        <div class="row">
          <img src="" alt="" class="ficons">
          <img src="" alt="" class="ficons">
          <img src="" alt="" class="ficons">
        </div>
      </div>
    </div>
  </body>
</html>



