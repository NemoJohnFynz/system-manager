const token = localStorage.getItem("jwt_token");
if (token) {
    // Ghi đè hàm fetch để luôn thêm Authorization
    const originalFetch = window.fetch;
    window.fetch = function (url, options = {}) {
        options.headers = options.headers || {};
        options.headers["Authorization"] = "Bearer " + token;
        return originalFetch(url, options);
    };
}
function loadModal(modalName) {
    fetch("/modal/" + modalName)
        .then((res) => res.text())
        .then((html) => {
            document.getElementById("modalContent").innerHTML = html;
            new bootstrap.Modal(
                document.getElementById("modalContainer")
            ).show();
        });
}
