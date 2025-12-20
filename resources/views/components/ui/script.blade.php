<script>
    document.addEventListener('livewire:navigated', () => {
        const isDark = localStorage.getItem('theme') === 'dark';
        document.documentElement.classList.toggle('dark', isDark);
    });
    
    function formatByPattern(el, pattern, sign) {
        if (el._busy) return;
        el._busy = true;
        let digits = (el.value || '').replace(/\D/g, '');
        const parts = [];
        for (const size of pattern) {
            if (!digits.length) break;
            parts.push(digits.slice(0, size));
            digits = digits.slice(size);
        }
        const formatted = parts.join(sign);
        const oldLen = el.value.length;
        const oldPos = el.selectionStart ?? oldLen;
        el.value = formatted;
        const newLen = formatted.length;
        const delta = newLen - oldLen;
        const nextPos = Math.max(0, Math.min(newLen, oldPos + delta));
        requestAnimationFrame(() => {
            try {
                el.setSelectionRange(nextPos, nextPos);
            } catch {
            }
            el._busy = false;
        });
    }
</script>
