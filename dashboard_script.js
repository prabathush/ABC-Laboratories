// Function to display user profile details
function showProfile() {
    fetch('fetch_user_data.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(profile => {
            const profileDetails = document.getElementById("profileContent");
            profileDetails.innerHTML = `
                <p>Name         : ${profile.name}</p>
                <p>Email        : ${profile.email}</p>
                <p>Address      : ${profile.address}</p>
                <p>Contact      : ${profile.contact}</p>
                <p>Date of Birth: ${profile.dob}</p>
                <!-- Add more profile fields here -->
            `;
        })
        .catch(error => {
            console.error('Error fetching profile details:', error);
            // Display an error message to the user
            alert('Error fetching profile details. Please try again later.');
        });
}

// Function to display prescriptions
function displayPrescriptions() {
    fetch('fetch_prescriptions.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(prescriptions => {
            const prescriptionsContent = document.getElementById("viewPrescriptionsContent");
            prescriptionsContent.innerHTML = `
                <h2>View Prescriptions</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Note</th>
                            <th>Delivery Address</th>
                            <th>Delivery Time</th>
                            <!-- Add more table headers as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        ${prescriptions.map(prescription => `
                            <tr>
                                <td>${prescription.note}</td>
                                <td>${prescription.delivery_address}</td>
                                <td>${prescription.delivery_time}</td>
                                <!-- Add more table cells as needed -->
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            `;
        })
        .catch(error => {
            console.error('Error fetching prescriptions:', error);
            // Display an error message to the user
            alert('Error fetching prescriptions. Please try again later.');
        });
}

// Function to fetch and display quotations
function showQuotations() {
    hideAllContent();
    document.getElementById("quotationsContent").style.display = "block";
    fetchQuotations(); // Call function to fetch and display quotations
}



// Function to handle user logout
function showLogout() {
    fetch('logout.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Logout request failed');
            }
            // Redirect to login page after logout
            window.location.href = 'index.php';
        })
        .catch(error => {
            console.error('Error logging out:', error);
            // Display an error message to the user
            alert('Error logging out. Please try again later.');
        });
}

// Function to hide all content sections
function hideAllContent() {
    document.getElementById("profileContent").style.display = "none";
    document.getElementById("uploadPrescriptionContent").style.display = "none";
    document.getElementById("viewPrescriptionsContent").style.display = "none";
    document.getElementById("quotationsContent").style.display = "none";
}



function showViewPrescriptions() {
    hideAllContent();
    document.getElementById("viewPrescriptionsContent").style.display = "block";
    displayPrescriptions();
}

function displayPrescriptions() {
fetch('fetch_prescriptions.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(prescriptions => {
        const prescriptionsList = document.getElementById("viewPrescriptionsContent");
        prescriptionsList.innerHTML = ""; // Clear previous data
        prescriptions.forEach(prescription => {
            const prescriptionItem = document.createElement("div");
            prescriptionItem.classList.add("prescription-item");

            const header = document.createElement("h3");
            header.textContent = `Prescription ID: ${prescription.id}`;
            prescriptionItem.appendChild(header);

            const note = document.createElement("p");
            note.textContent = `Note: ${prescription.note}`;
            prescriptionItem.appendChild(note);

            const address = document.createElement("p");
            address.textContent = `Delivery Address: ${prescription.delivery_address}`;
            prescriptionItem.appendChild(address);

            const time = document.createElement("p");
            time.textContent = `Delivery Time: ${prescription.delivery_time}`;
            prescriptionItem.appendChild(time);

            prescriptionsList.appendChild(prescriptionItem);
        });
    })
    .catch(error => console.error('Error fetching prescriptions:', error));
}

