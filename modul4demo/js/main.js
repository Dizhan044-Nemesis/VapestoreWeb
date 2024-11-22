const apiUrl = "http://localhost:8000";

// Fetch all products and render them
async function fetchProducts() {
    const response = await fetch(apiUrl);
    const products = await response.json();
    const productGrid = document.querySelector('.product-grid');
    productGrid.innerHTML = '';

    products.forEach(product => {
        const productCard = document.createElement('div');
        productCard.className = 'product-card';
        productCard.innerHTML = `
            <img src="${product.image_url}" alt="${product.name}">
            <h3>${product.name}</h3>
            <p>IDR ${product.price}</p>
            <p>${product.description || ''}</p>
            <button class="btn edit" onclick="editProduct(${product.id})">Edit</button>
            <button class="btn delete" onclick="deleteProduct(${product.id})">Delete</button>
        `;
        productGrid.appendChild(productCard);
    });
}

// Add or update product
async function saveProduct(event) {
    event.preventDefault();

    const id = document.getElementById('product-id').value;
    const name = document.getElementById('name').value;
    const description = document.getElementById('description').value;
    const price = document.getElementById('price').value;
    const imageUrl = document.getElementById('image_url').value;

    const product = { name, description, price, image_url: imageUrl };

    if (id) {
        // Update product
        const response = await fetch(`${apiUrl}?id=${id}`, {
            method: "PUT",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(product),
        });
        const result = await response.json();
        if (result.success) {
            alert("Product updated successfully!");
        } else {
            alert("Error updating product.");
        }
    } else {
        // Add new product
        const response = await fetch(apiUrl, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(product),
        });
        const result = await response.json();
        if (result.success) {
            alert("Product added successfully!");
        } else {
            alert("Error adding product.");
        }
    }

    document.getElementById('product-form').reset();
    document.getElementById('form-title').innerText = "Add New Product";
    fetchProducts();
}

// Populate form with product data for editing
async function editProduct(id) {
    const response = await fetch(`${apiUrl}?id=${id}`);
    const product = await response.json();

    document.getElementById('product-id').value = product.id;
    document.getElementById('name').value = product.name;
    document.getElementById('description').value = product.description;
    document.getElementById('price').value = product.price;
    document.getElementById('image_url').value = product.image_url;

    document.getElementById('form-title').innerText = "Edit Product";
}

// Delete product
async function deleteProduct(id) {
    if (confirm("Are you sure you want to delete this product?")) {
        const response = await fetch(`${apiUrl}?id=${id}`, {
            method: "DELETE",
        });
        const result = await response.json();
        if (result.success) {
            alert("Product deleted successfully!");
            fetchProducts();
        } else {
            alert("Error deleting product.");
        }
    }
}

// Initialize page
document.getElementById('product-form').addEventListener('submit', saveProduct);
document.addEventListener('DOMContentLoaded', fetchProducts);
