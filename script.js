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