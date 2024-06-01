document.addEventListener("DOMContentLoaded", function () {
    function handleModal(modalId, triggerId) {
        var openFormAddButton = document.getElementById(triggerId);
        var modal = document.getElementById(modalId);
        var modalCloseButton = modal.querySelector(".close");

        openFormAddButton.addEventListener("click", function () {
            modal.style.display = "flex";
        });

        modalCloseButton.addEventListener("click", function () {
            modal.style.display = "none";
        });
    }

    handleModal("CtMyModalAdd", "CtOpenFormAdd");
});
