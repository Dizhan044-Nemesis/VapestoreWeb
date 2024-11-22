// Modal control
const profileLink = document.getElementById('profile-link');
const modal = document.getElementById('profile-modal');
const closeBtn = document.querySelector('.close');

profileLink.addEventListener('click', () => {
    modal.style.display = 'block';
});

closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
});

window.addEventListener('click', (e) => {
    if (e.target == modal) {
        modal.style.display = 'none';
    }
});

// Profile data
let profileData = {};

// CRUD Operations
const createBtn = document.getElementById('create-btn');
const updateBtn = document.getElementById('update-btn');
const deleteBtn = document.getElementById('delete-btn');
const profileDisplay = document.getElementById('profile-display');

createBtn.addEventListener('click', () => {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const address = document.getElementById('address').value;

    if (name && email && address) {
        profileData = { name, email, address };
        displayProfile();
        resetForm();
    } else {
        alert('All fields are required!');
    }
});

updateBtn.addEventListener('click', () => {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const address = document.getElementById('address').value;

    if (name && email && address) {
        profileData = { name, email, address };
        displayProfile();
        resetForm();
    } else {
        alert('All fields are required!');
    }
});

deleteBtn.addEventListener('click', () => {
    profileData = {};
    profileDisplay.innerHTML = '<p>No profile data available.</p>';
    resetForm();
});

function displayProfile() {
    profileDisplay.innerHTML = `
        <p><strong>Name:</strong> ${profileData.name}</p>
        <p><strong>Email:</strong> ${profileData.email}</p>
        <p><strong>Address:</strong> ${profileData.address}</p>
    `;
    createBtn.style.display = 'none';
    updateBtn.style.display = 'inline-block';
    deleteBtn.style.display = 'inline-block';
}

function resetForm() {
    document.getElementById('profile-form').reset();
}
