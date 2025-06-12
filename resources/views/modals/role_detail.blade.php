<!-- Thông tin Role -->
<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Thông tin Role</h4>
        <p><strong>Tên Role:</strong> <span id="role-name"></span></p>
    </div>
</div>

<!-- Danh sách Permissions -->
<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Danh sách Permission</h4>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addPermissionModal">
            <i class="fa fa-plus"></i> Thêm Permission
        </button>

        <ul class="message-list mt-3" id="permission-list"></ul>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addPermissionModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="permission-form" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa Permission</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="permission-checkboxes"></div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
</div>
