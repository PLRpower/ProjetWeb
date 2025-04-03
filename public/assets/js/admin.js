function toggleDelete($id) {
    let popup = document.querySelector("#popUpDeleteOverlay");
    let idOffer = document.getElementById("idOffer");
    idOffer.value = $id;
    popup.classList.toggle("active");
}