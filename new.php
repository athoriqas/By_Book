<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "by_book";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, judul, penulis, harga, cover, deskripsi, rating FROM buku";
$result = $conn->query($sql);

$books = [];

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $books[] = $row;
  }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>BY Book Store</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.jpeg" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .rating-stars {
            display: flex;
            gap: 5px;
            cursor: pointer;
        }

        .rating-stars .bi-star {
            font-size: 24px;
            color: #d3d3d3; /* Gray color */
        }

        .rating-stars .bi-star.filled {
            color: #ffd700; /* Gold color */
        }

        .book-detail-cover {
            max-width: 200px;
            margin-right: 20px;
        }

        .book-detail-content {
            flex: 1;
        }

        .book-detail-content h2 {
            margin-top: 0;
        }

        .cart-items {
            max-height: 400px;
            overflow-y: auto;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .card {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }

        .card.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="user.php">BY Book Store</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="user.php"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item dropdown">
            <a
                class="nav-link dropdown-toggle"
                id="navbarDropdown"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                >Shop</a
              >
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <a class="dropdown-item" href="pop.php">Popular Items</a>
                </li>
                <li>
                  <a class="dropdown-item" href="new.php">New Arrivals</a>
                </li>
              </ul>
            </li>
          </ul>

          <form class="d-flex me-3">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-dark" type="submit">Search</button>
          </form>

          <form class="d-flex">
                    <button id="cart-button" class="btn btn-outline-dark" type="button" data-bs-toggle="modal" data-bs-target="#cartModal">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span id="cart-count" class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">New Arrival</h1>
                <p class="lead fw-normal text-white-50 mb-0">FOllowing the Updated Book from Us!</p>
            </div>
        </div>
    </header>

    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <!-- Display Books from Database -->
                <?php foreach ($books as $book) : ?>
                    <div class="col mb-5">
                        <div class="card h-100" data-id="<?= $book['id'] ?>">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#bookModal<?= $book['id'] ?>">
                                <img class="card-img-top" src="assets/<?= $book['cover'] ?>" alt="<?= $book['judul'] ?>" />
                            </a>
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder"><?= $book['judul'] ?></h5>
                                    <h6 class="fw-bolder"><?= $book['penulis'] ?></h6>
                                    <div class="d-flex justify-content-center align-items-center mb-2">
                                        <span class="rating-stars">
                                            <?php for ($i = 0; $i < 5; $i++) : ?>
                                                <i class="bi-star <?= $i < $book['rating'] ? 'filled' : '' ?>"></i>
                                            <?php endfor; ?>
                                        </span>
                                        <span class="rating-display" style="color: black;"> <?= $book['rating'] ?>/5</span>
                                    </div>
                                    IDR <?= number_format($book['harga'], 0, ',', '.') ?>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto add-to-cart" href="#" data-id="<?= $book['id'] ?>" data-title="<?= $book['judul'] ?>" data-price="<?= $book['harga'] ?>">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Book Detail -->
                    <div class="modal fade" id="bookModal<?= $book['id'] ?>" tabindex="-1" aria-labelledby="bookModalLabel<?= $book['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="bookModalLabel<?= $book['id'] ?>"><?= $book['judul'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex">
                                    <div class="book-detail-cover">
                                        <img src="assets/<?= $book['cover'] ?>" alt="<?= $book['judul'] ?>" class="img-fluid" />
                                    </div>
                                    <div class="book-detail-content">
                                        <h2><?= $book['judul'] ?></h2>
                                        <h4 class="text-muted"><?= $book['penulis'] ?></h4>
                                        <p class="lead">IDR <?= number_format($book['harga'], 0, ',', '.') ?></p>
                                        <p><?= $book['deskripsi'] ?></p>
                                        <div class="rating-stars">
                                            <?php for ($i = 0; $i < 5; $i++) : ?>
                                                <i class="bi-star <?= $i < $book['rating'] ? 'filled' : '' ?>" data-value="<?= $i + 1 ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary save-rating" data-id="<?= $book['id'] ?>">Save Rating</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- Cart Modal-->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="cart-items" id="cart-items">
                        <p>Your cart is currently empty.</p>
                    </div>
                    <div class="mt-3">
                        <h5>Total: IDR <span id="cart-total">0</span></h5>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="checkout-button">Checkout</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer-->
<footer class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <h5 class="text-uppercase mb-4">About Us</h5>
                <p>Your Book Store is your go-to place for discovering and purchasing your favorite books. We offer a wide variety of genres and bestsellers to satisfy every reader's taste.</p>
            </div>
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h5 class="text-uppercase mb-4">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="about.html" class="text-white">About Us</a></li>
                    <li><a href="shop.html" class="text-white">Shop</a></li>
                    <li><a href="https://wa.me/81287465122" class="text-white">Contact Us</a></li>
                    <li><a href="#" class="text-white">FAQ</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5 class="text-uppercase mb-4">Contact Us</h5>
                <ul class="list-unstyled">
                    <li><i class="bi bi-geo-alt"></i> 123 Book St, Reading Town, BK 45678</li>
                    <li><i class="bi bi-telephone"></i> +1 234 567 890</li>
                    <li><i class="bi bi-envelope"></i> info@yourbookstore.com</li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5 class="text-uppercase mb-4">Follow Us</h5>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#" class="text-white"><i class="bi bi-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="text-white"><i class="bi bi-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="text-white"><i class="bi bi-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="text-white"><i class="bi bi-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="text-center mt-4">
        </div>
    </div>
</footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <!-- Custom scripts-->
    <script src="js/scripts.js"></script>
    <script>
        let cart = [];

        // Function to update the cart modal
        function updateCartModal() {
            const cartItemsContainer = document.getElementById('cart-items');
            const cartCount = document.getElementById('cart-count');
            const cartTotal = document.getElementById('cart-total');

            if (cart.length === 0) {
                cartItemsContainer.innerHTML = '<p>Your cart is currently empty.</p>';
                cartCount.textContent = '0';
                cartTotal.textContent = '0';
            } else {
                cartItemsContainer.innerHTML = cart.map(item => `
                    <div class="cart-item">
                        <div>${item.title} - IDR ${item.price}</div>
                        <div>Quantity: ${item.quantity}</div>
                    </div>
                `).join('');
                cartCount.textContent = cart.length;

                // Calculate the total price
                const totalPrice = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
                cartTotal.textContent = totalPrice.toLocaleString();
            }

            // Save cart to localStorage after updating
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        // Function to load cart from localStorage
        function loadCart() {
            const storedCart = localStorage.getItem('cart');
            if (storedCart) {
                cart = JSON.parse(storedCart);
                updateCartModal();
            }
        }

        // Load cart from localStorage when the page is loaded
        document.addEventListener('DOMContentLoaded', function() {
            loadCart();

            // Add event listeners for rating stars
            document.querySelectorAll('.rating-stars .bi-star').forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.dataset.value;
                    const parent = this.closest('.rating-stars');
                    parent.querySelectorAll('.bi-star').forEach(star => {
                        star.classList.toggle('filled', star.dataset.value <= rating);
                    });
                    parent.dataset.rating = rating; // Store rating on the parent element
                });
            });

            // Save rating button functionality
            document.querySelectorAll('.save-rating').forEach(button => {
                button.addEventListener('click', function() {
                    const bookId = this.dataset.id;
                    const rating = document.querySelector(`#bookModal${bookId} .rating-stars`).dataset.rating;

                    if (rating) {
                        // Send rating to the server (PHP script)
                        fetch('save_rating.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ id: bookId, rating: rating }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Close the modal
                                bootstrap.Modal.getInstance(document.getElementById(`bookModal${bookId}`)).hide();

                                // Update the book rating in the container
                                document.querySelector(`.card[data-id="${bookId}"] .rating-stars`).innerHTML = Array.from({ length: 5 }, (_, i) =>
                                    `<i class="bi-star ${i < rating ? 'filled' : ''}"></i>`
                                ).join('');
                                document.querySelector(`.card[data-id="${bookId}"] .rating-display`).textContent = `${rating}/5`;
                            } else {
                                alert('Failed to save rating.');
                            }
                        });
                    } else {
                        alert('Please select a rating before saving.');
                    }
                });
            });

            // Add to cart functionality
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const bookId = this.dataset.id;
                    const bookTitle = this.dataset.title;
                    const bookPrice = parseInt(this.dataset.price, 10);

                    // Check if book is already in the cart
                    const existingItem = cart.find(item => item.id === bookId);
                    if (existingItem) {
                        existingItem.quantity++;
                    } else {
                        cart.push({
                            id: bookId,
                            title: bookTitle,
                            price: bookPrice,
                            quantity: 1
                        });
                    }

                    updateCartModal();
                    alert(`Added ${bookTitle} to cart at IDR ${bookPrice}`);
                });
            });

            // Checkout button functionality
            document.getElementById('checkout-button').addEventListener('click', function() {
                if (cart.length === 0) {
                    alert('Your cart is empty.');
                    return;
                }
                // Simulate payment processing
                alert('Payment successful! Your order has been placed.');

                // Clear the cart
                cart = [];
                updateCartModal();
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
                const cards = document.querySelectorAll('.card');

                // Function to add 'show' class to cards
                function animateCards() {
                    cards.forEach((card, index) => {
                        setTimeout(() => {
                            card.classList.add('show');
                        }, index * 100); // Delay each card by 100ms
                    });
                }

                // Initial animation
                animateCards();

                // Update cart modal logic
                const cart = JSON.parse(localStorage.getItem('cart')) || [];
                const cartButton = document.getElementById('cart-button');
                const cartCount = document.getElementById('cart-count');
                const cartModalBody = document.querySelector('#cartModal .cart-items');

                function updateCartModal() {
                    cartModalBody.innerHTML = '';
                    cart.forEach(item => {
                        const cartItem = document.createElement('div');
                        cartItem.classList.add('cart-item');
                        cartItem.innerHTML = `
                            <span>${item.title}</span>
                            <span>IDR ${item.price}</span>
                        `;
                        cartModalBody.appendChild(cartItem);
                    });
                    cartCount.textContent = cart.length;
                }

                document.querySelectorAll('.add-to-cart').forEach(button => {
                    button.addEventListener('click', function (e) {
                        e.preventDefault();
                        const id = this.getAttribute('data-id');
                        const title = this.getAttribute('data-title');
                        const price = parseFloat(this.getAttribute('data-price'));

                        // Add to cart logic
                        cart.push({ id, title, price });
                        localStorage.setItem('cart', JSON.stringify(cart));
                        updateCartModal();
                    });
                });

                updateCartModal();
            });
    </script>

</body>

</html>
