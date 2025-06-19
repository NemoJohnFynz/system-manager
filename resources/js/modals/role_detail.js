import {
    get_all_permission_by_role_name,
    get_all_permission as get_all_per,
    delete_role_permission,
    create_role_permission,
    create_permission,
    permissionTypes,
    permissionActions,
} from "../api/role";
let selectedPermissionsGlobal = new Set(); // chứa normalize(permission_name)

// Tạo danh sách tất cả các permission nên có
function generateExpectedPermissions() {
    const result = [];

    for (const type of permissionTypes) {
        for (const action of permissionActions) {
            result.push({
                permissions_name: `${action} ${type.toLowerCase()}`,
                type: type,
                description: "",
            });
        }
    }

    return result;
}
let allPermissionsGlobal = [];
let rolePermissionsGlobal = [];

// Chuẩn hóa string
const normalize = (str) =>
    (str || "").trim().toLowerCase().replace(/\s+/g, " "); // Chuẩn hoá khoảng trắng giữa các từ

// Lấy quyền của role
async function get_role_detail(data) {
    try {
        const res = await get_all_permission_by_role_name(data.role_name);
        console.log({ role: data, permissions: res })
        return { role: data, permissions: res };
    } catch (err) {
        console.error("Lỗi khi tải quyền role:", err);
    }
}

// Lấy tất cả permission
async function get_all_permission() {
    try {
        return await get_all_per();
    } catch (err) {
        console.error("Lỗi khi tải toàn bộ permission:", err);
    }
}

// Cập nhật quyền cho role
function update_role_permission(roleId, permissionIds) {
    console.log("Cập nhật role", roleId, "với quyền", permissionIds);
    return Promise.resolve(true);
}
function renderTypeOptions(selected = "") {
    const selectEl = document.getElementById("filter-type");
    if (!selectEl) return;

    // Xóa hết options cũ
    selectEl.innerHTML = "";

    // Thêm option "Tất cả loại"
    const allOption = document.createElement("option");
    allOption.value = "";
    allOption.textContent = "Tất cả loại";
    selectEl.appendChild(allOption);

    // Thêm các permissionTypes
    for (const type of permissionTypes) {
        const option = document.createElement("option");
        option.value = type;
        option.textContent = type;
        if (type === selected) option.selected = true;
        selectEl.appendChild(option);
    }
}

