// Date validation for rental forms
document.addEventListener('DOMContentLoaded', function() {
    const fechaInicio = document.getElementById('inicio');
    const fechaFin = document.getElementById('final');

    if (fechaInicio && fechaFin) {
        fechaInicio.addEventListener('change', function() {
            fechaFin.min = fechaInicio.value;
            if (fechaFin.value && fechaFin.value < fechaInicio.value) {
                fechaFin.value = '';
            }
        });

        fechaFin.addEventListener('change', function() {
            if (fechaFin.value && fechaFin.value < fechaInicio.value) {
                alert('La fecha de fin no puede ser anterior a la fecha de inicio.');
                fechaFin.value = '';
            }
        });
    }
});
