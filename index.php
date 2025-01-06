<?php
session_start();
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sugandh</title>
    <link rel="stylesheet" href="/CSS/style.css" />
  </head>
  <body>
    <div id="container1" class="your-class">
      <div id="nav">
        <div id="logo">
          <img src="F:\xampp\htdocs\Sugandh/Images/Sugandh logo png.png" id="logoimg" alt="" />
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
        <div id="box1">
          <div id="intro">
            Welcome to our little corner of paradise, where flowers reign
            supreme and happiness is just a bouquet away.
          </div>
          <div id="exp"><button id="expbtn">Explore Now</button></div>
        </div>
        <div id="box2">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 0 500 500"
            id="moodboard1"
          >
            <image
              x="-150"
              y=""
              height="450"
            />
          </svg>
        </div>
      </div>
    </div>
    <div id="container3">
      <div id="forflex">
        <div id="conhead1">Our Services</div>
        <div id="forimg">
          <img src="/Images/wbgflower3-01.png" alt="" id="flowerimg1" />
        </div>
      </div>
      <div id="conhead2">This is what we do</div>
      <div id="cards">
        <div class="cardbg">
          <div class="cardmain"></div>
          <div class="cardstitle">Custom Bouquets</div>
          <div class="carddesccon">
            <div class="carddesc">
              Our custom flower bouquet service lets you express your unique
              style and sentiment with a personalized arrangement crafted just
              for you. With our premium blooms and expert florists, you can
              trust that your custom bouquet will be a stunning and
              unforgettable display of beauty and creativity.
            </div>
          </div>
        </div>
        <div class="cardbg">
          <div class="cardmain"></div>
          <div class="cardstitle">Pre-made Bouquets</div>
          <div class="carddesccon">
            <div class="carddesc">
              Experience the joy of fresh flowers with our pre-made flower
              bouquets, designed to bring beauty and happiness to any space.
              With a variety of colors and styles to choose from, our bouquets
              are perfect for every occasion, from birthdays to anniversaries to
              just because. Our expert florists carefully select the freshest
              blooms and arrange them with care to create stunning bouquets that
              will brighten up any room. Order now and discover the beauty of
              fresh flowers delivered right to your door.
            </div>
          </div>
        </div>
        <div class="cardbg">
          <div class="cardmain"></div>
          <div class="cardstitle" id="freedel">Free Delivery</div>
          <div id="cardstitle2">On oders above Rs.1000</div>
          <div class="carddesccon">
            <div class="carddesc">
              Enjoy free delivery on all orders above 1000 and indulge in the
              beauty of fresh flowers delivered right to your doorstep. Our
              expert florists hand-select the freshest blooms and carefully
              arrange them into beautiful bouquets that will brighten up any
              room. With free delivery on orders above 1000, it's never been
              easier to send a thoughtful gift or treat yourself to the magic of
              fresh flowers.
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="container4">
      <div id="forimg2">
        <img src="/Images/wbgflower1-01.png" alt="" id="flowerimg2" />
      </div>
      <div id="box4O1">
        <div id="headbox4O1">About Us</div>
        <div id="descbox4O1">
          At Sugandh, we believe that flowers have the power to bring joy and
          beauty to any space, and we are committed to delivering that
          experience to our customers. Our team of expert florists is dedicated
          to creating breathtaking bouquets that are tailored to your individual
          tastes and needs. We pride ourselves on our exceptional customer
          service and attention to detail, ensuring that every order is handled
          with care and precision. Thank you for choosing Sugandh for all of
          your floral needs.
        </div>
        <button id="btnbox4O1">Learn more</button>
      </div>
      <div id="box4O2">
        <img src="/Images/poppy flower-amico (1).png" alt="" id="poppy" />
      </div>
    </div>
    <div id="container5">
      <div id="formaincon5">
        <div id="headcon5">See what's popular</div>
        <div class="slider">
          <!-- fade css -->
          <div class="myslide fade">
            <div class="theslide">
              <div class="fortheslide">
                <div class="forsliderimg">
                  <div class="forsliderimg1"></div>
                  <div class="forsliderimgp">Price: Rs 499</div>
                </div>
                <div class="forsliderdesc">
                  <div class="forsliderhead1">Rose Bouquet</div>
                  <div class="forsliderdesc1">
                    Our stunning rose bouquet is a classic choice for any
                    occasion. Featuring the finest roses in a range of colors.,
                    this bouquet is sure to impress. Whether you are celebrating
                    a special occasion or just want to brighten someone’s day,
                    our rose bouquet is the perfect choice. Each stem is
                    hand-selected by our expert florists and arranged with care
                    to create a truly beautiful and timeless beauty. With its
                    elegant and sophisticated look, this rose bouquet is sure to
                    make a lasting impression.
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="myslide fade">
            <div class="theslide">
              <div class="fortheslide">
                <div class="forsliderimg">
                  <div class="forsliderimg1"></div>
                  <div class="forsliderimgp">Price: Rs 499</div>
                </div>
                <div class="forsliderdesc">
                  <div class="forsliderhead1">Lily Bouquet</div>
                  <div class="forsliderdesc1">
                    Our stunning rose bouquet is a classic choice for any
                    occasion. Featuring the finest roses in a range of colors.,
                    this bouquet is sure to impress. Whether you are celebrating
                    a special occasion or just want to brighten someone’s day,
                    our rose bouquet is the perfect choice. Each stem is
                    hand-selected by our expert florists and arranged with care
                    to create a truly beautiful and timeless beauty. With its
                    elegant and sophisticated look, this rose bouquet is sure to
                    make a lasting impression.
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="myslide fade">
            <div class="theslide">
              <div class="fortheslide">
                <div class="forsliderimg">
                  <div class="forsliderimg1"></div>
                  <div class="forsliderimgp">Price: Rs 499</div>
                </div>
                <div class="forsliderdesc">
                  <div class="forsliderhead1">Tulips Bouquet</div>
                  <div class="forsliderdesc1">
                    Our stunning rose bouquet is a classic choice for any
                    occasion. Featuring the finest roses in a range of colors.,
                    this bouquet is sure to impress. Whether you are celebrating
                    a special occasion or just want to brighten someone’s day,
                    our rose bouquet is the perfect choice. Each stem is
                    hand-selected by our expert florists and arranged with care
                    to create a truly beautiful and timeless beauty. With its
                    elegant and sophisticated look, this rose bouquet is sure to
                    make a lasting impression.
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="myslide fade">
            <div class="theslide">
              <div class="fortheslide">
                <div class="forsliderimg">
                  <div class="forsliderimg1"></div>
                  <div class="forsliderimgp">Price: Rs 499</div>
                </div>
                <div class="forsliderdesc">
                  <div class="forsliderhead1">Sunflower Bouquet</div>
                  <div class="forsliderdesc1">
                    Our stunning rose bouquet is a classic choice for any
                    occasion. Featuring the finest roses in a range of colors.,
                    this bouquet is sure to impress. Whether you are celebrating
                    a special occasion or just want to brighten someone’s day,
                    our rose bouquet is the perfect choice. Each stem is
                    hand-selected by our expert florists and arranged with care
                    to create a truly beautiful and timeless beauty. With its
                    elegant and sophisticated look, this rose bouquet is sure to
                    make a lasting impression.
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /fade css -->

          <!-- onclick js -->
          <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
          <a class="next" onclick="plusSlides(1)">&#10095;</a>

          <div class="dotsbox" style="text-align: center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
          </div>
          <!-- /onclick js -->
        </div>
      </div>
    </div>

    <div id="container6">
      <div id="amenities">
        <div id="headamm1">Why Choose Us?</div>
        <div id="headamm2">Our Advantages</div>
        <div id="headamm3">
          Everyday we work hard to make life of our clients better and happier
        </div>
        <div id="forflex">
          <div id="forimg">
            <img src="/Images/wbgflower4-01.png" alt="" id="flowerimg3" />
          </div>
        </div>
        <div id="amenitiesflex">
          <div class="rowflex">
            <div class="boxcard">
              <div class="fordescflex">
                <div class="imgamenity">
                  <!-- <img src="/Images/hygine.png" alt="" class="imgmainamenity" /> -->
                </div>
                <div class="headamenity">Quality</div>
              </div>
              <div class="descamenity" id="safety">
                All our professionals have more than 5 years of legal
                experience.
              </div>
            </div>
            <div class="boxcard">
              <div class="fordescflex">
                <div class="imgamenity">
                  <!-- <img
                    src="/Images/transport.png"
                    alt=""
                    class="imgmainamenity"
                  /> -->
                </div>
                <div class="headamenity">Support</div>
              </div>
              <div class="descamenity" id="transport">
                We offer you professional consultation of our specialist in 30
                minutes.
              </div>
            </div>
            <div class="boxcard">
              <div class="fordescflex">
                <div class="imgamenity">
                  <!-- <img src="/Images/wifi.png" alt="" class="imgmainamenity" /> -->
                </div>
                <div class="headamenity">Price</div>
              </div>
              <div class="descamenity" id="wifi">
                Our prices are budget friendly and fixed.
              </div>
            </div>
          </div>
          <div class="rowflex">
            <div class="boxcard">
              <div class="fordescflex">
                <div class="imgamenity">
                  <!-- <img
                    src="/Images/battery.png"
                    alt=""
                    class="imgmainamenity"
                  /> -->
                </div>
                <div class="headamenity">Delivery</div>
              </div>
              <div class="descamenity" id="power">
                We provide on time delivery. The courier comes at the exact
                time.
              </div>
            </div>
            <div class="boxcard">
              <div class="fordescflex">
                <div class="imgamenity">
                  <!-- <img
                    src="/Images/cigarttte.png"
                    alt=""
                    class="imgmainamenity"
                  /> -->
                </div>
                <div class="headamenity">Payment</div>
              </div>
              <div class="descamenity" id="smoke">
                We provide easy payment option. You can choose your preferred
                payment method.
              </div>
            </div>
            <div class="boxcard">
              <div class="fordescflex">
                <div class="imgamenity">
                  <!-- <img src="/Images/food.png" alt="" class="imgmainamenity" /> -->
                </div>
                <div class="headamenity">Photos</div>
              </div>
              <div class="descamenity" id="coffee">
                You can see your order before sending/receiving. Just send your
                email.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="container7">
      <div id="con6head1">What our clients say about us?</div>
      <div id="con6head2">Testimonials</div>
      <div id="borderbg">
        <div class="slider2">
          <!-- fade css -->
          <div class="myslide2 fade2">
            <div class="theslide2">
              <div class="fortheslide2">
                <div class="forsliderimg2">
                  <div class="forsliderimg2_1"></div>
                </div>
                <div class="forsliderdesc2">
                  <div class="forsliderhead1_1">Sarika Shukla</div>
                  <div class="forsliderhead1_3">Mumbai, India</div>
                  <div class="forsliderdesc1_2">
                    I’ve ordered from Sugandh multiple times and they never
                    disappoint. The quality of the flowers is always top-notch
                    and the arrangements are creative and unique. Plus, the
                    customer service is fantastic. I highly recommend Sugandh to
                    anyone looking for a reliable and high quality flower shop.
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="myslide2 fade2">
            <div class="theslide2">
              <div class="fortheslide2">
                <div class="forsliderimg2">
                  <div class="forsliderimg2_1"></div>
                </div>
                <div class="forsliderdesc2">
                  <div class="forsliderhead1_1">I am new</div>
                  <div class="forsliderhead1_3">Mumbai, India</div>
                  <div class="forsliderdesc1_2">
                    I’ve ordered from Sugandh multiple times and they never
                    disappoint. The quality of the flowers is always top-notch
                    and the arrangements are creative and unique. Plus, the
                    customer service is fantastic. I highly recommend Sugandh to
                    anyone looking for a reliable and high quality flower shop.
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="myslide2 fade2">
            <div class="theslide2">
              <div class="fortheslide2">
                <div class="forsliderimg2">
                  <div class="forsliderimg2_1"></div>
                </div>
                <div class="forsliderdesc2">
                  <div class="forsliderhead1_1">Part 3</div>
                  <div class="forsliderhead1_3">Mumbai, India</div>
                  <div class="forsliderdesc1_2">
                    I’ve ordered from Sugandh multiple times and they never
                    disappoint. The quality of the flowers is always top-notch
                    and the arrangements are creative and unique. Plus, the
                    customer service is fantastic. I highly recommend Sugandh to
                    anyone looking for a reliable and high quality flower shop.
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- /fade css -->

          <!-- onclick js -->
          <a class="prev2" onclick="plusSlides2(-1)">&#10094;</a>
          <a class="next2" onclick="plusSlides2(1)">&#10095;</a>
          <!-- /onclick js -->
        </div>
      </div>
    </div>
    <div id="container8">
      <div id="forimg4">
        <img src="/Images/wbgflower1-01.png" alt="" id="flowerimg4" />
      </div>
      <div id="boxcon801">
        <div id="con8head">Talk to our staff</div>
        <div id="con8desc">
          Trouble choosing your bouquet? Talk to our friendly customer service
          who can help you along your journey to finding your dream bouquet. We
          are a long line of passionate florists and believe that everyone has
          their right bouquet.
        </div>
        <div id="talk"><button id="talkbtn">Let's Talk</button></div>
      </div>
    </div>
    <div id="container9">
      <div id="box901">
        <div id="con9head">Connect with us</div>
        <form method="POST" action="index.php">
        <div id="forform">
          <label for="name" class="labels">Full name</label>
          <input type="text" name="name" id="name" class="fields" />
          <label for="number" class="labels">Phone number</label>
          <input type="text" name="number" id="number" class="fields" />
          <label for="email" class="labels">Email address</label>
          <input type="email" name="email" id="email" class="fields" />
        </div>
        <div id="submit"><button type="submit" id="submitbtn">Submit</button></div>
        </form>
      </div>
      <div id="box902"></div>
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
    <div class="modalcontainer">
      <div class="modal">
        <div id="modalbox1">
          <img src="" alt="" />
        </div>
        <div id="modalbox2">
          <div id="mb2_1">Welcome</div>
          <div id="mb2_2">Your floral journey begins here.</div>
          <div id="flow">
            <button id="login" class="formatbtn">Login</button>
            <button id="signup" class="formatbtn">SignUp</button>
            <button id="close" class="formatbtn">Close</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modalcontainer2">
      <div class="modal2">
        <p id="text">Fill your fields.</p>
        <button id="closefinal">Close</button>
      </div>
    </div>
    <script src="JS/app.js"></script>
  </body>
</html>



<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $name = $_POST['name'];
  $phone = $_POST['number'];
  $email = $_POST['email'];

  // Prepare email content
  $to = 'visit@sugandh.shop'; // Replace with your own email address
  $subject = "New Query";
  $message = "Name: $name\n";
  $message .= "Phone Number: $phone\n";
  $message .= "Email: $email\n";

  // Send email
  if (mail($to, $subject, $message)) {
    echo '<script>alert("Your query has been submitted. We will get back to you soon.");</script>';
    header("Location: index.php");
    exit();
  } else {
    echo '<script>alert("Failed to submit the query. Please try again later.");</script>';
    header("Location: index.php");
    exit();
  }
}
?>