function renderTableRow(p, isChecked, isMissing = false, roleName) {
    const name = p.permissions_name;
    const isExisting = allPermissionsGlobal.some(
        (perm) => normalize(perm.permissions_name) === normalize(name)
    );

    if (!isExisting) {
        console.log("Permission exists:", name, allPermissionsGlobal);
    }

    if (!isExisting) {
        const normalized = normalize(p.permissions_name);
        return `
            <tr class="bg-light text-muted">
            <td>
            </td> 
                <td>
                    <span class="font-italic text-dark">
                        <i class="mdi mdi-alert-circle-outline text-warning mr-1"></i>
                        ${p.permissions_name}
                    </span>
                </td>
                <td>
                    <span class="badge badge-secondary">${p.type || "Không xác định"}</span>
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-success create-missing-permission-btn shadow-sm"
                        data-role="${roleName}" 
                        data-permission="${p.permissions_name}"
                        data-type="${p.type || ""}" 
                        data-description="${p.description || ""}">
                        <i class="mdi mdi-plus-circle-outline mr-1"></i> Tạo permission
                    </button>
                </td>
            </tr>

    `;
    }

    return `
            <tr>
                <td class="align-middle">
                    <div class="custom-control custom-checkbox text-center">
                        <input 
                            type="checkbox" 
                            class="custom-control-input" 
                            id="${name}" 
                            value="${name}" 
                            ${isChecked ? "checked" : ""}
                        >
                        <label class="custom-control-label" for="${name}"></label>
                    </div>
                </td>
                <td>
                    <span class="font-weight-bold text-dark">
                        <i class="mdi mdi-shield-key-outline text-primary mr-1"></i>
                        ${name}
                    </span>
                </td>
                <td>
                    <span class="badge badge-info">${p.type || "Không xác định"}</span>
                </td>
                <td>
                    ${p.description ? `<span class="text-muted">${p.description}</span>` : '<span class="text-muted fst-italic">Không có mô tả</span>'}
                </td>
            </tr>

    `;
}
function renderPermissionTable(permissions, selectedNames, roleName = "") {
    const container = document.getElementById("permission-checkboxes");
    container.innerHTML = "";
    renderTypeOptions();

    // Cập nhật tạm thời selectedPermissionsGlobal từ selectedNames (nếu chưa có)
    if (selectedPermissionsGlobal.size === 0) {
        selectedNames.forEach((name) => selectedPermissionsGlobal.add(name));
    }

    // Nhóm theo type
    const grouped = {};
    for (const p of permissions) {
        const type = p.type || "Không xác định";
        if (!grouped[type]) grouped[type] = [];
        grouped[type].push(p);
    }

    const groupTables = Object.entries(grouped)
        .map(([type, groupPermissions]) => {
            const rows = groupPermissions.map((p) => {
                const normalized = normalize(p.permissions_name);
                const isKnown = allPermissionsGlobal.some(
                    (perm) => normalize(perm.permissions_name) === normalized
                );
                const isChecked = selectedPermissionsGlobal.has(normalized);
                const isMissing = !isKnown;

                return renderTableRow(p, isChecked, isMissing, roleName);
            });

            return `
            <div class="mb-4">
                <h5 class="text-primary mb-2 border-bottom pb-1">${type}</h5>
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Chọn</th>
                            <th>Tên Permission</th>
                            <th>Loại</th>
                            <th>Mô tả / Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${rows.join("")}
                    </tbody>
                </table>
            </div>
        `;
        })
        .join("");

    container.innerHTML = groupTables;

    // Gắn sự kiện checkbox cập nhật selectedPermissionsGlobal
    container.querySelectorAll('input[type="checkbox"]').forEach((checkbox) => {
        checkbox.addEventListener("change", () => {
            const value = normalize(checkbox.value);
            if (checkbox.checked) {
                selectedPermissionsGlobal.add(value);
            } else {
                selectedPermissionsGlobal.delete(value);
            }
        });
    });

    // Gắn lại nút tạo permission
    document
        .querySelectorAll(".create-missing-permission-btn")
        .forEach((btn) => {
            btn.addEventListener("click", async function (event) {
                event.preventDefault();
                const permissionName = this.dataset.permission;
                const permissionType = this.dataset.type;
                const permissionDescription = this.dataset.description;
                const roleName = this.dataset.role;

                try {
                    await create_permission({
                        permissions_name: permissionName,
                        type: permissionType,
                        description: permissionDescription,
                    });

                    alert(`Đã tạo permission "${permissionName}"`);

                    const [roleData, allPermissions] = await Promise.all([
                        get_role_detail({ role_name: roleName }),
                        get_all_permission(),
                    ]);

                    allPermissionsGlobal = allPermissions;
                    rolePermissionsGlobal = roleData.permissions.map((p) =>
                        normalize(p.permission_name)
                    );

                    const expectedPermissions = generateExpectedPermissions();
                    renderPermissionTable(
                        expectedPermissions,
                        rolePermissionsGlobal,
                        roleName
                    );
                    renderPermissionList(roleData.permissions);
                } catch (err) {
                    console.error("Lỗi khi tạo permission:", err);
                    alert("Lỗi khi tạo permission: " + err.message);
                }
            });
        });
}

// function renderPermissionTable(permissions, selectedNames) {
//     const container = document.getElementById("permission-checkboxes");
//     container.innerHTML = "";

//     // Nhóm theo type
//     const grouped = {};
//     for (const p of permissions) {
//         const type = p.type || "Không xác định";
//         if (!grouped[type]) grouped[type] = [];
//         grouped[type].push(p);
//     }

//     // Tạo table cho từng nhóm
//     const groupTables = Object.entries(grouped)
//         .map(([type, groupPermissions]) => {
//             const rows = groupPermissions.map((p) =>
//                 renderTableRow(p, selectedNames.includes(normalize(p.permissions_name)))
//             );

