document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('adminSidebarCollapseToggle');
    if (!toggle) return;

    const storageKey = 'admin-sidebar-collapsed';
    const icon = toggle.querySelector('i');
    const label = toggle.querySelector('.sidebar-collapse-label');

    const applyState = function (collapsed) {
        document.body.classList.toggle('admin-sidebar-collapsed', collapsed);
        toggle.setAttribute('aria-pressed', String(collapsed));
        const description = collapsed ? 'Perbesar sidebar' : 'Perkecil sidebar';
        toggle.setAttribute('aria-label', description);
        toggle.setAttribute('title', description);
        icon.className = collapsed ? 'bi bi-chevron-double-right' : 'bi bi-chevron-double-left';
        label.textContent = collapsed ? 'Perbesar menu' : 'Perkecil menu';
    };

    let isCollapsed = false;
    try {
        isCollapsed = window.localStorage.getItem(storageKey) === 'true';
    } catch (error) {
        console.warn('Preferensi ukuran sidebar tidak dapat dibaca.', error);
    }
    applyState(isCollapsed);

    toggle.addEventListener('click', function () {
        isCollapsed = !document.body.classList.contains('admin-sidebar-collapsed');
        applyState(isCollapsed);

        try {
            window.localStorage.setItem(storageKey, String(isCollapsed));
        } catch (error) {
            console.warn('Preferensi ukuran sidebar tidak dapat disimpan.', error);
        }
    });
});
