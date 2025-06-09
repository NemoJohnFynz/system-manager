console.log('pnooodadaw')
document.addEventListener("DOMContentLoaded", () => {
    const token = window.appConfig.apiToken;
    const apiUrl = window.appConfig.apiUrl;

    async function loadUsers() {
        try {
            const response = await fetch(apiUrl, {
                headers: {
                    Authorization: "Bearer " + token,
                    Accept: "application/json",
                },
            });

            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }

            const data = await response.json();

            if (data.status === "success" && Array.isArray(data.users)) {
                const tbody = document.getElementById("user-table-body");
                tbody.innerHTML = "";

                data.users.forEach((user) => {
                    const tr = document.createElement("tr");

                    tr.innerHTML = `
                        <td>
                            <div class="avatar-xs">
                                <span class="avatar-title rounded-circle">
                                    ${user.username.charAt(0).toUpperCase()}
                                </span>
                            </div>
                        </td>
                        <td>
                            <h5 class="font-size-14 mb-1"><a href="#" class="text-dark">${
                                user.username
                            }</a></h5>
                        </td>
                        <td>${user.email ?? "-"}</td>
                        <td>
                            <div>
                                <a href="#" class="badge badge-soft-primary font-size-11 m-1">Role 1</a>
                                <a href="#" class="badge badge-soft-primary font-size-11 m-1">Role 2</a>
                            </div>
                        </td>
                        <td>125</td>
                        <td>
                            <ul class="list-inline font-size-20 contact-links mb-0">
                                <li class="list-inline-item px-2">
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bx bx-trash"></i></a>
                                </li>
                                <li class="list-inline-item px-2">
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i class="bx bx-wrench"></i></a>
                                </li>
                                <li class="list-inline-item px-2">
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Profile"><i class="bx bx-user-circle"></i></a>
                                </li>
                            </ul>
                        </td>
                    `;

                    tbody.appendChild(tr);
                });
            } else {
                console.error("API trả về lỗi hoặc không có dữ liệu users");
            }
        } catch (error) {
            console.error("Lỗi khi gọi API:", error);
        }
    }

    loadUsers();
});
