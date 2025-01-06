const myslide = document.querySelectorAll('.myslide'),
  dot = document.querySelectorAll('.dot');
let counter = 1;
slidefun(counter);

let timer = setInterval(autoSlide, 8000);
function autoSlide() {
  counter += 1;
  slidefun(counter);
}
function plusSlides(n) {
  counter += n;
  slidefun(counter);
  resetTimer();
}
function currentSlide(n) {
  counter = n;
  slidefun(counter);
  resetTimer();
}
function resetTimer() {
  clearInterval(timer);
  timer = setInterval(autoSlide, 8000);
}

function slidefun(n) {

  let i;
  for (i = 0; i < myslide.length; i++) {
    myslide[i].style.display = "none";
  }
  for (i = 0; i < dot.length; i++) {
    dot[i].className = dot[i].className.replace(' active', '');
  }
  if (n > myslide.length) {
    counter = 1;
  }
  if (n < 1) {
    counter = myslide.length;
  }
  myslide[counter - 1].style.display = "block";
  dot[counter - 1].className += " active";
}

const myslide2 = document.querySelectorAll('.myslide2');
let counter2 = 1;
slidefun2(counter2);

let timer2 = setInterval(autoSlide2, 8000);
function autoSlide2() {
  counter2 += 1;
  slidefun2(counter2);
}
function plusSlides2(n2) {
  counter2 += n2;
  slidefun2(counter2);
  resetTimer2();
}
function currentSlide2(n2) {
  counter2 = n2;
  slidefun2(counter2);
  resetTimer2();
}
function resetTimer2() {
  clearInterval(timer2);
  timer2 = setInterval(autoSlide2, 8000);
}

function slidefun2(n2) {

  let i;
  for (i = 0; i < myslide2.length; i++) {
    myslide2[i].style.display = "none";
  }
  if (n2 > myslide2.length) {
    counter2 = 1;
  }
  if (n2 < 1) {
    counter2 = myslide2.length;
  }
  myslide2[counter2 - 1].style.display = "block";
}


let modalcontainer = document.querySelector(".modalcontainer");
let modalcontainer2 = document.querySelector(".modalcontainer2");
let logbtn = document.getElementById("logbtn");

if(logbtn!=null){
    logbtn.addEventListener("click", () => {
            modalcontainer.classList.add("show");
           });
}


let flow = document.getElementById("flow");
flow.innerHTML = `  
<button id="login" class="formatbtn">Login</button>
<button id="signup" class="formatbtn">SignUp</button>
<button id="close" class="formatbtn">Close</button>`;

let exit = document.getElementById("close");
let closefinal = document.getElementById("closefinal");
let modal = document.querySelector(".modal");
let modalbox1 = document.querySelector("#modalbox1");
let modalbox2 = document.querySelector("#modalbox2");
let target = document.getElementById("text");

let login = document.getElementById("login");
let log = document.getElementById("log");

let mb2_1 = document.getElementById("mb2_1")
let mb2_2 = document.getElementById("mb2_2")

login.addEventListener("click", () => {
  mb2_1.innerText = "Welcome Back!"
  mb2_2.innerText = "Login to a world of floral wonders."
  modalbox1.innerHTML=`<img src="/Images/Login page.png" alt="" id="loginimg" />`
  flow.innerHTML = `
  <form method="post" action="login.php" id="formlogin" >
  <div id="loginpart1">
  <label for="login-email" class="labels2">Email</label>
  <input type="text" name="login-email" id="login-email" class="fields2" />
  <label for="login-password" class="labels2">Password</label>
  <input type="password" name="login-password" id="login-password" class="fields2" />
  </div>
  <div id="loginpart2">
  <button id="logincon" class="formatbtn2">Login</button>
  <button id="close2" class="formatbtn2">Close</button>
  <a href="" id="forgotlink">Forgot password?</a>
  </div>
  </form>

  `;
  
logincon.addEventListener("click", (event) => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "get_session_data.php?_=" + Date.now(), true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      let response = JSON.parse(xhr.responseText);
      let email = response.email;
      let flag = response.flag;
    }
  };

  xhr.send();
});

  let exit2 = document.getElementById("close2");
  exit2.addEventListener("click", () => {
    modalcontainer.classList.remove("show");
    mb2_1.innerText = "Welcome";
    mb2_2.innerText = "Your floral journey begins here.";
    modalbox1.innerHTML=`<img src="/Images/Welcome page.png" alt="" id="welcome" />`
    flow.innerHTML = `<button id="login" class="formatbtn">Login</button>
    <button id="signup" class="formatbtn">SignUp</button>
    <button id="close" class="formatbtn">Close</button>`;

  });

});

