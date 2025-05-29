document.addEventListener("DOMContentLoaded", () => {
    initLoginForm();
    initDeleteButton();
    initUpdateProfile();
    initOtherFeature();
});

function initLoginForm() {
    const form = document.getElementById("loginForm");
    if (!form) return;

    const errorDiv = document.getElementById("error");
    const csrfToken = getCsrfToken();

    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        errorDiv.textContent = "";

        const formData = new FormData(form);

        try {
            const res = await fetch(form.action, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    Accept: "application/json",
                },
                body: formData,
            });

            const data = await res.json();

            // $credentials = $request->only('email', 'password');

            // if (Auth::attempt($credentials)) {
            //     $user = Auth::user();
            //     session(['user' => $user]); // lưu user vào session
            //     return response()->json([
            //         'message' => 'Đăng nhập thành công',
            //         'user' => $user,
            //         'redirect' => '/dashboard'
            //     ]);
            // }
            //     session()->forget('user'); // hoặc
            // session()->flush(); // xóa toàn bộ session

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

function initDeleteButton() {
    const btn = document.getElementById("deleteButton");
    if (!btn) {
        console.log("Không tìm thấy deleteButton");
        return;
    }

    console.log("Đã gán sự kiện cho deleteButton");

    btn.addEventListener("click", async () => {
        if (!confirm("Tính năng đang phát triển?")) return;

        try {
            const res = await fetch("/api/delete-item", {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": getCsrfToken(),
                    Accept: "application/json",
                },
            });
        } catch {
            alert("Lỗi server");
        }
    });
}

// use Illuminate\Support\Facades\Auth;

// public function login(Request $request)
// {
//     $credentials = $request->only('email', 'password');

//     if (Auth::attempt($credentials)) {
//         // Tự động lưu thông tin user vào session
//         $request->session()->regenerate();

//         return response()->json([
//             'message' => 'Đăng nhập thành công',
//             'redirect' => '/dashboard'
//         ]);
//     }

//     return response()->json(['message' => 'Thông tin không đúng'], 401);
// }


// Auth::logout();
// $request->session()->invalidate();
// $request->session()->regenerateToken();

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth');



function initUpdateProfile() {
    // Viết logic update hồ sơ người dùng nếu có
}

function initOtherFeature() {
    // Viết logic thêm nếu có nhiều nút khác nhau
}

function getCsrfToken() {
    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
    return tokenMeta ? tokenMeta.content : "";
}
