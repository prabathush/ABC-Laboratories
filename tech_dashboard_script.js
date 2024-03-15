function showUploadedPrescriptions() {
    hideAllContent();
    document.getElementById("uploadedPrescriptionsContent").style.display = "block";
    fetchUploadedPrescriptions();
}

function fetchUploadedPrescriptions() {
    fetch('fetch_uploaded_prescriptions.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(prescriptions => {
            const prescriptionsList = document.getElementById("prescriptionsList");
            prescriptionsList.innerHTML = ""; // Clear previous data
            prescriptions.forEach(prescription => {
                // Generate HTML to display prescription details
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

                // Display images
                prescription.images.forEach(image => {
                    const img = document.createElement("img");
                    img.src = image.url;
                    img.alt = "Prescription Image";
                    prescriptionItem.appendChild(img);
                });

                prescriptionsList.appendChild(prescriptionItem);
            });
        })
        .catch(error => console.error('Error fetching uploaded prescriptions:', error));
}
