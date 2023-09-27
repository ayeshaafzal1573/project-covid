function showFields(role) {
        var adminFields = document.getElementById('adminFields');
        var hospitalFields = document.getElementById('hospitalFields');
        var patientFields = document.getElementById('patientFields');

        adminFields.style.display = 'none';
        hospitalFields.style.display = 'none';
        patientFields.style.display = 'none';

        if (role === 'Admin') {
            adminFields.style.display = 'block';
        } else if (role === 'Hospital') {
            hospitalFields.style.display = 'block';
        } else if (role === 'Patient') {
            patientFields.style.display = 'block';
        }
}
//login validation
     function validateForm() {
      // Get user type and perform validation based on it
      var userType = document.getElementById("user_type").value;

      if (userType === "Admin") {
        var username = document.getElementById("admin_username").value;
        var adminPassword = document.getElementById("admin_password").value;

        if (username === "" || adminPassword === "") {
          alert("Admin Username and Admin Password are required fields.");
          return false;
        }
      } else if (userType === "Hospital") {
        var hospitalName = document.getElementById("hospital_name").value;
        var hospitalPassword = document.getElementById("hospital_password").value;

        if (hospitalName === "" || hospitalPassword === "") {
          alert("Hospital Name and Password are required fields.");
          return false;
        }
      } else if (userType === "Patient") {
        var patientEmail = document.getElementById("patient_email").value;
        var patientPassword = document.getElementById("patient_password").value;

        if (patientEmail === "" || patientPassword === "") {
          alert("Patient Email and Password are required fields.");
          return false;
        }
      }

      return true; // Form is valid, allow submission
}

//   register wrapper
 const wrapper = document.querySelector(".wrapper"),
        signupHeader = document.querySelector(".signup header"),
        loginHeader = document.querySelector(".login header");

      loginHeader.addEventListener("click", () => {
        wrapper.classList.add("active");
      });
      signupHeader.addEventListener("click", () => {
        wrapper.classList.remove("active");
      });
      
//search hospital
    document.addEventListener("DOMContentLoaded", function () {
    const searchForm = document.getElementById("searchForm");
    const searchResults = document.getElementById("searchResults");

    searchForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const location = document.getElementById("location").value;
        const hospitalType = document.getElementById("hospital_type").value;

        // Perform an AJAX request to fetch search results from the server
        fetch(`search_hospital.php?location=${location}&hospital_type=${hospitalType}`)
            .then((response) => response.json())
            .then((data) => {
                // Display search results in the searchResults div
                searchResults.innerHTML = data;
            });
    });
});
