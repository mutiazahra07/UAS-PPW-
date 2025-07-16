<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang Belanja</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .cart-item img {
      height: 100px;
      object-fit: cover;
    }
  </style>
</head>
<body class="bg-light">

  <div class="container my-5">
    <h2 class="mb-4 text-center">🛒 Keranjang Belanja</h2>
    <div id="cartContainer" class="row g-3"></div>

    <div class="mt-4 text-end">
      <h4>Total: <span id="totalPrice">Rp0</span></h4>
      <a href="payment.php" class="btn btn-primary mt-2">Lanjutkan Pembayaran</a>
    </div>
  </div>

  <script>
    function displayCart() {
      const cart = JSON.parse(localStorage.getItem('keranjang')) || [];
      const cartContainer = document.getElementById('cartContainer');
      cartContainer.innerHTML = '';

      let total = 0;

      if(cart.length === 0){
        cartContainer.innerHTML = '<p class="text-center">Keranjang kosong.</p>';
      }

      cart.forEach((item, index) => {
        const hargaAngka = parseInt(item.harga.replace(/\D/g, ''));
        const subtotal = hargaAngka * item.qty;
        total += subtotal;

        const itemDiv = document.createElement('div');
        itemDiv.classList.add('col-12', 'cart-item');

        itemDiv.innerHTML = `
          <div class="card">
            <div class="card-body d-flex align-items-center">
              <img src="${item.gambar}" alt="${item.judul}" class="me-3">
              <div class="flex-grow-1">
                <h5>${item.judul}</h5>
                <p>Harga: ${item.harga}</p>
                <p>Jumlah: ${item.qty}</p>
              </div>
              <button class="btn btn-danger btn-sm" onclick="removeItem(${index})">Hapus</button>
            </div>
          </div>
        `;

        cartContainer.appendChild(itemDiv);
      });

      document.getElementById('totalPrice').textContent = 'Rp' + total.toLocaleString('id-ID');
    }

    function removeItem(index) {
      let cart = JSON.parse(localStorage.getItem('keranjang')) || [];
      cart.splice(index, 1);
      localStorage.setItem('keranjang', JSON.stringify(cart));
      displayCart();
    }

    displayCart();
  </script>
</body>
</html>
