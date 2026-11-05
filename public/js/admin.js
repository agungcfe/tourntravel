/**
 * CMS Dashboard — interaksi (vanilla JS)
 * - Toggle sidebar mobile
 * - Dropdown user
 * - Modal konfirmasi hapus
 * - Preview gambar upload
 * - Toolbar editor sederhana untuk artikel
 * - Auto hide alert sukses
 */
document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;

    // Sidebar
    document.getElementById('sidebarToggle')?.addEventListener('click', () => body.classList.toggle('sidebar-open'));
    document.getElementById('sidebarBackdrop')?.addEventListener('click', () => body.classList.remove('sidebar-open'));

    // Dropdown
    document.querySelectorAll('[data-dropdown]').forEach((dd) => {
        dd.querySelector('[data-dropdown-toggle]').addEventListener('click', (e) => {
            e.stopPropagation();
            dd.classList.toggle('open');
        });
    });
    document.addEventListener('click', () => document.querySelectorAll('[data-dropdown].open').forEach((d) => d.classList.remove('open')));

    // Modal konfirmasi hapus
    const modal = document.getElementById('confirmModal');
    let pendingForm = null;
    const closeModal = () => { modal?.classList.remove('open'); pendingForm = null; };

    document.querySelectorAll('[data-confirm]').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            pendingForm = btn.closest('form');
            document.getElementById('confirmText').textContent = btn.dataset.confirm;
            modal.classList.add('open');
        });
    });
    document.getElementById('confirmYes')?.addEventListener('click', () => pendingForm?.submit());
    modal?.querySelector('[data-modal-close]')?.addEventListener('click', closeModal);
    modal?.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });

    // Preview gambar
    document.querySelectorAll('[data-image-input]').forEach((input) => {
        input.addEventListener('change', () => {
            const file = input.files[0];
            if (!file) return;
            const wrap = input.closest('.image-input');
            const img = wrap.querySelector('[data-preview]');
            img.src = URL.createObjectURL(file);
            img.classList.remove('hidden');
            wrap.querySelector('.image-placeholder')?.classList.add('hidden');
        });
    });

    // Toolbar editor: bungkus teks terpilih dengan tag HTML
    document.querySelectorAll('[data-editor-for]').forEach((bar) => {
        const textarea = document.getElementById(bar.dataset.editorFor);
        bar.querySelectorAll('[data-wrap]').forEach((btn) => {
            btn.addEventListener('click', () => {
                const [before, after] = btn.dataset.wrap.replace(/\\n/g, '\n').split('|');
                const { selectionStart: s, selectionEnd: e, value } = textarea;
                const selected = value.slice(s, e);
                textarea.value = value.slice(0, s) + before + selected + after + value.slice(e);
                textarea.focus();
                textarea.setSelectionRange(s + before.length, s + before.length + selected.length);
            });
        });
    });

    // Auto hide alert sukses
    document.querySelectorAll('.alert-success[data-dismiss]').forEach((alert) => {
        setTimeout(() => { alert.classList.add('fade'); setTimeout(() => alert.remove(), 400); }, 4000);
    });
});
