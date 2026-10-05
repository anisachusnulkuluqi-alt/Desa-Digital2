@php($adminHeaderUser = auth()->user())

<div class="admin-header-actions">
    <a href="{{ route('home') }}" class="admin-header-home" aria-label="Kembali ke website" title="Kembali ke website">
        <i class="bi bi-house-door-fill" aria-hidden="true"></i>
    </a>
    <div class="admin-header-profile-wrap">
        <button type="button" class="admin-header-profile" id="adminHeaderProfileButton" aria-expanded="false" aria-controls="adminHeaderProfileMenu">
            <span class="admin-header-avatar">{{ strtoupper(substr($adminHeaderUser->name ?? 'A', 0, 1)) }}</span>
            <span class="admin-header-user-info">
                <strong>{{ $adminHeaderUser->name ?? 'Administrator' }}</strong>
                <small>{{ ucfirst($adminHeaderUser->role ?? 'Admin') }}</small>
            </span>
            <i class="bi bi-chevron-down admin-header-chevron" aria-hidden="true"></i>
        </button>
        <div class="admin-header-dropdown" id="adminHeaderProfileMenu" hidden>
    <a href="{{ route('profile.show') }}"><i class="bi bi-person"></i> Lihat Profil</a>
    <a href="{{ route('profile.edit') }}"><i class="bi bi-gear"></i> Pengaturan</a>
    <div class="admin-header-dropdown-divider"></div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button>
    </form>
</div>
    </div>
</div>

<style>
    .admin-header-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }
    .admin-header-home,
    .admin-header-profile {
        min-height: 36px;
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        background: #fff;
        color: #64748b;
        transition: border-color .2s, color .2s, background .2s;
    }
    .admin-header-home {
        width: 36px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: #64748b;
        text-decoration: none;
    }
    .admin-header-home:hover,
    .admin-header-profile:hover {
        border-color: #2563eb;
        color: #2563eb;
        background: #eff6ff;
    }
    .admin-header-profile-wrap {
        position: relative;
    }
    .admin-header-profile {
        min-width: 208px;
        padding: 5px 10px 5px 6px;
        display: flex;
        align-items: center;
        gap: 9px;
        text-align: left;
        cursor: pointer;
    }
    .admin-header-avatar {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 32px;
        background: #2563eb;
        color: white;
        font-size: 13px;
        font-weight: 700;
    }
    .admin-header-user-info {
        min-width: 0;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .admin-header-user-info strong {
        overflow: hidden;
        color: #0f172a;
        font-size: 11px;
        font-weight: 700;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .admin-header-user-info small {
        color: #64748b;
        font-size: 10px;
    }
    .admin-header-chevron { font-size: 10px; }
    .admin-header-dropdown {
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        z-index: 120;
        width: 190px;
        padding: 6px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        background: white;
        box-shadow: 0 12px 28px rgba(15, 23, 42, .14);
    }
    .admin-header-dropdown a,
    .admin-header-dropdown form button {
        width: 100%;
        padding: 9px 10px;
        display: flex;
        align-items: center;
        gap: 9px;
        border: 0;
        border-radius: 7px;
        background: transparent;
        color: #334155;
        font-size: 12px;
        text-align: left;
        text-decoration: none;
        cursor: pointer;
    }
    .admin-header-dropdown a:hover,
    .admin-header-dropdown form button:hover { background: #f1f5f9; }
    .admin-header-dropdown form button { color: #dc2626; }
    .admin-header-dropdown-divider { height: 1px; margin: 5px 0; background: #e2e8f0; }
    @media (max-width: 576px) {
        .admin-header-profile { min-width: 36px; width: 36px; padding: 2px; justify-content: center; }
        .admin-header-user-info,
        .admin-header-chevron { display: none; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const profileButton = document.getElementById('adminHeaderProfileButton');
        const profileMenu = document.getElementById('adminHeaderProfileMenu');

        if (!profileButton || !profileMenu) return;

        profileButton.addEventListener('click', function (event) {
            event.stopPropagation();
            const isExpanded = profileButton.getAttribute('aria-expanded') === 'true';
            profileButton.setAttribute('aria-expanded', String(!isExpanded));
            profileMenu.hidden = isExpanded;
        });

        document.addEventListener('click', function (event) {
            if (!profileButton.contains(event.target) && !profileMenu.contains(event.target)) {
                profileButton.setAttribute('aria-expanded', 'false');
                profileMenu.hidden = true;
            }
        });
    });
</script>