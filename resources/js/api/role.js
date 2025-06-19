import { defaultHeaders } from "../config/api_config";
export const get_all_role = async () => {
    const res = await fetch("/api/getallroles", {
        headers: defaultHeaders(),
    });
    const data = await res.json();
    return data || [];
};
export const create_role = async ({ role_name }) => {
    const res = await fetch(`/api/createrole`, {
        method: "POST",
        headers: defaultHeaders(),
        body: JSON.stringify({
            role_name,
        }),
    });

    const data = await res.json();

    if (!res.ok) {
        throw new Error(data.message || "Failed to create role permission");
    }

    return data;
};
export const get_all_permission_by_role_name = async (role_name) => {
    const res = await fetch(
        `/api/getRolePermissionByName?role_name=${role_name}`,
        {
            headers: defaultHeaders(),
        }
    );
    if (!res.ok) {
        return [];
    }

    const data = await res.json();
    return data || [];
};

export const get_all_permission = async () => {
    const res = await fetch(`/api/getallpermission`, {
        headers: defaultHeaders(),
    });
    const data = await res.json();
    return data.permissions || [];
};
// xóa một permission khỏi role
export const delete_role_permission = async ({
    role_name,
    permission_name,
}) => {
    if (
        role_name === "admin" &&
        permission_name.toLowerCase().trim().endsWith("vai trò")
    ) {
        return Promise.reject(
            new Error("Không thể xóa quyền 'vai trò' của 'admin'")
        );
    }
    if (
        role_name === "admin" &&
        permission_name.toLowerCase().trim().endsWith("quyền hạn")
    ) {
        return Promise.reject(
            new Error("Không thể xóa quyền 'quyền hạn' của 'admin'")
        );
    }
    const res = await fetch(`/api/deleteRolePermission`, {
        method: "DELETE",
        headers: defaultHeaders(),
        body: JSON.stringify({
            role_name,
            permission_name,
        }),
    });

    const data = await res.json();

    if (!res.ok) {
        throw new Error(data.message || "Failed to delete role permission");
    }

    return data;
};

export const create_role_permission = async ({
    role_name,
    permission_name,
}) => {
    const res = await fetch(`/api/createrolepermission`, {
        method: "POST",
        headers: defaultHeaders(),
        body: JSON.stringify({
            role_name,
            permission_name,
        }),
    });

    const data = await res.json();

    if (!res.ok) {
        throw new Error(data.message || "Failed to create role permission");
    }

    return data;
};
export const create_permission = async ({ permissions_name }) => {
    const res = await fetch(`/api/createPermission`, {
        method: "POST",
        headers: defaultHeaders(),
        body: JSON.stringify({
            permissions_name,
        }),
    });

    const data = await res.json();

    if (!res.ok) {
        throw new Error(data.message || "Failed to create role permission");
    }

    return data;
};
//
export const permissionTypes = [
    "Người dùng",
    "Phần cứng",
    "Phần mềm",
    "Quyền hạn",
    "Vai trò",
    "Pháp lý",
    "hệ thống",
    "danh mục",
    "người dùng quản lý phần cứng",
    "người dùng quản lý phần mềm",
    "quyền người dùng",
    "quyền hệ thống",
    "tên miền",
    "phần cứng vào domain",
];
export const permissionActions = [
    "thêm",
    "sửa",
    "xoá",
    "xem danh sách",
    "xem chi tiết",
    "tìm kiếm",
];
