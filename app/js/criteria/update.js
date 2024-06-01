document.addEventListener("DOMContentLoaded", function () {
    var CtOpenFormUpdateButtons =
        document.querySelectorAll(".CtOpenFormUpdate");
    var ctModal = document.getElementById("ctMyModal");
    var ctModalCloseButton = ctModal.querySelector(".close");

    for (var i = 0; i < CtOpenFormUpdateButtons.length; i++) {
        CtOpenFormUpdateButtons[i].addEventListener("click", function () {
            // Lấy dữ liệu cần thiết từ hàng hiện tại
            var row = this.closest(".row-d");
            var sdPresentID = row.querySelector(".sdPresentID").value;
            var ctPresentID = row.querySelector(".ctPresentID").value;
            var ctPresentName = row.querySelector(".ctPresentName").value;
            var ctPresentPoint = row.querySelector(".ctPresentPoint").value;

            // Thiết lập giá trị cho các ô input trong modal
            document.getElementById("sdOldID").value = sdPresentID;
            document.getElementById("ctOldID").value = ctPresentID;
            document.getElementById("ctFormName").value = ctPresentName;
            document.getElementById("ctFormPoint").value = ctPresentPoint;

            // Mở modal
            ctModal.style.display = "flex";
        });
    }

    ctModalCloseButton.addEventListener("click", function () {
        // Tắt modal khi nhấn vào nút close.
        ctModal.style.display = "none";
    });
});
