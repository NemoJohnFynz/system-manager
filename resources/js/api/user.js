import { defaultHeaders } from "../config/api_config";
export const get_all_user = async () => {
    const res = await fetch("api/getallusers", {
        headers: defaultHeaders(),
    });
    const data = await res.json();
    if (data.status === "success" && Array.isArray(data.users)) {
        return data.users;
    }
    return [];
};

export async function create_user(data) { 
    const res = await fetch("/api/createUser", {
        method: "POST",
        headers: defaultHeaders(), 
        body: JSON.stringify(data),
    });
    const result = await res.json();
    if (!res.ok) throw new Error(result.message || "Lỗi tạo người dùng");
    return result;
}