//             return `
//                 <div class="mb-4">
//                     <h5 class="text-primary mb-2 border-bottom pb-1">${type}</h5>
//                     <table class="table table-hover table-bordered align-middle text-center">
//                         <thead class="table-light">
//                             <tr>
//                                 <th>Chọn</th>
//                                 <th>Tên Permission</th>
//                                 <th>Loại</th>
//                                 <th>Mô tả</th>
//                             </tr>
//                         </thead>
//                         <tbody>
//                             ${rows.join("")}
//                         </tbody>
//                     </table>
//                 </div>
//             `;
//         })
//         .join("");

//     container.innerHTML = groupTables;
// }

// Render danh sách permission đã có
function renderPermissionList(permissions) {
    const list = document.getElementById("permission-list");
    list.innerHTML = permissions.length
        ? permissions
              .map(
                  (p) => `
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>${p.permission_name}</span>
                <span class="badge badge-info">${
                    p.description || "Không có mô tả"
                }</span>
            </li>
        `
              )
              .join("")
        : "<li>Chưa có permission nào</li>";
}

// Lọc permission theo filter
function applyFilters() {
    const nameFilter = normalize(document.getElementById("filter-name").value);
    const typeFilter = document.getElementById("filter-type").value;
    const selectedFilter = document.getElementById("filter-selected").value;

    const filtered = generateExpectedPermissions().filter((p) => {
        const name = normalize(p.permissions_name);
        const type = p.type || "";
        const isSelected = rolePermissionsGlobal.includes(name);

        const matchName = name.includes(nameFilter);
        const matchType = typeFilter ? type === typeFilter : true;
        const matchSelected =
            selectedFilter === "selected"
                ? isSelected
                : selectedFilter === "unselected"
                ? !isSelected
                : true;

        return matchName && matchType && matchSelected;
    });

    renderPermissionTable(filtered, rolePermissionsGlobal);
}

// Gắn sự kiện lọc
function bindFilterEvents() {
    ["filter-name", "filter-type", "filter-selected"].forEach((id) =>
        document.getElementById(id).addEventListener("input", applyFilters)
    );
}

// Khởi tạo modal quyền
async function initRoleDetailModal(data) {
    const form = document.getElementById("permission-form");
    if (!form || form.dataset.initialized) return;
    form.dataset.initialized = "true";
            selectedPermissionsGlobal = new Set(rolePermissionsGlobal); // <-- reset lại đúng

    const roleNameEl = document.getElementById("role-name");

    try {
        const [roleData, allPermissions] = await Promise.all([
            get_role_detail(data),
            get_all_permission(),
        ]);

        allPermissionsGlobal = allPermissions;
        rolePermissionsGlobal = roleData.permissions.map((p) =>
            normalize(p.permission_name)
        );
        roleNameEl.textContent = roleData.role.role_name;
        // renderPermissionTable(allPermissionsGlobal, rolePermissionsGlobal);
        const expectedPermissions = generateExpectedPermissions();
        renderPermissionTable(
            expectedPermissions,
            rolePermissionsGlobal,
            data.role_name
        );

        renderPermissionList(roleData.permissions);
        bindFilterEvents();
    } catch (err) {
        console.error("Lỗi khi load dữ liệu:", err);
        alert("Không thể tải dữ liệu.");
    }
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const activeElement = document.activeElement;
        if (
            activeElement &&
            activeElement.classList.contains("create-role-permission-btn")
        ) {
            return;
        }
        const selected = Array.from(selectedPermissionsGlobal); // <-- lấy từ Set
        const removed = rolePermissionsGlobal.filter(
            (oldPerm) => !selected.includes(oldPerm)
        );
        const added = selected.filter(
            (newPerm) => !rolePermissionsGlobal.includes(newPerm)
        );

        const selectedRole = data.role_name;

        try {
            for (const permission_name of removed) {
                await delete_role_permission({
                    role_name: selectedRole,
                    permission_name,
                });
            }

            await Promise.all(
                added.map((permission_name) =>
                    create_role_permission({
                        role_name: selectedRole,
                        permission_name,
                    })
                )
            );

            await update_role_permission(data.role_id, selected);

            const [roleData, allPermissions] = await Promise.all([
                get_role_detail(data),
                get_all_permission(),
            ]);

            allPermissionsGlobal = allPermissions || [];
            rolePermissionsGlobal = (roleData.permissions || []).map((p) =>
                normalize(p.permission_name)
            );
            selectedPermissionsGlobal = new Set(rolePermissionsGlobal); // <-- reset lại đúng

            const expectedPermissions = generateExpectedPermissions();
            renderPermissionTable(
                expectedPermissions,
                rolePermissionsGlobal,
                data.role_name
            );
            renderPermissionList(roleData.permissions);
            applyFilters();

            alert("Cập nhật thành công");
            $("#addPermissionModal").modal("hide");
            window.dispatchEvent(new CustomEvent("rolePermissionUpdated"));
        } catch (err) {
            console.error("Lỗi khi cập nhật quyền:", err);
            alert(err.message || "Lỗi khi cập nhật");
        }
    });
}
// Gọi khi window load
window.initRoleDetailModal = initRoleDetailModal;

