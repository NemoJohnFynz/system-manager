import { defaultHeaders } from "../config/api_config";

/**
 * Lấy tất cả roles từ API
 */
export const get_all_role = async () => {
    const res = await fetch("/api/getAllRoles", {
        headers: defaultHeaders(),
    });
    const data = await res.json();
    return data || [];
};
