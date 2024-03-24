// Function to display user profile details
function showPatient() {
    showContent("profileContent");
}

function showAppointments() {
    document.getElementById("appointmentsContent").style.display = "block";
    showContent("appointmentsContent");

}
function showUploadPrescription() {
    document.getElementById("profileContent").style.display = "none";
    document.getElementById("uploadPrescriptionContent").style.display = "block";
    document.getElementById("viewPrescriptionsContent").style.display = "none";
    document.getElementById("quotationsContent").style.display = "none";
    document.getElementById("appointmentsContent").style.display = "none";
    document.getElementById("inquiriesContent").style.display = "none";
    document.getElementById("testresultsContent").style.display = "none";

}


function showInquiries() {
    document.getElementById("inquiriesContent").style.display = "block";
    showContent("inquiriesContent");

}

function showTestresults() {
    hideAllContent();
    document.getElementById("testresultsContent").style.display = "block";

    fetch('fetch_test_results.php') // Replace 'fetch_test_results.php' with your server-side script URL
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(testResults => {
            if (testResults.length > 0) {
                const testResultsTable = document.createElement('table');
                testResultsTable.innerHTML = `
                    <thead>
                        <tr>
                            <th>Test Name</th>
                            <th>Test Date</th>
                            <th>Result</th>
                            <th>Remarks</th>
                            <th>technician_name</th>
                            <th>doctor_name</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${testResults.map(result => `
                            <tr>
                                <td>${result.test_name}</td>
                                <td>${result.test_date}</td>
                                <td>${result.result}</td>
                                <td>${result.remarks}</td>
                                <td>${result.technician_name}</td>
                                <td>${result.doctor_name}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                `;
                const testResultsContent = document.getElementById("testresultsContent");
                testResultsContent.innerHTML = ''; // Clear previous content
                testResultsContent.appendChild(testResultsTable);
            } else {
                const testResultsContent = document.getElementById("testresultsContent");
                testResultsContent.innerHTML = '<p>No test results found.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching test results:', error);
            // Display an error message to the user or handle it as needed
            const testResultsContent = document.getElementById("testresultsContent");
            testResultsContent.innerHTML = '<p>Error fetching test results. Please try again later.</p>';
        });
}





function showContent(contentId) {
    // Hide all content sections
    var contents = document.querySelectorAll(".content");
    contents.forEach(function(content) {
        content.style.display = "none";
    });

    // Show the selected content section
    var selectedContent = document.getElementById(contentId);
    if (selectedContent) {
        selectedContent.style.display = "block";
    } else {
        console.error("Content section not found:", contentId);
    }
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
    document.getElementById("inquiriesContent").style.display = "none";
}



// Function to handle user logout
function showLogout() {
    fetch('logout.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Logout request failed');
            }
            // Redirect to login page after logout
            window.location.href = 'userlogin.php';
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
    document.getElementById("appointmentsContent").style.display = "none";
    document.getElementById("inquiriesContent").style.display = "none";
    document.getElementById("testresultsContent").style.display = "none";

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

