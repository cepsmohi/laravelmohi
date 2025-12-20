{{--restore page scroll position after form submission --}}
<script>
    (() => {
        document.addEventListener('submit', e => {
            const f = e.target;
            if (f.tagName === 'FORM' && [...f.attributes].some(a => a.name.startsWith('wire:submit')))
                localStorage.setItem('scroll-position', window.scrollY);
        }, true);
        const restore = () => {
            const y = localStorage.getItem('scroll-position');
            if (!y) return;
            const ok = () => getComputedStyle(document.body).overflow !== 'hidden' && !document.body.classList.contains('overflow-hidden');
            const scroll = () => {
                if (ok()) {
                    window.scrollTo(0, +y);
                    localStorage.removeItem('scroll-position');
                    return true;
                }
            };
            if (!scroll()) {
                const t = setInterval(() => scroll() && clearInterval(t), 200);
                setTimeout(() => clearInterval(t), 8000);
            }
        };
        document.addEventListener('DOMContentLoaded', restore);
    })();
</script>
