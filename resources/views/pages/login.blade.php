<div class="login-container">
    <div class="login-title">Đăng Nhập</div>
    <div class="login-logo">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Logo">
    </div>
    <form id="loginForm" action="/login" method="POST" autocomplete="off">
        @csrf
        <div class="form-group">
            <input
                type="email"
                name="email"
                required
                class="form-input"
                placeholder=" "
                autocomplete="username">
            <label class="form-label">Username</label>
        </div>
        <div class="form-group">
            <input
                type="password"
                name="password"
                required
                class="form-input"
                placeholder=" "
                autocomplete="current-password">
            <label class="form-label">Mật khẩu</label>
        </div>
        <button type="submit" class="login-btn">Đăng Nhập</button>
    </form>
    <div id="error"></div>
</div>
<div class="bg-login">
</div>
<style>
    .login-container {
        max-width: 400px;
        margin: 50px auto;
        padding: 32px 28px 24px 28px;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        animation: fadeIn 1s;
        position: relative;
    }

    .bg-login {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: url('https://socanth.tu.ac.th/ccscs/wp-content/uploads/2016/06/bg.jpg') no-repeat center center;
        background-size: cover;
        z-index: -1;
        /* đảm bảo nó nằm sau các thành phần khác */
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-logo {
        display: flex;
        justify-content: center;
        margin-bottom: 18px;
    }

    .login-logo img {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .login-title {
        text-align: center;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 24px;
        color: #007bff;
        letter-spacing: 1px;
    }

    .form-group {
        position: relative;
        margin-bottom: 20px;
    }

    .form-input {
        display: block;
        width: 100%;
        padding: 12px 14px;
        font-size: 16px;
        border: 1.5px solid #e0e0e0;
        border-radius: 6px;
        background-color: white;
        outline: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
        box-sizing: border-box;
    }

    .form-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }


    .form-label {
        position: absolute;
        left: 14px;
        top: 14px;
        color: #888;
        background: #fff;
        padding: 0 4px;
        font-size: 16px;
        pointer-events: none;
        transition: 0.2s;
    }

    .form-input:focus+.form-label,
    .form-input:not(:placeholder-shown)+.form-label {
        top: -10px;
        left: 10px;
        font-size: 13px;
        color: #007bff;
        background: #fff;
    }

    .login-btn {
        padding: 13px 16px;
        background: linear-gradient(135deg, #4f46e5, #3b82f6);
        color: white;
        font-weight: 600;
        border: none;
        border-radius: 4px;
        width: 100%;
        cursor: pointer;
        font-size: 17px;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .login-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -75%;
        width: 50%;
        height: 100%;
        background: rgba(255, 255, 255, 0.15);
        transform: skewX(-20deg);
        transition: left 1s ease;
        z-index: 1;
    }

    .login-btn:hover::before {
        left: 125%;
    }

    .login-btn:hover {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        transform: translateY(-1px) scale(1.004);
        box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
    }

    #error {
        color: #dc3545;
        margin-top: 18px;
        min-height: 24px;
        text-align: center;
        font-size: 15px;
        font-weight: 500;
        letter-spacing: 0.5px;
    }
</style>
<script src="{{ asset('js/login.js') }}"></script>