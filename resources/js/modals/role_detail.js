// Giả lập API dữ liệu role
function get_role_detail(roleId = 1) {
    return Promise.resolve({
        id: 1,
        role_name: "admin",
        permissions: [
            { id: 1, name: "Thêm phần cứng", description: "Cho phép thêm các thiết bị phần cứng" },
            { id: 2, name: "Thêm phần mềm", description: "Cho phép thêm phần mềm quản lý" },
        ],
    });
}

function get_all_permission() {
    return Promise.resolve([
        { id: 1, name: "Thêm phần cứng", type: "hardware", description: "Cho phép thêm các thiết bị phần cứng" },
        { id: 2, name: "Thêm phần mềm", type: "hardware", description: "Cho phép thêm phần mềm quản lý" },
        { id: 3, name: "Xem báo cáo", type: "hardware", description: "Truy cập báo cáo thống kê hệ thống" },
        { id: 4, name: "Quản lý tài khoản", type: "hardware", description: "Thêm, sửa, xóa người dùng" },
        { id: 5, name: "Cấu hình hệ thống", type: "hardware", description: "Chỉnh sửa các thiết lập hệ thống" },
    ]);
}

function update_role_permission(roleId, permissionIds) {
    console.log("Cập nhật role", roleId, "với permission", permissionIds);
    return Promise.resolve(true);
}

// Khởi tạo modal edit permission
async function initRoleDetailModal() {
    const permissionForm = document.getElementById("permission-form");
    const permissionContainer = document.getElementById("permission-checkboxes");
    const roleNameEl = document.getElementById("role-name");
    const roleId = 1;

    if (!permissionForm) {
        console.error("Không tìm thấy form edit permission");
        return;
    }

    if (permissionForm.dataset.initialized) return;
    permissionForm.dataset.initialized = "true";

    try {
        const [roleData, allPermissions] = await Promise.all([
            get_role_detail(roleId),
            get_all_permission(),
        ]);

        roleNameEl.textContent = roleData.role_name;
        renderPermissionTable(allPermissions, roleData.permissions.map(p => p.id));
    } catch (err) {
        console.error("Lỗi khi load dữ liệu role/permission:", err);
        alert("Không thể tải dữ liệu");
    }

    permissionForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const selected = Array.from(document.querySelectorAll("#permission-checkboxes input[type=checkbox]:checked"))
            .map(input => parseInt(input.value));

        try {
            await update_role_permission(roleId, selected);
            alert("Cập nhật permission thành công");
            $("#addPermissionModal").modal("hide");
            window.dispatchEvent(new CustomEvent("rolePermissionUpdated"));
        } catch (err) {
            console.error(err);
            alert(err.message || "Đã có lỗi xảy ra");
        }
    });
}

function renderPermissionTable(allPermissions, rolePermissions) {
    const permissionContainer = document.getElementById("permission-checkboxes");
    permissionContainer.innerHTML = "";

    const table = document.createElement("table");
    table.className = "table table-bordered table-striped";

    table.innerHTML = `
        <thead>
            <tr>
                <th>Select</th>
                <th>Tên Permission</th>
                <th>Loại</th>
                <th>Ngày</th>
            </tr>
        </thead>
        <tbody>
            ${allPermissions.map(p => `
                <tr>
                    <td>
                        <input type="checkbox" class="form-check-input" value="${p.id}" ${rolePermissions.includes(p.id) ? 'checked' : ''}>
                    </td>
                    <td>${p.name}</td>
                    <td>${p.type || 'unknown'}</td>
                    <td>${new Date().toLocaleDateString()}</td>
                </tr>
            `).join('')}
        </tbody>
    `;

    permissionContainer.appendChild(table);
}

// Gọi khi window load
window.initRoleDetailModal = initRoleDetailModal;
