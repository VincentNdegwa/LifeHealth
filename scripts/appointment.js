document.addEventListener("DOMContentLoaded", () => {
    const schedule_buttons = document.querySelectorAll('.schedule_button');
    schedule_buttons.forEach(element => {
        element.addEventListener("click", () => {
            let overlay = document.querySelector(".overlay");
            overlay.style.display = 'flex'
            let id_input = overlay.querySelector(".id_input")
            id_input.value = element.value
        })
    });
})

function showAppointmentOverlay(patientId) {
    let overlay = document.querySelector("#appointmentOverlay");
    console.log(overlay)


}

function showDoctorList() {
    document.getElementById('appointmentOverlay').style.display = 'none';
    alert('Select Doctor Overlay - Replace with Doctor List and Selection');
}

function removerOverlay() {
    document.getElementById('appointmentOverlay').style.display = 'none';
}