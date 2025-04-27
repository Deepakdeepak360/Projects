let cart = {};
let allProducts = [];

function fetchProducts() {
  fetch("http://localhost:8000/frontend/backend/fetch_products.php")
    .then((res) => res.json())
    .then((data) => {
      allProducts = data;
      displayProducts(allProducts);
    })
    .catch((err) => console.error("Product Fetch Error:", err));
}

function fetchCategories() {
  fetch("http://localhost:8000/frontend/backend/categories.php")
    .then((res) => res.json())
    .then((categories) => {
      let categoryList = document.getElementById("category-list");
      categoryList.innerHTML = `
        <a class="dropdown-item" href="#" onclick="filterProducts('all'); document.getElementById('categoryBtn').textContent='All Category'">All Category</a>
      `;
      categories.forEach((cat) => {
        categoryList.innerHTML += `
          <a class="dropdown-item" href="#" onclick="filterProducts(${cat.id}); document.getElementById('categoryBtn').textContent='${cat.name}'">${cat.name}</a>
        `;
      });
    })
    .catch((err) => console.error("Category Fetch Error:", err));
}

function filterProducts(categoryId) {
  if (categoryId === 'all') {
    renderProducts(allProducts);
  } else {
    const filtered = allProducts.filter(p => String(p.category_id) === String(categoryId));
    renderProducts(filtered);
  }
}

function displayProducts(products) {
  let container = document.getElementById("product-container");
  container.innerHTML = "";
  products.forEach((product) => {
    const qty = cart[product.id] || 0;
    container.innerHTML += `
      <div class="product-card" data-product-id="${product.id}">
        <img src="${product.image}" alt="${product.name}">
        <h3>${product.name}</h3>
        <p class="price">₹${product.price}</p>
        <p class="description text-muted small">${product.description}</p>
        <div class="cart-action-buttons">
          ${qty === 0 ? `
            <button class="btn-add-to-cart" onclick="addToCart(${product.id})">
              <i class="fas fa-shopping-cart"></i> Add to Cart
            </button>
            <button class="btn-buy-now" onclick="buyNow(${product.id})">
              <i class="fas fa-bolt"></i> Buy Now
            </button>
          ` : `
            <div class="quantity-controls">
              <button class="qty-btn minus" onclick="decreaseQty(${product.id})">
                <i class="fas fa-minus"></i>
              </button>
              <span class="qty-display">${qty}</span>
              <button class="qty-btn plus" onclick="increaseQty(${product.id})">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          `}
        </div>
      </div>
    `;
  });
}

function addToCart(productId) {
  cart[productId] = 1;
  saveCartToStorage();
  displayProducts(allProducts);
  updateCartUI();
}

// Remove the duplicate showQuantitySelector function since we don't need it anymore

// Add new function for quick purchase
function buyNow(productId) {
  addToCart(productId);
  window.location.href = 'payment.html';
}

function renderProducts(products) {
  displayProducts(products);
}

function increaseQty(productId) {
  cart[productId]++;
  saveCartToStorage();
  displayProducts(allProducts);
  updateCartUI();
}

function decreaseQty(productId) {
  if (cart[productId] > 1) {
    cart[productId]--;
  } else {
    delete cart[productId];
  }
  saveCartToStorage();
  displayProducts(allProducts);
  updateCartUI();
}

function removeItem(productId) {
  delete cart[productId];
  saveCartToStorage();
  displayProducts(allProducts);
  updateCartUI();
}

function updateCartUI() {
  const cartItems = document.getElementById("cart-items");
  const cartTotal = document.getElementById("cart-total");
  cartItems.innerHTML = "";
  let total = 0;

  for (let productId in cart) {
    const product = allProducts.find((p) => p.id == productId);
    if (!product) continue;
    const qty = cart[productId];
    const subtotal = product.price * qty;
    total += subtotal;

    const li = document.createElement("li");
    li.className = "list-group-item d-flex justify-content-between align-items-center";
    li.innerHTML = `
      ${product.name} x ${qty} - ₹${subtotal.toFixed(2)}
      <button class='btn btn-sm btn-danger' onclick='removeItem(${productId})'>x</button>
    `;
    cartItems.appendChild(li);
  }

  cartTotal.textContent = total.toFixed(2);
}

function saveCartToStorage() {
  localStorage.setItem("cart", JSON.stringify(cart));
}

function loadCartFromStorage() {
  const storedCart = localStorage.getItem("cart");
  if (storedCart) {
    cart = JSON.parse(storedCart);
  }
  updateCartUI();
}

// UI Toggles
function toggleCart() {
  document.getElementById("cart-sidebar").classList.toggle("hidden");
  updateCartUI();
}

function toggleProfile() {
  document.getElementById("profile-popup").classList.toggle("hidden");
}

function openPaymentPopup() {
  document.getElementById("payment-popup").classList.remove("hidden");
  const total = Object.keys(cart).reduce((sum, pid) => {
    const product = allProducts.find((p) => p.id == pid);
    return sum + (product.price * cart[pid]);
  }, 0);
  document.getElementById("payment-total").textContent = total.toFixed(2);
}

function closePaymentPopup() {
  document.getElementById("payment-popup").classList.add("hidden");
}


document.getElementById("search-btn").addEventListener("click", function () {
  const query = document.getElementById("search-input").value.toLowerCase();
  const filtered = allProducts.filter(product =>
    product.name.toLowerCase().includes(query)
  );
  renderProducts(filtered);
});

// Optional: Enable real-time search while typing
document.getElementById("search-input").addEventListener("input", function () {
  const query = this.value.toLowerCase();
  const filtered = allProducts.filter(product =>
    product.name.toLowerCase().includes(query)
  );
  renderProducts(filtered);
});


// 🔃 Initial Load
window.onload = function () {
  loadCartFromStorage();
  fetchProducts();
  fetchCategories();
};


function filterByPrice(min, max) {
    const filtered = allProducts.filter(product => {
        const price = parseFloat(product.price);
        return price >= min && price <= max;
    });
    displayProducts(filtered);
}
