function manageTestDetails() {
    showContent("testDetailsContent");
}

function manageInquiries() {
    showContent("inquiriesContent");
}

function manageLabTechnicians() {
    showContent("labTechniciansContent");
}

function manageAppointments() {
    showContent("appointmentsContent");
}

function manageTestResults() {
    showContent("testResultsContent");
}

function managePatients() {
    showContent("patientsContent");
}

function registerLabTechnician() {
    showContent("registerLabTechContent");
}

function addTestDetails() {
    showContent("addTestDetailsContent");
}

function viewAnalytics() {
    showContent("analyticsContent");
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

// Add event listener for delete buttons
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        if (confirm('Are you sure you want to delete this test detail?')) {
            // Call PHP script via AJAX to delete the test detail
            fetch('delete_test_detail.php?id=' + id, {
                method: 'DELETE'
            })
            .then(response => {
                if (response.ok) {
                    // Refresh the page after successful deletion
                    location.reload();
                } else {
                    alert('Failed to delete test detail.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
});