let signup = document.getElementById("signup");
let loginpart1 = document.getElementById("loginpart1");
signup.addEventListener("click", () => {
  modal.style=`height:80vh; width:60vw; justify-content: space-around;`;
  modalbox1.style=`height:80vh`;
  modalbox1.innerHTML=`<img src="/Images/Sign up page.png" alt="" id="signupimg" />`
  modalbox2.style=`height:80vh`;
  flow.style=`height:60vh;`;
  mb2_1.innerText = "Create Account";
  mb2_2.innerText = "SignUp for a blooming experience.";
  flow.innerHTML = `
  <form method="post" action="register.php" id="formsignup">
  <div id="signuppart1">
  <div id="row1">
  <label for="register-username" class="labels2">Name</label>
  <input type="text" name="register-username" id="register-username" class="fields3" />
  <label for="register-email" class="labels2">Email</label>
  <input type="email" name="register-email" id="register-email" class="fields3" />
  <label for="register-phone" class="labels2">Phone Number</label>
  <input type="text" name="register-phone" id="register-phone" class="fields3" />
  <label for="register-dob" class="labels2">Date of Birth</label>
  <input type="date" name="register-dob" id="register-dob" class="fields3" />
  </div>
  <div id="row2">
  <label for="register-password" class="labels2">Password</label>
  <input type="password" name="register-password" id="register-password" class="fields3" />
  <label for="register-confirm-password" class="labels2">Confirm Password</label>
  <input type="password" name="register-confirm-password" id="register-confirm-password" class="fields3" />
  <label for="register-add" class="labels2">Address</label>
  <textarea name="register-add" id="register-add"></textarea>
  </div>
  </div>
  <div id="signuppart2">
  <button id="Signupcon" class="formatbtn2">SignUp</button>
  <button id="close3" class="formatbtn2">Close</button>
  <a href="" id="forgotlink">Already have an account?</a>
  </div>
  </form>
  `;
  let close3 = document.getElementById("close3");
  close3.addEventListener("click", () => {
    modalcontainer.classList.remove("show");
    modalbox1.innerHTML=`<img src="/Images/Welcome page.png" alt="" id="welcome" />`
  });
});

exit.addEventListener("click", () => {
  modalcontainer.classList.remove("show");
})


closefinal.addEventListener("click", () => {
  modalcontainer.classList.remove("show");
  modalcontainer2.classList.remove("show");
})

let orders = document.getElementById("orders");
let arrow = document.getElementById("arrow");
let ordercontainer = document.getElementById("ordercontainer");
let num = 0;

window.addEventListener("scroll", fun1);
function fun1() {
  ordercontainer.style.display = "none"
  num = 0;
}

orders.addEventListener("click", fun2)
arrow.addEventListener("click", fun2)
function fun2() {
  if (num == 1) {
    num = 0;
    ordercontainer.style.display = "none";
  } else {
    ordercontainer.style.display = "block";
    num = 1;
  }
};

let user = document.getElementById("user");
if(user!=null){
    user.addEventListener("click", () => {
      let profilecontainer = document.getElementById("profilecontainer");
      let numcheck = 0;
      window.addEventListener("scroll",()=>{
        profilecontainer.style.display = "none"
        numcheck = 0;
      });
      if (numcheck == 1) {
        numcheck = 0;
        profilecontainer.style.display = "none";
      } else {
        profilecontainer.style.display = "block";
        numcheck = 1;
       }
           });
}