let container2 = document.getElementById("container2");
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
}

let user = document.getElementById("user");
let profilecontainer = document.getElementById("profilecontainer");
let numcheck = 0;
window.addEventListener("scroll",()=>{
    profilecontainer.style.display = "none"
    numcheck = 0;
});
user.addEventListener("click", () => {
   if (numcheck == 1) {
        numcheck = 0;
        profilecontainer.style.display = "none";
      } else {
        profilecontainer.style.display = "block";
        numcheck = 1;
       }
});

container2.addEventListener("click",()=>{
        ordercontainer.style.display = "none";
        profilecontainer.style.display = "none";
        numcheck = 0;
        num = 0;
})