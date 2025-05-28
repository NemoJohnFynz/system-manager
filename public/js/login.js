document.addEventListener('DOMContentLoaded', () => {
  initLoginForm();
  initDeleteButton();
  initUpdateProfile();
  initOtherFeature();
});

function initLoginForm() {
  const form = document.getElementById('loginForm');
  if (!form) return;

  const errorDiv = document.getElementById('error');
  const csrfToken = getCsrfToken();

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    errorDiv.textContent = '';

    const formData = new FormData(form);

    try {
      const res = await fetch(form.action, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
        },
        body: formData,
      });

      const data = await res.json();

      if (res.ok) {
        alert(data.message || 'Đăng nhập thành công!');
        window.location.href = data.redirect;
      } else {
        errorDiv.textContent = data.message || 'Đăng nhập thất bại';
      }
    } catch {
      errorDiv.textContent = 'Lỗi server, vui lòng thử lại sau.';
    }
  });
}

function initDeleteButton() {
  const btn = document.getElementById('deleteButton');
  if (!btn) {
    console.log('Không tìm thấy deleteButton');
    return;
  }

  console.log('Đã gán sự kiện cho deleteButton');


  btn.addEventListener('click', async () => {
    if (!confirm('Tính năng đang phát triển?')) return;

    try {
      const res = await fetch('/api/delete-item', {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': getCsrfToken(),
          'Accept': 'application/json'
        }
      });
    } catch {
      alert('Lỗi server');
    }
  });
}

function initUpdateProfile() {
  // Viết logic update hồ sơ người dùng nếu có
}

function initOtherFeature() {
  // Viết logic thêm nếu có nhiều nút khác nhau
}

function getCsrfToken() {
  const tokenMeta = document.querySelector('meta[name="csrf-token"]');
  return tokenMeta ? tokenMeta.content : '';
}
