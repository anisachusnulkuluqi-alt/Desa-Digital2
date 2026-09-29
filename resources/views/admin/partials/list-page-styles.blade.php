<style>
    .admin-main { min-height: 100vh; margin-left: 260px; }
    .admin-topbar { position: sticky; top: 0; z-index: 90; display: flex; min-height: 62px; align-items: center; justify-content: space-between; padding: 0 28px; border-bottom: 1px solid #e2e8f0; background: #fff; }
    .admin-breadcrumb { color: #64748b; font-size: 12px; }
    .admin-breadcrumb strong { color: #1e3a8a; font-weight: 600; }
    .admin-user { padding: 7px 11px; border: 1px solid #e2e8f0; border-radius: 8px; color: #1e293b; font-size: 12px; font-weight: 600; }
    .admin-content { max-width: 1440px; margin: 0 auto; padding: 28px; }
    .admin-page-heading { margin-bottom: 24px; }
        .admin-edit-content { max-width: 1040px; margin: 0 auto; padding: 28px; }
        .admin-edit-content .form-card { margin-bottom: 18px; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 2px 8px #0f172a0a; }
        .admin-edit-content .form-header { background: linear-gradient(135deg, #1e3a8a, #3b82f6); }
        .admin-edit-content .form-input, .admin-edit-content .form-select { border: 1.5px solid #e2e8f0; border-radius: 8px; background: #f8fafc; }
        .admin-edit-content .form-input:focus, .admin-edit-content .form-select:focus { border-color: #1e3a8a; background: #fff; box-shadow: 0 0 0 3px #1e3a8a14; }
        .admin-edit-content .form-input.is-invalid, .admin-edit-content .form-select.is-invalid { border-color: #dc2626; background: #fef2f2; }
        .admin-edit-content .btn-save { background: linear-gradient(135deg, #1e3a8a, #3b82f6); box-shadow: 0 2px 8px #1e3a8a24; }
        .admin-edit-content .btn-save:hover { box-shadow: 0 4px 12px #1e3a8a38; }
    .admin-eyebrow { margin: 0 0 6px; color: #1e3a8a; font-size: 11px; font-weight: 700; text-transform: uppercase; }
    .admin-page-heading h1 { margin: 0; color: #1e293b; font-size: 28px; line-height: 1.2; font-weight: 800; }
    .admin-page-subtitle { margin: 7px 0 0; color: #64748b; font-size: 13px; }
    .admin-alert { display: flex; align-items: center; gap: 10px; margin-bottom: 18px; padding: 12px 16px; border: 1px solid #86efac; border-radius: 8px; background: #dcfce7; color: #166534; font-size: 13px; font-weight: 600; }
    .admin-alert button { margin-left: auto; border: 0; background: transparent; color: inherit; cursor: pointer; }
    .admin-list-panel { overflow: hidden; border: 1px solid #e2e8f0; border-radius: 12px; background: #fff; }
    .admin-list-toolbar { display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 16px 24px; border-bottom: 1px solid #e2e8f0; }
    .admin-list-title { display: flex; align-items: center; gap: 10px; color: #1e293b; font-size: 14px; font-weight: 700; }
    .admin-list-title > i { color: #1e3a8a; }
    .admin-count { padding: 3px 10px; border-radius: 10px; background: #1e3a8a; color: #fff; font-size: 11px; font-weight: 600; white-space: nowrap; }
    .admin-list-actions { display: flex; align-items: center; gap: 10px; }
    .admin-search-wrap { position: relative; }
    .admin-search-wrap > i { position: absolute; top: 50%; left: 12px; color: #94a3b8; transform: translateY(-50%); }
    .admin-search { width: 240px; height: 38px; padding: 0 12px 0 36px; border: 1px solid #e2e8f0; border-radius: 8px; color: #1e293b; font-size: 13px; outline: none; }
    .admin-search:focus { border-color: #7aa5ff; box-shadow: 0 0 0 3px #2563eb18; }
    .admin-primary-btn, .admin-secondary-btn { display: inline-flex; min-height: 38px; align-items: center; justify-content: center; gap: 7px; padding: 0 14px; border: 1px solid transparent; border-radius: 8px; font-size: 13px; font-weight: 600; text-decoration: none; white-space: nowrap; cursor: pointer; }
    .admin-primary-btn { background: linear-gradient(135deg, #1e3a8a, #3b82f6); color: #fff; }
    .admin-primary-btn:hover { color: #fff; box-shadow: 0 4px 12px #1e3a8a30; }
    .admin-secondary-btn { border-color: #e2e8f0; background: #fff; color: #334155; }
    .admin-table-wrap { overflow-x: auto; }
    .admin-table { width: 100%; border-collapse: collapse; text-align: left; }
    .admin-table th { padding: 14px 20px; border-bottom: 1px solid #e2e8f0; background: #f8fafc; color: #64748b; font-size: 11px; font-weight: 700; text-transform: uppercase; white-space: nowrap; }
    .admin-table td { padding: 15px 20px; border-bottom: 1px solid #f1f5f9; color: #1e293b; font-size: 13px; vertical-align: middle; }
    .admin-table tbody tr { transition: background 0.2s; }
    .admin-table tbody tr[data-id] { cursor: pointer; }
    .admin-table tbody tr[data-id]:hover { background: #f8fafc; }
    .admin-table tbody tr:last-child td { border-bottom: 0; }
    .admin-row-number { color: #94a3b8 !important; font-weight: 600; }
    .admin-place-name { display: flex; align-items: center; gap: 10px; color: #1e3a8a; font-weight: 600; }
    .admin-place-icon { display: grid; width: 32px; height: 32px; flex: 0 0 32px; place-items: center; border-radius: 8px; background: #dbeafe; color: #1e40af; }
    .admin-kind { display: inline-flex; padding: 4px 10px; border-radius: 6px; background: #dbeafe; color: #1e40af; font-size: 11px; font-weight: 600; }
    .admin-kind.is-kelurahan { background: #fef3c7; color: #92400e; }
    .admin-empty { padding: 48px 16px !important; color: #94a3b8 !important; text-align: center; }
    .admin-empty i { display: block; margin-bottom: 10px; color: #94a3b8; font-size: 30px; }
    @media (max-width: 992px) {
        .admin-main { margin-left: 0; }
    }
    @media (max-width: 760px) {
        .admin-topbar { min-height: 56px; padding: 0 16px; }
        .admin-content { padding: 20px 14px 30px; }
            .admin-edit-content { padding: 20px 14px 30px; }
        .admin-page-heading h1 { font-size: 24px; }
        .admin-list-toolbar, .admin-list-actions { align-items: stretch; flex-direction: column; }
        .admin-search { width: 100%; }
        .admin-primary-btn, .admin-secondary-btn { width: 100%; }
    }
</style>