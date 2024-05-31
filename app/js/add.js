document.addEventListener("DOMContentLoaded", function () {
    var SdOpenFormAddButtons = document.getElementById("SdOpenFormAdd");
    var SdModalAdd = document.getElementById("SdMyModalAdd");
    var SdModalAddCloseButton = SdModalAdd.querySelector(".close");

    SdOpenFormAddButtons.addEventListener("click", function () {
        // Mở modal
        SdModalAdd.style.display = "flex";
    });

    SdModalAddCloseButton.addEventListener("click", function () {
        // Tắt modal khi nhấn vào nút close.
        SdModalAdd.style.display = "none";
    });
});
