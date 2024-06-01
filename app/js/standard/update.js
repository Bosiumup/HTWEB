document.addEventListener("DOMContentLoaded", function () {
    var SdOpenFormUpdateButtons =
        document.querySelectorAll(".SdOpenFormUpdate");
    var sdModal = document.getElementById("sdMyModal");
    var sdModalCloseButton = sdModal.querySelector(".close");

    for (var i = 0; i < SdOpenFormUpdateButtons.length; i++) {
        SdOpenFormUpdateButtons[i].addEventListener("click", function () {
            // Lấy dữ liệu cần thiết từ hàng hiện tại
            var row = this.closest(".row-d");
            var sdPresentID = row.querySelector(".sdPresentID").value;
            var sdPresentName = row.querySelector(".sdPresentName").value;
            var sdPresentPoint = row.querySelector(".sdPresentPoint").value;

            // Thiết lập giá trị cho các ô input trong modal
            document.getElementById("sdOldID").value = sdPresentID;
            document.getElementById("sdFormName").value = sdPresentName;
            document.getElementById("sdFormPoint").value = sdPresentPoint;

            // Mở modal
            sdModal.style.display = "flex";
        });
    }

    sdModalCloseButton.addEventListener("click", function () {
        // Tắt modal khi nhấn vào nút close.
        sdModal.style.display = "none";
    });
});
