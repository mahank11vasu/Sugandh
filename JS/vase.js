fetch('vase.php', {
  method: 'get',
}).then(function(response) {
  if (response.status >= 200 && response.status < 300) {
    return response.json();
  }
  throw new Error(response.statusText);
})
.then(function(response) {
        let len = response.length;
  console.log(len);
  let num = len/6;
  let floor=Math.floor(num);
  let ceil = Math.ceil(num)
  console.log(num);
  let slider = document.getElementsByClassName("slider");
  for (i = 1; i <= floor; i++) {
    slider[0].innerHTML += `
      <div class="myslide">
        <div class="theslide">
          <div class="fortheslide">
            <div class="sliderrow"></div>
            <div class="sliderrow"></div>
          </div>
        </div>
      </div>
    `;
  }
  if(ceil=>0.1){
      slider[0].innerHTML += `
      <div class="myslide">
        <div class="theslide">
          <div class="fortheslide">
            <div class="sliderrow"></div>
            <div class="sliderrow"></div>
          </div>
        </div>
      </div>
      `
  }
  let fortheslide = document.getElementsByClassName("fortheslide");
  let sliderrow = document.getElementsByClassName("sliderrow");
  let sliderrowarr = Array.from(sliderrow);

  let count = 2;
  let stat = 0;
  let index = 0;
  let save = 0;
  let j = 0;
  let drop = len;
  let flag = 0;
  while (save < len) {
    if (flag == 1) {
      break;
    }
    while (j <= count) {
      if (drop == 0) {
        flag = 1;
        break;
      }
      let image = response[j].Image;
      let name = response[j].Name;
      let description = response[j].Description;
      let price = response[j].Price;
      let productId = response[j].ProductID;
      sliderrowarr[index].innerHTML += `
        <div class="boxcard" data-product-id="${productId}">
          <div class="forboximg">
            <img src=${image} alt="" class="realforboximg" />
          </div>
          <div class="forboxdesc">
            <div class="forboxdesc1">
              <div class="titles">${name}</div>
              <div class="realdesc">${description}</div>
            </div>
            <div class="forboxdesc2">
              <div class="price">${price}</div>
              <div class="fordescclear">
                <button class="formatqbtn plus">+</button>
                <div class="quantity">0</div>
                <button class="formatqbtn minus">-</button>
              </div>
            </div>
          </div>
        </div>
      `;
      stat++;
      save++;
      j++;
      drop--;
    }
    console.log(stat);
    index++;
    j = stat;
    count = j + 2;
    console.log(index, j, count);
  }

  let responsesorted = [...response].sort((a, b) => a.Price - b.Price);
  console.log(responsesorted);

  let low = document.getElementById("low");
  low.addEventListener("click", () => {
    for (let i = 0; i < sliderrowarr.length; i++) {
      sliderrowarr[i].innerHTML = "";
    }
    let countlow = 2;
    let statlow = 0;
    let indexlow = 0;
    let savelow = 0;
    let jlow = 0;
    let droplow = len;
    let flaglow = 0;
    while (savelow < len) {
      if (flaglow == 1) {
        break;
      }
      while (jlow <= countlow) {
        if (droplow == 0) {
          flaglow = 1;
          break;
        }
        let imagelow = responsesorted[jlow].Image;
        let namelow = responsesorted[jlow].Name;
        let descriptionlow = responsesorted[jlow].Description;
        let pricelow = responsesorted[jlow].Price;
        let productIdlow = responsesorted[jlow].ProductID;
        sliderrowarr[indexlow].innerHTML += `
          <div class="boxcard" data-product-id="${productIdlow}">
            <div class="forboximg">
              <img src=${imagelow} alt="" class="realforboximg" />
            </div>
            <div class="forboxdesc">
              <div class="forboxdesc1">
                <div class="titles">${namelow}</div>
                <div class="realdesc">${descriptionlow}</div>
              </div>
              <div class="forboxdesc2">
                <div class="price">${pricelow}</div>
                <div class="fordescclear">
                  <button class="formatqbtn plus">+</button>
                  <div class="quantity">0</div>
                  <button class="formatqbtn minus">-</button>
                </div>
              </div>
            </div>
          </div>
        `;
        statlow++;
        savelow++;
        jlow++;
        droplow--;
      }
      indexlow++;
      jlow = statlow;
      countlow = jlow + 2;
    }
      let plus = document.getElementsByClassName("plus");
      plusarr = Array.from(plus);
      let minus = document.getElementsByClassName("minus");
      let quantity= document.getElementsByClassName("quantity");
      let quantitycon3 = document.getElementById("quantity");
      let minusarr = Array.from(minus);
      let quantityarr = Array.from(quantity);
      let items= 0;

      plusarr.forEach(function(element) {
       element.addEventListener("click", () => {
       let store = plusarr.indexOf(element);
       let value = parseInt(quantityarr[store].innerText);
       quantityarr[store].innerText = ++value;
       items++;
       addtocart(store, value);
       quantitycon3.innerHTML = `${items}`;
       });
      });

      minusarr.forEach(function(element) {
       element.addEventListener("click", () => {
        let store = minusarr.indexOf(element);
        let value = parseInt(quantityarr[store].innerText);
        if (value > 0) {
          quantityarr[store].innerText = --value;
          items--;
          addtocart(store, value);
          quantitycon3.innerHTML = `${items}`;
        }
       });
      });
  });

  let responsesorteddesc = [...response].sort((a, b) => b.Price - a.Price);
  console.log(responsesorteddesc);

  let high = document.getElementById("high");
  high.addEventListener("click", () => {
    for (let i = 0; i < sliderrowarr.length; i++) {
      sliderrowarr[i].innerHTML = "";
    }
    let counthigh = 2;
    let stathigh = 0;
    let indexhigh = 0;
    let savehigh = 0;
    let jhigh = 0;
    let drophigh = len;
    let flaghigh = 0;
    while (savehigh < len) {
      if (flaghigh == 1) {
        break;
      }
      while (jhigh <= counthigh) {
        if (drophigh == 0) {
          flaghigh = 1;
          break;
        }
        let imagehigh = responsesorteddesc[jhigh].Image;
        let namehigh = responsesorteddesc[jhigh].Name;
        let descriptionhigh = responsesorteddesc[jhigh].Description;
        let pricehigh = responsesorteddesc[jhigh].Price;
        let productIdhigh = responsesorteddesc[jhigh].ProductID;
        sliderrowarr[indexhigh].innerHTML += `
          <div class="boxcard" data-product-id="${productIdhigh}">
            <div class="forboximg">
              <img src=${imagehigh} alt="" class="realforboximg" />
            </div>
            <div class="forboxdesc">
              <div class="forboxdesc1">
                <div class="titles">${namehigh}</div>
                <div class="realdesc">${descriptionhigh}</div>
              </div>
              <div class="forboxdesc2">
                <div class="price">${pricehigh}</div>
                <div class="fordescclear">
                  <button class="formatqbtn plus">+</button>
                  <div class="quantity">0</div>
                  <button class="formatqbtn minus">-</button>
                </div>
              </div>
            </div>
          </div>
        `;
        stathigh++;
        savehigh++;
        jhigh++;
        drophigh--;
      }
      indexhigh++;
      jhigh = stathigh;
      counthigh = jhigh + 2;
    }
          let plus = document.getElementsByClassName("plus");
      plusarr = Array.from(plus);
      let minus = document.getElementsByClassName("minus");
      let quantity= document.getElementsByClassName("quantity");
      let quantitycon3 = document.getElementById("quantity");
      let minusarr = Array.from(minus);
      let quantityarr = Array.from(quantity);
      let items= 0;

      plusarr.forEach(function(element) {
       element.addEventListener("click", () => {
       let store = plusarr.indexOf(element);
       let value = parseInt(quantityarr[store].innerText);
       quantityarr[store].innerText = ++value;
       items++;
       addtocart(store, value);
       quantitycon3.innerHTML = `${items}`;
       });
      });

      minusarr.forEach(function(element) {
       element.addEventListener("click", () => {
        let store = minusarr.indexOf(element);
        let value = parseInt(quantityarr[store].innerText);
        if (value > 0) {
          quantityarr[store].innerText = --value;
          items--;
          addtocart(store, value);
          quantitycon3.innerHTML = `${items}`;
        }
       });
      });
  });

summerarr = [];
  for (let k = 0; k < response.length; k++) {
    if (response[k].hasOwnProperty("Size") && response[k].Size === "Small") {
      summerarr.push(response[k]);
    }
  }
  
let summer = document.getElementById("small");
summer.addEventListener("click", () => {
  for (let i = 0; i < sliderrowarr.length; i++) {
    sliderrowarr[i].innerHTML = ""; // Clear the sliderrow elements
  }
  
  let sliderrowsummer = document.getElementsByClassName("sliderrow");
  let sliderrowarrsummer = Array.from(sliderrowsummer);
  
  countsummer = 2;
  statsummer = 0;
  indexsummer = 0;
  savesummer = 0;
  var jsummer = 0;
  dropsummer = summerarr.length;
  flagsummer = 0;
  while (savesummer < summerarr.length) {
    if (flagsummer == 1) {
      break;
    }
    while (jsummer <= countsummer) {
      if (dropsummer == 0) {
        flagsummer = 1;
        break;
      }
      let imagesummer = summerarr[jsummer].Image;
      let namesummer = summerarr[jsummer].Name;
      let descriptionsummer = summerarr[jsummer].Description;
      let pricesummer = summerarr[jsummer].Price;
      let productIdsummer = summerarr[jsummer].ProductID;
      sliderrowarrsummer[indexsummer].innerHTML += `
        <div class="boxcard" data-product-id="${productIdsummer}">
          <div class="forboximg">
            <img
              src=${imagesummer}
              alt=""
              class="realforboximg"
            />
          </div>
          <div class="forboxdesc">
            <div class="forboxdesc1">
              <div class="titles">${namesummer}</div>
              <div class="realdesc">
                ${descriptionsummer}
              </div>
            </div>
            <div class="forboxdesc2">
              <div class="price">${pricesummer}</div>
              <div class="fordescclear">
                <button class="formatqbtn plus">+</button>
                <div class="quantity">0</div>
                <button class="formatqbtn minus">-</button>
              </div>
            </div>
          </div>
        </div>
      `;
      jsummer++;
      savesummer++;
      dropsummer--;
    }
    indexsummer++;
    jsummer = statsummer;
    countsummer = jsummer + 2;
  }
        let plus = document.getElementsByClassName("plus");
      plusarr = Array.from(plus);
      let minus = document.getElementsByClassName("minus");
      let quantity= document.getElementsByClassName("quantity");
      let quantitycon3 = document.getElementById("quantity");
      let minusarr = Array.from(minus);
      let quantityarr = Array.from(quantity);
      let items= 0;

      plusarr.forEach(function(element) {
       element.addEventListener("click", () => {
       let store = plusarr.indexOf(element);
       let value = parseInt(quantityarr[store].innerText);
       quantityarr[store].innerText = ++value;
       items++;
       addtocart(store, value);
       quantitycon3.innerHTML = `${items}`;
       });
      });

      minusarr.forEach(function(element) {
       element.addEventListener("click", () => {
        let store = minusarr.indexOf(element);
        let value = parseInt(quantityarr[store].innerText);
        if (value > 0) {
          quantityarr[store].innerText = --value;
          items--;
          addtocart(store, value);
          quantitycon3.innerHTML = `${items}`;
        }
       });
      });
});

  winterarr = [];
  for (let k = 0; k < response.length; k++) {
    if (response[k].hasOwnProperty("Size") && response[k].Size === "Medium") {
      winterarr.push(response[k]);
    }
  }
  console.log(winterarr)
  
let winter = document.getElementById("medium");
winter.addEventListener("click", () => {
  for (let i = 0; i < sliderrowarr.length; i++) {
    sliderrowarr[i].innerHTML = ""; // Clear the sliderrow elements
  }
  
  let sliderrowwinter = document.getElementsByClassName("sliderrow");
  let sliderrowarrwinter = Array.from(sliderrowwinter);
  
  countwinter = 2;
  statwinter = 0;
  indexwinter = 0;
  savewinter = 0;
  var jwinter = 0;
  dropwinter = winterarr.length;
  flagwinter = 0;
  while (savewinter < winterarr.length) {
    if (flagwinter == 1) {
      break;
    }
    while (jwinter <= countwinter) {
      if (dropwinter == 0) {
        flagwinter = 1;
        break;
      }
      let imagewinter = winterarr[jwinter].Image;
      let namewinter = winterarr[jwinter].Name;
      let descriptionwinter = winterarr[jwinter].Description;
      let pricewinter = winterarr[jwinter].Price;
      let productIdwinter = winterarr[jwinter].ProductID;
      sliderrowarrwinter[indexwinter].innerHTML += `
        <div class="boxcard" data-product-id="${productIdwinter}">
          <div class="forboximg">
            <img
              src=${imagewinter}
              alt=""
              class="realforboximg"
            />
          </div>
          <div class="forboxdesc">
            <div class="forboxdesc1">
              <div class="titles">${namewinter}</div>
              <div class="realdesc">
                ${descriptionwinter}
              </div>
            </div>
            <div class="forboxdesc2">
              <div class="price">${pricewinter}</div>
              <div class="fordescclear">
                <button class="formatqbtn plus">+</button>
                <div class="quantity">0</div>
                <button class="formatqbtn minus">-</button>
              </div>
            </div>
          </div>
        </div>
      `;
      jwinter++;
      savewinter++;
      dropwinter--;
    }
    indexwinter++;
    jwinter = statwinter;
    countwinter = jwinter + 2;
  }
        let plus = document.getElementsByClassName("plus");
      plusarr = Array.from(plus);
      let minus = document.getElementsByClassName("minus");
      let quantity= document.getElementsByClassName("quantity");
      let quantitycon3 = document.getElementById("quantity");
      let minusarr = Array.from(minus);
      let quantityarr = Array.from(quantity);
      let items= 0;

      plusarr.forEach(function(element) {
       element.addEventListener("click", () => {
       let store = plusarr.indexOf(element);
       let value = parseInt(quantityarr[store].innerText);
       quantityarr[store].innerText = ++value;
       items++;
       addtocart(store, value);
       quantitycon3.innerHTML = `${items}`;
       });
      });

      minusarr.forEach(function(element) {
       element.addEventListener("click", () => {
        let store = minusarr.indexOf(element);
        let value = parseInt(quantityarr[store].innerText);
        if (value > 0) {
          quantityarr[store].innerText = --value;
          items--;
          addtocart(store, value);
          quantitycon3.innerHTML = `${items}`;
        }
       });
      });
});

  bigarr = [];
  for (let k = 0; k < response.length; k++) {
    if (response[k].hasOwnProperty("Size") && response[k].Size === "Big") {
      bigarr.push(response[k]);
    }
  }
  console.log(bigarr)
  
let big = document.getElementById("big");
big.addEventListener("click", () => {
  for (let i = 0; i < sliderrowarr.length; i++) {
    sliderrowarr[i].innerHTML = ""; // Clear the sliderrow elements
  }
  
  let sliderrowbig = document.getElementsByClassName("sliderrow");
  let sliderrowarrbig = Array.from(sliderrowbig);
  
  countbig = 2;
  statbig = 0;
  indexbig = 0;
  savebig = 0;
  var jbig = 0;
  dropbig = bigarr.length;
  flagbig = 0;
  while (savebig < bigarr.length) {
    if (flagbig == 1) {
      break;
    }
    while (jbig <= countbig) {
      if (dropbig == 0) {
        flagbig = 1;
        break;
      }
      let imagebig = bigarr[jbig].Image;
      let namebig = bigarr[jbig].Name;
      let descriptionbig = bigarr[jbig].Description;
      let pricebig = bigarr[jbig].Price;
      let productIdbig = bigarr[jbig].ProductID;
      sliderrowarrbig[indexbig].innerHTML += `
        <div class="boxcard" data-product-id="${productIdbig}">
          <div class="forboximg">
            <img
              src=${imagebig}
              alt=""
              class="realforboximg"
            />
          </div>
          <div class="forboxdesc">
            <div class="forboxdesc1">
              <div class="titles">${namebig}</div>
              <div class="realdesc">
                ${descriptionbig}
              </div>
            </div>
            <div class="forboxdesc2">
              <div class="price">${pricebig}</div>
              <div class="fordescclear">
                <button class="formatqbtn plus">+</button>
                <div class="quantity">0</div>
                <button class="formatqbtn minus">-</button>
              </div>
            </div>
          </div>
        </div>
      `;
      jbig++;
      savebig++;
      dropbig--;
    }
    indexbig++;
    jbig = statbig;
    countbig = jbig + 2;
  }
        let plus = document.getElementsByClassName("plus");
      plusarr = Array.from(plus);
      let minus = document.getElementsByClassName("minus");
      let quantity= document.getElementsByClassName("quantity");
      let quantitycon3 = document.getElementById("quantity");
      let minusarr = Array.from(minus);
      let quantityarr = Array.from(quantity);
      let items= 0;

      plusarr.forEach(function(element) {
       element.addEventListener("click", () => {
       let store = plusarr.indexOf(element);
       let value = parseInt(quantityarr[store].innerText);
       quantityarr[store].innerText = ++value;
       items++;
       addtocart(store, value);
       quantitycon3.innerHTML = `${items}`;
       });
      });

      minusarr.forEach(function(element) {
       element.addEventListener("click", () => {
        let store = minusarr.indexOf(element);
        let value = parseInt(quantityarr[store].innerText);
        if (value > 0) {
          quantityarr[store].innerText = --value;
          items--;
          addtocart(store, value);
          quantitycon3.innerHTML = `${items}`;
        }
       });
      });
});


  

  let plus = document.getElementsByClassName("plus");
  let minus = document.getElementsByClassName("minus");
  let quantity = document.getElementsByClassName("quantity");
  let quantitycon3 = document.getElementById("quantity");
  let plusarr = Array.from(plus);
  console.log(plus)
  console.log(plusarr)
  let minusarr = Array.from(minus);
  let quantityarr = Array.from(quantity);
  let items = 0;
  let addtocartarr = [];

  plusarr.forEach(function(element) {
    element.addEventListener("click", () => {
      let store = plusarr.indexOf(element);
      let value = parseInt(quantityarr[store].innerText);
      quantityarr[store].innerText = ++value;
      items++;
      addtocart(store, value);
      quantitycon3.innerHTML = `${items}`;
    });
  });

  minusarr.forEach(function(element) {
    element.addEventListener("click", () => {
      let store = minusarr.indexOf(element);
      let value = parseInt(quantityarr[store].innerText);
      if (value > 0) {
        quantityarr[store].innerText = --value;
        items--;
        addtocart(store, value);
        quantitycon3.innerHTML = `${items}`;
      }
    });
  });

  let boxcard = document.getElementsByClassName("boxcard");
  let boxcardarr = Array.from(boxcard);

  function addtocart(store, items) {
    let productID = boxcardarr[store].getAttribute("data-product-id");
    let existingItem = addtocartarr.find((item) => item.productID === productID);
    if (existingItem) {
      existingItem.quantity = items;
    } else {
      let obj = {
        productID: productID,
        quantity: items
      };
      addtocartarr.push(obj);
    }
    console.log(addtocartarr);
  }

  let cart = document.getElementById("cart");
  cart.addEventListener("click", () => {
    let jsonaddtocartarr = JSON.stringify(addtocartarr);
    console.log(jsonaddtocartarr);
    fetch('/add_to_cart.php', {
      method: 'POST',
      body: jsonaddtocartarr,
      headers: {
        'Content-Type': 'application/json'
      }
    });
  });
});

       function Func(){
           myslide = document.querySelectorAll('.myslide');
           counter = 1;
           slidefun(counter);
        }
        
        setTimeout(Func, 8000);
        
        function plusSlides(n) {
           counter += n;
           slidefun(counter);
        }
        
        function currentSlide(n) {
           counter = n;
           slidefun(counter);
        }

        function slidefun(n) {
         let i;
         for (i = 0; i < myslide.length; i++) {
            myslide[i].style.display = "none";
          }
          if (n > myslide.length) {
           counter = 1;
          }
          if (n < 1) {
            counter = myslide.length;
          }
          myslide[counter - 1].style.display = "block";
        }


let orders = document.getElementById("orders");
let arrow = document.getElementById("arrow");
let ordercontainer = document.getElementById("ordercontainer");
let num = 0;

window.addEventListener("scroll", fun1);
function fun1() {
  ordercontainer.style.display = "none"
  num = 0;
  up = window.scrollY;
  //if (up == 0) {
//    nav.style.backgroundImage = "linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5))";
//    bookcontainer.style.backgroundImage = "linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5))";
 // }
}
orders.addEventListener("click", fun2)
arrow.addEventListener("click", fun2)
function fun2() {
  if (num == 1) {
    num = 0;
    // console.log(num);
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
        up = window.scrollY;
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