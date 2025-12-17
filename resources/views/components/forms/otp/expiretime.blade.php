@php
    use App\Models\Otp;
    $otp = Otp::where('identifier', $identifier)->latest()->first();
@endphp
<div
    x-data="otpTimer('{{ $otp->expires_at }}')"
    x-init="start()"
    class="text-sm"
>
    <template x-if="!expired">
        <span>
            Expires in:
            <span x-text="timeLeft"></span>
        </span>
    </template>

    <template x-if="expired">
        <span class="text-red-600 font-semibold">
            Expired
        </span>
    </template>
</div>
<script>
    function otpTimer(expiresAt) {
        return {
            expiresAt: new Date(expiresAt),
            timeLeft: '',
            expired: false,
            interval: null,

            start() {
                this.update();
                this.interval = setInterval(() => {
                    this.update();
                }, 1000);
            },

            update() {
                const now = new Date();
                const diff = this.expiresAt - now;

                if (diff <= 0) {
                    this.expired = true;
                    this.timeLeft = '00:00';
                    clearInterval(this.interval);
                    return;
                }

                const totalSeconds = Math.floor(diff / 1000);
                const minutes = Math.floor(totalSeconds / 60);
                const seconds = totalSeconds % 60;

                this.timeLeft =
                    String(minutes).padStart(2, '0') + ':' +
                    String(seconds).padStart(2, '0');
            }
        }
    }
</script>
