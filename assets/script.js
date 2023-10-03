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
