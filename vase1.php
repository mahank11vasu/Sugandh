<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Flower</title>
    <link rel="stylesheet" href="/CSS/vase.css" />
  </head>
  <body>
<div id="container1" class="your-class">
      <div id="nav">
        <div id="logo">
          <img src="/Images/Sugandh logo png.png" id="logoimg" alt="" />
        </div>
        <div id="navitems">
          <div class="navitemstxt"><a href="index.php">Home</a></a></div>
          <div id="forarrow">
            <div class="navitemstxt" id="orders">Shop</div>
            <div id="arrow"></div>
          </div>
          <div class="navitemstxt"><a href="/about.php">About Us</a></div>
          <div class="navitemstxt"><a href="/contact.php">Contact Us</a></div>
        </div>
        <div id="log">
          <img src="/Images/user.png" alt="" id="user">
      </div>
    </div>
    </div>
    <div id="container2">
                <div id="ordercontainer">
          <div id="flowerorder" class="itemorder">
            <a href="/flower1.php">Flowers</a>
          </div>
          <div id="vaseorder" class="itemorder">
            <a href="/vase1.php">Vases</a>
          </div>
          <div id="predefinedorder" class="itemorder">
            <a href="/premade1.php">Pre-made Bouquets</a>
         </div>
        </div>
        <div id="profilecontainer">
          <div id="profile1" class="profileitem">
            <a href="profile.php">Update Profile</a>
          </div>
          <div id="profile2" class="profileitem">
            <a href="/cart.php">Your Cart</a>
          </div>
          <div id="profile3" class="profileitem">
            <a href="manage_orders.php">Your Orders</a>
         </div>
        <div id="profile4" class="profileitem">
            <a href="logout.php">Logout</a>
        </div>

        </div>
      <div id="con2box1">
        <div id="flexcon2box1">
          <div class="fhead">Price</div>
             <div>
               <input type="radio" name="filter" id="low" class="fvalue" />Lowest to
                 Highest
             </div>
             <div>
               <input type="radio" name="filter" id="high" class="fvalue" />Highest to
                Lowest
              </div>
          <div class="fhead">Size</div>
          <div>
            <input type="radio" name="filter" id="small" class="fvalue" />Small
          </div>
          <div>
            <input type="radio" name="filter" id="medium" class="fvalue" />Medium
          </div>
          <div>
            <input type="radio" name="filter" id="big" class="fvalue" />Big
          </div>
        </div>
      </div>
      <div id="con2box2">
        <div class="slider">

          <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
          <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
    <div id="container3">
      <div id="con3flex">
        <div id="quanflex">
        <div id="quantity"></div>
        <div id="headcon3">Items added to your cart</div>
        </div>
        <button id="cart"><a href="/cart.php">Go to your cart</a></button>
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
          <img src="" alt="" class="ficons" />
          <div class="fdesc">+91 1234567890</div>
        </div>
        <div class="row">
          <img src="" alt="" class="ficons" />
          <div class="fdesc">+91 1234567890</div>
        </div>
      </div>
      <div id="box103">
        <div class="row">
          <img src="" alt="" class="ficons" />
          <div class="fdesc">
            456, Hawa Mahal Road,Pink City,Jaipur - 302002,Rajasthan, India
          </div>
        </div>
      </div>
      <div id="box104">
        <div class="row">
          <img src="" alt="" class="ficons" />
          <img src="" alt="" class="ficons" />
          <img src="" alt="" class="ficons" />
        </div>
      </div>
    </div>
    <script src="JS/vase.js"></script>
    <!--<script src="JS/addtocart.js"></script>-->
  </body>
</html>
