window.addEventListener("scroll", function(){
var header = document.querySelector("header");
header.classList.toggle("sticky", window.scrollY > 0);
})





       var x =document.getElementById("login2");
       var y =document.getElementById("signup");
       var z =document.getElementById("btnn");
         
         function signup(){
             x.style.left="-400px";
             y.style.left="50px";
             z.style.left="110px";
         }
       function login2(){
             x.style.left="50px";
             y.style.left="450px";
             z.style.left="0px";
         }





let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}
        
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
    
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}


function togglePasswordVisibility(passwordId, iconId) {
  var passwordInput = document.getElementById(passwordId);
  var eyeIcon = document.getElementById(iconId);
  if (passwordInput.type === "password") {
      passwordInput.type = "text";
      eyeIcon.classList.remove("fa-eye");
      eyeIcon.classList.add("fa-eye-slash");
  } else {
      passwordInput.type = "password";
      eyeIcon.classList.remove("fa-eye-slash");
      eyeIcon.classList.add("fa-eye");
  }
}

function openlightbox(){
  document.getElementById("lightbox").style.display="flex";
}


function closelightbox(){
  document.getElementById("lightbox").style.display="none";
}


function addUser() {
  console.log("Add user clicked");
}

document.querySelectorAll('.edit-btn').forEach(item => {
  item.addEventListener('click', event => {
      console.log("Edit user clicked");
  });
});

document.querySelectorAll('.delete-btn').forEach(item => {
  item.addEventListener('click', event => {
      console.log("Delete user clicked");
  });
});


   function changePrice(productType, productId) {
            alert(`Change price for ${productType} with ID ${productId}`);
        }
        
        function removeProduct(productType, productId) {
            
            alert(`Remove ${productType} with ID ${productId}`);
        }
        
        

        function changePrice(p_id, price) {
          const newPrice = prompt(`Enter new price for the product with ID ${p_id}:`, price);
          if (newPrice !== null) {
              updatePrice(p_id, newPrice);
          }
      }
      
      function updatePrice(p_id, newPrice) {
          const xhr = new XMLHttpRequest();
          xhr.open('POST', window.location.href, true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.onload = function() {
              if (xhr.status === 200) {
                  alert(xhr.responseText);
                  location.reload();
              } else {
                  alert('Error updating price');
              }
          };
          xhr.send(`action=update_price&p_id=${p_id}&newPrice=${newPrice}`);
      }
      
      function removeProduct(p_id) {
          if (confirm(`Are you sure you want to remove the product with ID ${p_id}?`)) {
              const xhr = new XMLHttpRequest();
              xhr.open('POST', window.location.href, true);
              xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
              xhr.onload = function() {
                  if (xhr.status === 200) {
                      alert(xhr.responseText);
                      location.reload();
                  } else {
                      alert('Error removing product');
                  }
              };
              xhr.send(`action=remove_product&p_id=${p_id}`);
          }
      }
      
      function generateProductCard(p_id, productName, price) {
          return `
              <div class="product-card">
                  <img src="photos/product${p_id}.jpg" alt="${productName}" style="width: 150px; height: 150px;">
                  <p><strong>${productName}</strong></p>
                  <p>Price: $${price}</p>
                  <button onclick="changePrice(${p_id}, ${price})">Change Price</button>
                  <button onclick="removeProduct(${p_id})">Remove Product</button>
              </div>
          `;
      }
      
      

        
        const braceletsDiv = document.getElementById('bracelets');
        for (let i = 1; i <= 6; i++) {
            const productCard = generateProductCard('Bracelet', i, `Bracelet ${i}`, 50 + i * 10);
            braceletsDiv.innerHTML += productCard;
        }
        
        
        const necklacesDiv = document.getElementById('necklaces');
        for (let i = 1; i <= 6; i++) {
            const productCard = generateProductCard('Necklace', i, `Necklace ${i}`, 100 + i * 20);
            necklacesDiv.innerHTML += productCard;
        }
        
        
        const ringsDiv = document.getElementById('rings');
        for (let i = 1; i <= 6; i++) {
            const productCard = generateProductCard('Ring', i, `Ring ${i}`, 80 + i * 15);
            ringsDiv.innerHTML += productCard;
        }
        
       
        const earringsDiv = document.getElementById('earrings');
        for (let i = 1; i <= 6; i++) {
            const productCard = generateProductCard('Earring', i, `Earring ${i}`, 70 + i * 15);
            earringsDiv.innerHTML += productCard;
        }


     

      function addToCart(id, name, price, image) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "Cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                displayCart();
            }
        };
        var data = "p_id=" + id + "&name=" + encodeURIComponent(name) + "&price=" + price + "&picture=" + encodeURIComponent(image);
        xhr.send(data);
    }
    
    function displayCart() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "Cart.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                document.getElementById("cart").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
    
function myFunction(productId) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "Cart.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          displayCart();
      }
  };
  xhr.send("productId=" + productId);
}

window.onload = function () {
  displayCart();
};

