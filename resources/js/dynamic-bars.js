const setupDynamicBars = () => {
    const widthNodes = document.querySelectorAll('[data-width]');
    widthNodes.forEach((node) => {
        const width = Number.parseFloat(node.getAttribute('data-width') || '0');
        const clamped = Number.isFinite(width) ? Math.max(0, Math.min(100, width)) : 0;
        node.style.width = `${clamped}%`;
    });

    const heightNodes = document.querySelectorAll('[data-height]');
    heightNodes.forEach((node) => {
        const height = Number.parseFloat(node.getAttribute('data-height') || '0');
        const clamped = Number.isFinite(height) ? Math.max(0, Math.min(100, height)) : 0;
        node.style.height = `${clamped}%`;
    });
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupDynamicBars);
} else {
    setupDynamicBars();
}
