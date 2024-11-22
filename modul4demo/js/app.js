// Base URL of the backend API
const API_BASE_URL = "http://localhost:8000";

// Add or Update Profile Functionality
async function addOrUpdateProfile() {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const address = document.getElementById("address").value;

    if (!name || !email || !address) {
        alert("Please fill all the fields!");
        return;
    }

    const profileData = {
        name: name,
        email: email,
        address: address
    };

    try {
        const response = await fetch(API_BASE_URL + "?action=profile", {
            method: "POST", // Use POST to create or update the profile
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(profileData),
        });

        const result = await response.json();
        if (response.ok) {
            alert(result.message || "Profile updated successfully.");
            fetchProfile(); // Refresh profile display
        } else {
            alert(result.message || "Failed to update profile.");
        }
    } catch (error) {
        console.error("Error updating profile:", error);
        alert("An error occurred while updating the profile.");
    }
}

// Fetch Profile Data
async function fetchProfile() {
    try {
        const response = await fetch(API_BASE_URL + "?action=profile");
        const profile = await response.json();

        if (response.ok) {
            const { name, email, address } = profile.data || {};
            document.getElementById("name").value = name || "";
            document.getElementById("email").value = email || "";
            document.getElementById("address").value = address || "";

            // Display profile data
            displayProfile(profile);
        } else {
            alert("Failed to fetch profile.");
        }
    } catch (error) {
        console.error("Error fetching profile:", error);
        alert("An error occurred while fetching the profile.");
    }
}


// Display Profile Data
function displayProfile(profile) {
    // Assuming you have elements with these IDs in your HTML
    const profileName = document.getElementById("profileName");
    const profileEmail = document.getElementById("profileEmail");
    const profileAddress = document.getElementById("profileAddress");

    // Validate if elements exist before manipulating them
    if (profileName) profileName.innerText = profile.name;
    if (profileEmail) profileEmail.innerText = profile.email;
    if (profileAddress) profileAddress.innerText = profile.address;
}


// Edit Profile
function editProfile() {
    alert("You can edit the profile by modifying the form fields above and saving.");
    window.scrollTo({ top: 0, behavior: "smooth" });
}

// Delete Profile
async function deleteProfile() {
    if (!confirm("Are you sure you want to delete the profile?")) return;

    try {
        const response = await fetch(API_BASE_URL + "?action=profile", {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
            }
        });

        const result = await response.json();
        if (response.ok) {
            alert(result.message || "Profile deleted successfully.");
            document.getElementById("profileForm").reset(); // Clear form
            fetchProfile(); // Refresh profile display
        } else {
            alert(result.message || "Failed to delete profile.");
        }
    } catch (error) {
        console.error("Error deleting profile:", error);
        alert("An error occurred while deleting the profile.");
    }
}

// Call fetchProfile on page load
document.addEventListener("DOMContentLoaded", fetchProfile);
