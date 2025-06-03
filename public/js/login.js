document.addEventListener("DOMContentLoaded", () => {
    initLoginForm(); 
});
console.log("Login script loaded");
function initLoginForm() {
    const form = document.getElementById("loginForm");
    if (!form) return;
    const errorDiv = document.getElementById("error");
    const csrfToken = " getCsrfToken()";
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        errorDiv.textContent = "";
        const formData = new FormData(form);
        try {
            const res = await fetch("/api/login", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    Accept: "application/json",
                },
                body: formData,
            });
            const data = await res.json();

            if (res.ok) {
                alert(data.message || "Đăng nhập thành công!");
                window.location.href = data.redirect;
            } else {
                errorDiv.textContent = data.message || "Đăng nhập thất bại";
            }
        } catch {
            errorDiv.textContent = "Lỗi server, vui lòng thử lại sau.";
        }
    });
} 