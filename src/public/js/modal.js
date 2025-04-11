document.addEventListener('DOMContentLoaded', () => {
    // 詳細ボタンを取得
    const openButtons = document.querySelectorAll('.modal__open');

    openButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-id');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('active');
            }
        });
    });

    // 閉じるボタン・背景クリックで閉じる
    const closeElements = document.querySelectorAll('.modal__close');

    closeElements.forEach(close => {
        close.addEventListener('click', () => {
            const modal = close.closest('.modal');
            modal.classList.remove('active');
        });
    });
});