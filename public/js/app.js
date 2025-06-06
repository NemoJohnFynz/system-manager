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