// Render bảng checkbox quyền
// function renderPermissionTable(permissions, selectedNames) {
//     const container = document.getElementById("permission-checkboxes");
//     container.innerHTML = "";

//     const rows = permissions.map((p) =>
//         renderTableRow(p, selectedNames.includes(normalize(p.permissions_name)))
//     );

//     container.innerHTML = `
//         <table class="table table-hover table-bordered align-middle text-center">
//             <thead class="table-light">
//                 <tr>
//                     <th>Chọn</th>
//                     <th>Tên Permission</th>
//                     <th>Loại</th>
//                     <th>Mô tả</th>
//                 </tr>
//             </thead>
//             <tbody>${rows.join("")}</tbody>
//         </table>
//     `;
// }
// import {
//     get_all_role_permission,
//     get_all_permission as get_all_per,
// } from "../api/role";
// async function get_role_detail(roleId = 1) {
//     try {
//         const response = await get_all_role_permission("admin");
//         return Promise.resolve({
//             id: 1,
//             role_name: "admin",
//             permissions: response,
//         });
//     } catch (err) {
//         console.error("Lỗi khi tải danh sách quyền hạng:", err);
//     }
// }

// async function get_all_permission() {
//     // return Promise.resolve([]);
//     try {
//         const response = await get_all_per();
//         return Promise.resolve(response);
//     } catch (err) {
//         console.error("Lỗi khi tải danh sách quyền hạng:", err);
//     }
// }
// let allPermissionsGlobal = [];
// let rolePermissionsGlobal = [];
// function update_role_permission(roleId, permissionIds) {
//     console.log("Cập nhật role", roleId, "với permission", permissionIds);
//     return Promise.resolve(true);
// }

// // Khởi tạo modal edit permission
// async function initRoleDetailModal() {
//     const permissionForm = document.getElementById("permission-form");
//     const permissionContainer = document.getElementById(
//         "permission-checkboxes"
//     );
//     const roleNameEl = document.getElementById("role-name");
//     const roleId = 1;

//     if (!permissionForm) {
//         console.error("Không tìm thấy form edit permission");
//         return;
//     }

//     if (permissionForm.dataset.initialized) return;
//     permissionForm.dataset.initialized = "true";

//     try {
//         const [roleData, allPermissions] = await Promise.all([
//             get_role_detail(roleId),
//             get_all_permission(),
//         ]);
//         allPermissionsGlobal = allPermissions;
//         rolePermissionsGlobal = roleData.permissions.map(
//             (p) => p.permission_name
//         );
//         roleNameEl.textContent = roleData.role_name;

