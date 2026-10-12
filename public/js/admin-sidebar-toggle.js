document.addEventListener('DOMContentLoaded', function () {
    // ===== DESKTOP COLLAPSE TOGGLE =====
    const desktopToggle = document.getElementById('adminSidebarCollapseToggle');
    if (desktopToggle) {
        const storageKey = 'admin-sidebar-collapsed';
        const icon = desktopToggle.querySelector('i');
        const label = desktopToggle.querySelector('.sidebar-collapse-label');

        const applyState = function (collapsed) {
            document.body.classList.toggle('admin-sidebar-collapsed', collapsed);
            desktopToggle.setAttribute('aria-pressed', String(collapsed));
            const description = collapsed ? 'Perbesar sidebar' : 'Perkecil sidebar';
            desktopToggle.setAttribute('aria-label', description);
            desktopToggle.setAttribute('title', description);
            if (icon) {
                icon.className = collapsed ? 'bi bi-chevron-double-right' : 'bi bi-chevron-double-left';
            }
            if (label) {
                label.textContent = collapsed ? 'Perbesar menu' : 'Perkecil menu';
            }
        };

        let isCollapsed = false;
        try {
            isCollapsed = window.localStorage.getItem(storageKey) === 'true';
        } catch (error) {
            console.warn('Preferensi ukuran sidebar tidak dapat dibaca.', error);
        }
        applyState(isCollapsed);

        desktopToggle.addEventListener('click', function () {
            isCollapsed = !document.body.classList.contains('admin-sidebar-collapsed');
            applyState(isCollapsed);

            try {
                window.localStorage.setItem(storageKey, String(isCollapsed));
            } catch (error) {
                console.warn('Preferensi ukuran sidebar tidak dapat disimpan.', error);
            }
        });
    }

    // ===== MOBILE OFF-CANVAS SIDEBAR =====
    let mobileToggle = document.getElementById('adminMobileSidebarToggle');
    if (!mobileToggle) {
        mobileToggle = document.createElement('button');
        mobileToggle.type = 'button';
        mobileToggle.id = 'adminMobileSidebarToggle';
        mobileToggle.className = 'admin-mobile-toggle';
        mobileToggle.setAttribute('aria-label', 'Buka menu navigasi');
        mobileToggle.setAttribute('aria-expanded', 'false');
        mobileToggle.innerHTML = '<i class="bi bi-list" aria-hidden="true"></i>';

        const headerContainer = document.querySelector('.top-header, .admin-topbar, .topbar, .page-header, header');
        if (headerContainer) {
            headerContainer.prepend(mobileToggle);
        } else {
            document.body.prepend(mobileToggle);
        }
    }

    const closeBtn = document.getElementById('adminSidebarCloseBtn');
    const backdrop = document.getElementById('adminSidebarBackdrop');

    const openMobileSidebar = function () {
        document.body.classList.add('admin-sidebar-mobile-open');
        if (mobileToggle) mobileToggle.setAttribute('aria-expanded', 'true');
    };

    const closeMobileSidebar = function () {
        document.body.classList.remove('admin-sidebar-mobile-open');
        if (mobileToggle) mobileToggle.setAttribute('aria-expanded', 'false');
    };

    const toggleMobileSidebar = function () {
        if (document.body.classList.contains('admin-sidebar-mobile-open')) {
            closeMobileSidebar();
        } else {
            openMobileSidebar();
        }
    };

    if (mobileToggle) {
        mobileToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            toggleMobileSidebar();
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            closeMobileSidebar();
        });
    }

    if (backdrop) {
        backdrop.addEventListener('click', function () {
            closeMobileSidebar();
        });
    }

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && document.body.classList.contains('admin-sidebar-mobile-open')) {
            closeMobileSidebar();
        }
    });

    // Close when navigating via mobile links
    const sidebarLinks = document.querySelectorAll('.sidebar-menu a');
    sidebarLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 992) {
                closeMobileSidebar();
            }
        });
    });

    // Close automatically if resized back to desktop
    window.addEventListener('resize', function () {
        if (window.innerWidth > 992 && document.body.classList.contains('admin-sidebar-mobile-open')) {
            closeMobileSidebar();
        }
    });
});
