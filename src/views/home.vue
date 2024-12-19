<script setup>
// Tambahkan logika khusus jika diperlukan di sini
</script>

<template>
  <div class="container-fluid full-screen-container">
    <!-- Hero Section -->
    <div class="text-center text-white hero-section">
      <h1 class="display-4 fw-bold text-shadow">Selamat datang di VapeStore</h1>
      <p class="col-md-8 fs-4 mx-auto text-shadow">
        Temukan berbagai produk vape premium yang dirancang untuk pengalaman terbaik Anda.
      </p>
      <router-link :to="{ name: 'product.index' }" class="btn btn-outline-light btn-lg mt-4 shadow-lg explore-btn">
        Jelajahi Produk
      </router-link>
    </div>

    <!-- Seksi Pilihan Produk -->
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-5 product-section">
      <!-- Produk 1 -->
      <div class="col">
        <div class="card shado1599245494w-lg border-0 rounded-3 product-card">
          <img src="https://img1.wsimg.com/isteam/ip/133dd2a3-6070-41c6-ad94-b7158afddea9/Hexohm%20jejer.jpg/:/cr=t:0%25,l:0%25,w:100%25,h:100%25/rs=w:600,cg:true" class="card-img-top" alt="Produk Vape 1">
          <div class="card-body">
            <h5 class="card-title">Mod Hexohm</h5>
            <p class="card-text text-muted">Mod Gacor.</p>
            <a href="#" target="_blank" class="btn btn-outline-danger">Lihat Detail</a>
          </div>
        </div>
      </div>

      <!-- Produk 2 -->
      <div class="col">
        <div class="card shadow-lg border-0 rounded-3 product-card">
          <img src="https://unionlabs.id/wp-content/uploads/2024/01/ebv2-11mg-1-430x491.jpg" class="card-img-top" alt="Produk Vape 2">
          <div class="card-body">
            <h5 class="card-title">Liquid Vape</h5>
            <p class="card-text text-muted">Pilihan rasa terbaik untuk pengalaman vaping Anda.</p>
            <a href="#" target="_blank" class="btn btn-outline-danger">Lihat Detail</a>
          </div>
        </div>
      </div>

      <!-- Produk 3 -->
      <div class="col">
        <div class="card shadow-lg border-0 rounded-3 product-card">
          <img src="https://via.placeholder.com/350x250" class="card-img-top" alt="Produk Vape 3">
          <div class="card-body">
            <h5 class="card-title">Aksesoris Vape</h5>
            <p class="card-text text-muted">Dapatkan aksesoris lengkap untuk menunjang gaya Anda.</p>
            <a href="#" target="_blank" class="btn btn-outline-danger">Lihat Detail</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Full-screen container */
.full-screen-container {
  height: 100vh;
  background: linear-gradient(to right, #000000, #8b0000, #ffffff);
  animation: gradientAnimation 5s infinite alternate;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 0;
}

/* Hero section */
.hero-section {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  background: rgba(0, 0, 0, 0.7); /* dark overlay */
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
}

/* Shadow text for titles */
.text-shadow {
  text-shadow: 3px 3px 8px rgba(255, 0, 0, 0.6);
}

/* Animation for background gradient */
@keyframes gradientAnimation {
  0% {
    background: linear-gradient(to right, #000000, #8b0000, #ffffff);
  }
  100% {
    background: linear-gradient(to right, #000000, #a00000, #ffffff);
  }
}

/* Explore Button */
.explore-btn {
  background-color: #ffffff;
  color: #8b0000;
  padding: 12px 30px;
  font-size: 1.25rem;
  text-transform: uppercase;
  border-radius: 30px;
  transition: all 0.3s ease;
  border: none;
}

.explore-btn:hover {
  background-color: #8b0000;
  color: white;
}

/* Product Section Styling */
.product-section {
  flex: 2;
  margin-top: 5%;
}

.product-card {
  transition: transform 0.3s ease-in-out;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
}

.product-card:hover {
  transform: scale(1.05);
}

.card-img-top {
  height: 250px;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.product-card:hover .card-img-top {
  transform: scale(1.1);
}

.card-title {
  color: #8b0000;
  font-weight: bold;
}

.card-body {
  padding: 20px;
}

.card-text {
  font-size: 1rem;
  color: #aaa;
}

.card-body a {
  margin-top: 10px;
}

/* Responsive Design */
@media (max-width: 768px) {
  .hero-section {
    height: 50%;
  }
}
</style>