//         renderPermissionTable(allPermissionsGlobal, rolePermissionsGlobal);
//         renderPermissionList(roleData.permissions);
//         // Gắn sự kiện lọc
//         document
//             .getElementById("filter-name")
//             .addEventListener("input", applyFilters);
//         document
//             .getElementById("filter-type")
//             .addEventListener("change", applyFilters);
//         document
//             .getElementById("filter-selected")
//             .addEventListener("change", applyFilters);
//     } catch (err) {
//         console.error("Lỗi khi load dữ liệu role/permission:", err);
//         alert("Không thể tải dữ liệu");
//     }

//     permissionForm.addEventListener("submit", async (e) => {
//         e.preventDefault();
//         const selected = Array.from(
//             document.querySelectorAll(
//                 "#permission-checkboxes input[type=checkbox]:checked"
//             )
//         ).map((input) => input.value); // dùng value là permissions_name

//         try {
//             await update_role_permission(roleId, selected);
//             alert("Cập nhật permission thành công");
//             $("#addPermissionModal").modal("hide");
//             window.dispatchEvent(new CustomEvent("rolePermissionUpdated"));
//         } catch (err) {
//             console.error(err);
//             alert(err.message || "Đã có lỗi xảy ra");
//         }
//     });
// }

// function renderPermissionTable(permissions, rolePermissions) {
//     const permissionContainer = document.getElementById(
//         "permission-checkboxes"
//     );
//     permissionContainer.innerHTML = "";

//     const table = document.createElement("table");
//     table.className =
//         "table table-hover table-bordered align-middle text-center";

//     table.innerHTML = `
//         <thead class="table-light">
//             <tr>
//                 <th>Chọn</th>
//                 <th>Tên Permission</th>
//                 <th>Loại Permission</th>
//                 <th>Mô tả</th>
//             </tr>
//         </thead>
//         <tbody>
//             ${permissions
//                 .map((p) => {
//                     const name = p.permissions_name;
//                     const isChecked = rolePermissions.includes(name);
//                     return `
//                 <tr>
//                     <td>
//                         <div class="checkbox-wrapper-mail">
//                             <input
//                                 type="checkbox"
//                                 id="${name}"
//                                 value="${name}"
//                                 ${isChecked ? "checked" : ""}
//                                 style="width: 20px; height: 20px;"
//                             >
//                             <label for="${name}" class="toggle"></label>
//                         </div>
//                     </td>
//                     <td>${name}</td>
//                     <td>${p.type || "Không xác định"}</td>
//                     <td>${p.description || ""}</td>
//                 </tr>
//                 `;
//                 })
//                 .join("")}
//         </tbody>
//     `;

//     permissionContainer.appendChild(table);
// }

// function applyFilters() {
//     const nameFilter = document
//         .getElementById("filter-name")
//         .value.trim()
//         .toLowerCase();
//     const typeFilter = document.getElementById("filter-type").value;
//     const selectedFilter = document.getElementById("filter-selected").value;
//     const filteredPermissions = allPermissionsGlobal.filter((p) => {
//         const matchName = p.permissions_name.toLowerCase().includes(nameFilter);
//         const matchType = typeFilter ? p.type === typeFilter : true;

//         const isSelected = rolePermissionsGlobal.includes(p.permissions_name);

//         let matchSelected = true;
//         if (selectedFilter === "selected") {
//             matchSelected = isSelected;
//         } else if (selectedFilter === "unselected") {
//             matchSelected = !isSelected;
//         }

//         return matchName && matchType && matchSelected;
//     });
//     renderPermissionTable(filteredPermissions, rolePermissionsGlobal);
// }
// function renderPermissionList(permissions) {
//     const permissionList = document.getElementById("permission-list");
//     permissionList.innerHTML = "";

//     if (permissions.length === 0) {
//         permissionList.innerHTML = "<li>Chưa có permission nào</li>";
//         return;
//     }
//     permissions.forEach((p) => {
//         const li = document.createElement("li");
//         li.className =
//             "list-group-item d-flex justify-content-between align-items-center";
//         li.innerHTML = `
//             <span>${p.permission_name}</span>
//             <span class="badge badge-info">${
//                 p.description || "Không có mô tả"
//             }</span>
//         `;
//         permissionList.appendChild(li);
//     });
// }

// // Gọi khi window load
// window.initRoleDetailModal = initRoleDetailModal;
