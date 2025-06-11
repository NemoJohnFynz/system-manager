import { create_user } from "../api/user";

function initUserCreateModal() {
    console.log("Khởi tạo modal tạo user");
    const createUserForm = document.getElementById("create-user-form");
    if (!createUserForm) {
        console.error("Không tìm thấy form tạo user");
        return;
    }

    if (createUserForm.dataset.initialized) return;
    createUserForm.dataset.initialized = "true";

    createUserForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(createUserForm);
        const data = Object.fromEntries(formData.entries());

        if (data.password !== data.verifyPassword) {
            alert("Mật khẩu không khớp!");
            return;
        }

        const roles = [
            ...document.querySelectorAll("#role-checkboxes input:checked"),
        ].map((el) => el.value);

        try {
            await create_user({
                username: data.username,
                password: data.password,
                roles: roles,
            });

            alert("Tạo người dùng thành công");
            $("#createUserModal").modal("hide");
            window.dispatchEvent(new CustomEvent("userCreated"));
        } catch (err) {
            console.error(err);
            alert(err.message || "Đã có lỗi xảy ra");
        }
    });
}

// Đưa hàm lên global
window.initUserCreateModal = initUserCreateModal;
