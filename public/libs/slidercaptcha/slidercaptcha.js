/**
 * SliderCaptcha v3 - Vanilla JS Puzzle Slider Captcha
 * Fastlog Era Mandiri
 */
(function (global) {
    'use strict';

    var PW  = 55;   // puzzle piece width  (internal canvas px)
    var PH  = 55;   // puzzle piece height
    var TOL = 7;    // match tolerance (internal px)
    var KR  = 9;    // knob radius

    /* ────────────────────────────────────────────
       Draw a jigsaw puzzle shape path on ctx
       at internal-canvas coordinates (x, y)
    ─────────────────────────────────────────── */
    function puzzlePath(ctx, x, y) {
        var w = PW, h = PH, r = KR;
        ctx.beginPath();
        ctx.moveTo(x, y);
        // Top edge
        ctx.lineTo(x + w, y);
        // Right edge (downwards)
        ctx.lineTo(x + w, y + h / 2 - r);
        // Right knob (bulge out to the right)
        ctx.arc(x + w, y + h / 2, r, Math.PI * 1.5, Math.PI * 0.5, false);
        // Right edge (finish)
        ctx.lineTo(x + w, y + h);
        // Bottom edge (leftwards)
        ctx.lineTo(x + w / 2 + r, y + h);
        // Bottom knob (bulge out downwards)
        ctx.arc(x + w / 2, y + h, r, 0, Math.PI, false);
        // Bottom edge (finish)
        ctx.lineTo(x, y + h);
        // Left edge
        ctx.lineTo(x, y);
        ctx.closePath();
    }

    /* ────────────────────────────────────────────
       Constructor
    ─────────────────────────────────────────── */
    function SliderCaptcha(opts) {
        this.el        = typeof opts.el === 'string' ? document.getElementById(opts.el) : opts.el;
        this.images    = opts.images  || [];
        this.onSuccess = opts.onSuccess || function () {};
        this.onFail    = opts.onFail    || function () {};

        this._imgIdx    = -1;
        this._verified  = false;
        this._dragging  = false;
        this._cssLeft   = 0;
        this._targetInt = 0; // target in internal px

        this._build();
        this._load();
    }

    /* ────────────────────────────────────────────
       Build DOM
    ─────────────────────────────────────────── */
    SliderCaptcha.prototype._build = function () {
        var self = this;
        var root = this.el;
        root.innerHTML = '';
        root.className = 'sc-wrapper';

        /* canvas wrapper */
        var cWrap = document.createElement('div');
        cWrap.className = 'sc-canvas-wrapper';
        cWrap.style.cssText = 'position:relative;width:100%;border-radius:10px;overflow:hidden;background:#e2e8f0;margin-bottom:12px;line-height:0;';

        /* background canvas — stretches 100% */
        this.bgC = document.createElement('canvas');
        this.bgC.width  = 300;
        this.bgC.height = 150;
        this.bgC.style.cssText = 'display:block;width:100%;height:auto;border-radius:10px;';

        /* piece canvas — fixed intrinsic size, positioned absolute */
        this.pieceC = document.createElement('canvas');
        this.pieceC.width  = PW + KR + 4;  // extra for right knob
        this.pieceC.height = 150;
        this.pieceC.style.cssText = 'position:absolute;top:0;left:0;pointer-events:none;width:auto;height:100%;';

        /* loading overlay */
        this.loading = document.createElement('div');
        this.loading.style.cssText = 'position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.8);font-size:13px;color:#64748b;border-radius:10px;';
        this.loading.textContent = '⏳ Memuat gambar…';

        cWrap.appendChild(this.bgC);
        cWrap.appendChild(this.pieceC);
        cWrap.appendChild(this.loading);

        /* slider track */
        this.sWrap = document.createElement('div');
        this.sWrap.style.cssText = 'position:relative;width:100%;height:44px;border:1px solid #e2e8f0;border-radius:22px;background:#f8fafc;overflow:hidden;box-shadow:inset 0 1px 4px rgba(0,0,0,.07);';

        this.sText = document.createElement('span');
        this.sText.style.cssText = 'position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:12px;color:#94a3b8;pointer-events:none;z-index:1;';
        this.sText.textContent   = '← Geser ke kanan untuk verifikasi';

        this.sFill = document.createElement('div');
        this.sFill.style.cssText = 'position:absolute;left:0;top:0;height:100%;width:44px;background:linear-gradient(90deg,#FF7A3D,#ffb38a);border-radius:22px;z-index:2;';

        this.sBtn = document.createElement('div');
        this.sBtn.style.cssText = 'position:absolute;left:0;top:50%;transform:translateY(-50%);width:44px;height:44px;border-radius:50%;background:#fff;border:2px solid #FF7A3D;cursor:grab;z-index:3;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 10px rgba(0,0,0,.12);';
        this.sBtn.innerHTML = _arrowSvg('FF7A3D');

        this.sWrap.appendChild(this.sText);
        this.sWrap.appendChild(this.sFill);
        this.sWrap.appendChild(this.sBtn);

        /* refresh button */
        var rfWrap = document.createElement('div');
        rfWrap.style.cssText = 'margin-top:8px;text-align:right;';
        var rfBtn = document.createElement('button');
        rfBtn.type = 'button';
        rfBtn.style.cssText = 'background:none;border:none;cursor:pointer;color:#94a3b8;font-size:12px;display:inline-flex;align-items:center;gap:5px;padding:4px 8px;border-radius:6px;transition:color .2s,background .2s;';
        rfBtn.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Coba gambar lain';
        rfBtn.onmouseover = function () { rfBtn.style.color='#FF7A3D'; rfBtn.style.background='rgba(255,122,61,.08)'; };
        rfBtn.onmouseout  = function () { rfBtn.style.color='#94a3b8'; rfBtn.style.background='none'; };
        rfBtn.addEventListener('click', function () { self.refresh(); });
        rfWrap.appendChild(rfBtn);

        root.appendChild(cWrap);
        root.appendChild(this.sWrap);
        root.appendChild(rfWrap);

        this._bindDrag();
    };

    /* ────────────────────────────────────────────
       Load image
    ─────────────────────────────────────────── */
    SliderCaptcha.prototype._load = function () {
        var self = this;
        self.loading.style.display = 'flex';
        self.sBtn.style.pointerEvents = 'none';

        var img = new Image();
        img.crossOrigin = 'anonymous';

        if (self.images.length) {
            self._imgIdx = (self._imgIdx + 1) % self.images.length;
            img.src = self.images[self._imgIdx];
        } else {
            img.src = 'https://picsum.photos/300/150?t=' + Date.now();
        }

        img.onload = function () {
            self._drawCaptcha(img);
            self.loading.style.display = 'none';
            self.sBtn.style.pointerEvents = '';
        };
        img.onerror = function () {
            // fallback: try another picsum
            var img2 = new Image();
            img2.crossOrigin = 'anonymous';
            img2.src = 'https://picsum.photos/seed/' + Math.random() + '/300/150';
            img2.onload = function () { self._drawCaptcha(img2); self.loading.style.display='none'; self.sBtn.style.pointerEvents=''; };
            img2.onerror = function () { self._drawFallback(); self.loading.style.display='none'; self.sBtn.style.pointerEvents=''; };
        };
    };

    /* ────────────────────────────────────────────
       Draw captcha onto canvases
    ─────────────────────────────────────────── */
    SliderCaptcha.prototype._drawCaptcha = function (img) {
        var W  = this.bgC.width;   // 300
        var H  = this.bgC.height;  // 150
        var bgX = this.bgC.getContext('2d');
        var piX = this.pieceC.getContext('2d');
        var PW2 = this.pieceC.width;

        /* random target position (must stay within bounds) */
        var minTx = PW + KR + 20;
        var maxTx = W  - PW - KR - 20;
        this._targetInt = minTx + Math.floor(Math.random() * (maxTx - minTx));
        var ty = 15 + Math.floor(Math.random() * (H - PH - 30));

        /* ── Draw background ── */
        bgX.clearRect(0, 0, W, H);
        bgX.drawImage(img, 0, 0, W, H);

        /* Cut-out hole on background */
        bgX.save();
        puzzlePath(bgX, this._targetInt, ty);
        bgX.fillStyle = 'rgba(0,0,0,0.45)';
        bgX.fill();
        bgX.strokeStyle = 'rgba(255,255,255,0.7)';
        bgX.lineWidth = 1.5;
        bgX.stroke();
        bgX.restore();

        /* ── Draw piece canvas ── */
        piX.clearRect(0, 0, PW2, H);

        /* Piece is drawn at x=2 on piece canvas.
           We extract the image region from _targetInt on the bg image. */
        piX.save();
        puzzlePath(piX, 2, ty);
        piX.clip();
        /* Draw full image offset so the right region appears */
        piX.drawImage(img, 2 - this._targetInt, 0, W, H);
        piX.restore();

        /* Piece outline */
        piX.save();
        puzzlePath(piX, 2, ty);
        piX.strokeStyle = 'rgba(255,255,255,0.9)';
        piX.lineWidth   = 1.5;
        piX.stroke();
        piX.restore();

        /* Reset slider to 0 */
        this._resetSlider();
    };

    /* ────────────────────────────────────────────
       Fallback: draw gradient when image fails
    ─────────────────────────────────────────── */
    SliderCaptcha.prototype._drawFallback = function () {
        var W  = this.bgC.width, H = this.bgC.height;
        var bgX = this.bgC.getContext('2d');
        var piX = this.pieceC.getContext('2d');

        var g = bgX.createLinearGradient(0, 0, W, H);
        g.addColorStop(0, '#0f2c3a');
        g.addColorStop(0.5, '#1a4a5c');
        g.addColorStop(1, '#FF7A3D');
        bgX.fillStyle = g;
        bgX.fillRect(0, 0, W, H);

        for (var i = 0; i < 7; i++) {
            bgX.beginPath();
            bgX.arc(30 + i * 40, 40 + (i % 3) * 35, 20, 0, Math.PI * 2);
            bgX.fillStyle = 'rgba(255,255,255,0.06)';
            bgX.fill();
        }

        var tx = 80 + Math.floor(Math.random() * 100);
        var ty = 25;
        this._targetInt = tx;

        /* Hole */
        bgX.save();
        puzzlePath(bgX, tx, ty);
        bgX.fillStyle = 'rgba(0,0,0,0.45)';
        bgX.fill();
        bgX.strokeStyle = 'rgba(255,255,255,0.6)';
        bgX.lineWidth = 1.5;
        bgX.stroke();
        bgX.restore();

        /* Piece (orange block from gradient) */
        piX.clearRect(0, 0, this.pieceC.width, H);
        piX.save();
        puzzlePath(piX, 2, ty);
        piX.fillStyle = 'rgba(255,122,61,0.85)';
        piX.fill();
        piX.strokeStyle = 'rgba(255,255,255,0.8)';
        piX.lineWidth = 1.5;
        piX.stroke();
        piX.restore();

        this._resetSlider();
    };

    /* ────────────────────────────────────────────
       Reset slider to position 0
    ─────────────────────────────────────────── */
    SliderCaptcha.prototype._resetSlider = function () {
        this._cssLeft   = 0;
        this._verified  = false;
        this._setColor('#FF7A3D');
        this.sText.textContent = '← Geser ke kanan untuk verifikasi';
        this.sText.style.color = '#94a3b8';
        this.sBtn.innerHTML    = _arrowSvg('FF7A3D');
        this._applyPos(0, false);
    };

    /* ────────────────────────────────────────────
       Apply CSS position to slider & piece canvas
    ─────────────────────────────────────────── */
    SliderCaptcha.prototype._applyPos = function (cssPx, animate) {
        var maxCss = this.sWrap.offsetWidth - 44;
        cssPx = Math.max(0, Math.min(cssPx, maxCss));
        this._cssLeft = cssPx;

        if (animate) {
            this.sBtn.style.transition   = 'left .35s ease';
            this.sFill.style.transition  = 'width .35s ease';
            this.pieceC.style.transition = 'left .35s ease';
        } else {
            this.sBtn.style.transition   = '';
            this.sFill.style.transition  = '';
            this.pieceC.style.transition = '';
        }

        /* Slider button & fill */
        this.sBtn.style.left  = cssPx + 'px';
        this.sFill.style.width = (cssPx + 44) + 'px';

        /* Move piece canvas: convert css px → internal px
           scale = internal width / displayed width */
        var scale = this.bgC.width / this.bgC.getBoundingClientRect().width;
        var internalPx = cssPx * scale;
        this.pieceC.style.left = internalPx + 'px';
    };

    SliderCaptcha.prototype._setColor = function (hex) {
        this.sBtn.style.borderColor  = '#' + hex;
        this.sFill.style.background  = 'linear-gradient(90deg,#' + hex + ',#' + hex + 'aa)';
    };

    /* ────────────────────────────────────────────
       Bind drag events
    ─────────────────────────────────────────── */
    SliderCaptcha.prototype._bindDrag = function () {
        var self = this;

        function onStart(e) {
            if (self._verified) return;
            self._dragging   = true;
            self._mouseStart = e.touches ? e.touches[0].clientX : e.clientX;
            self._posStart   = self._cssLeft;
            document.addEventListener('mousemove', onMove);
            document.addEventListener('touchmove', onMove, { passive: false });
            document.addEventListener('mouseup',   onEnd);
            document.addEventListener('touchend',  onEnd);
        }

        function onMove(e) {
            if (!self._dragging) return;
            e.preventDefault();
            var x = e.touches ? e.touches[0].clientX : e.clientX;
            self._applyPos(self._posStart + (x - self._mouseStart), false);
        }

        function onEnd() {
            if (!self._dragging) return;
            self._dragging = false;
            document.removeEventListener('mousemove', onMove);
            document.removeEventListener('touchmove', onMove);
            document.removeEventListener('mouseup',   onEnd);
            document.removeEventListener('touchend',  onEnd);
            self._verify();
        }

        this.sBtn.addEventListener('mousedown',  onStart);
        this.sBtn.addEventListener('touchstart', onStart, { passive: true });
    };

    /* ────────────────────────────────────────────
       Verify position
    ─────────────────────────────────────────── */
    SliderCaptcha.prototype._verify = function () {
        /* Convert current CSS position → internal px for comparison */
        var scale      = this.bgC.width / this.bgC.getBoundingClientRect().width;
        var currentInt = this._cssLeft * scale;
        var diff       = Math.abs(currentInt - (this._targetInt - 2));

        if (diff <= TOL) {
            /* ✅ SUCCESS */
            this._verified         = true;
            this._setColor('22c55e');
            this.sText.textContent = '✓ Verifikasi berhasil!';
            this.sText.style.color = '#15803d';
            this.sBtn.style.borderColor = '#22c55e';
            this.sBtn.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>';
            this.onSuccess();

        } else {
            /* ❌ FAIL — shake & reset */
            var self = this;
            this._setColor('ef4444');
            this.sText.textContent = '✗ Kurang tepat, coba geser lagi';
            this.sText.style.color = '#b91c1c';
            this.sBtn.style.borderColor = '#ef4444';
            this.sBtn.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>';

            /* Shake animation on the slider wrap */
            this.sWrap.style.animation = 'scShake 0.4s ease';
            setTimeout(function () { self.sWrap.style.animation = ''; }, 400);

            /* Slide piece back to 0 smoothly */
            setTimeout(function () {
                self._applyPos(0, true);
                setTimeout(function () {
                    self._setColor('FF7A3D');
                    self.sText.textContent = '← Geser ke kanan untuk verifikasi';
                    self.sText.style.color = '#94a3b8';
                    self.sBtn.innerHTML = _arrowSvg('FF7A3D');
                }, 400);
            }, 300);

            this.onFail();
        }
    };

    /* ────────────────────────────────────────────
       Public: refresh captcha
    ─────────────────────────────────────────── */
    SliderCaptcha.prototype.refresh = function () {
        this._resetSlider();
        this._load();
    };

    /* ────────────────────────────────────────────
       Helper: arrow SVG
    ─────────────────────────────────────────── */
    function _arrowSvg(hex) {
        return '<svg viewBox="0 0 24 24" fill="none" stroke="#' + hex + '" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>';
    }

    /* Inject keyframe for shake */
    (function () {
        if (document.getElementById('sc-keyframes')) return;
        var s = document.createElement('style');
        s.id = 'sc-keyframes';
        s.textContent = '@keyframes scShake{0%,100%{transform:translateX(0)}20%{transform:translateX(-6px)}40%{transform:translateX(6px)}60%{transform:translateX(-4px)}80%{transform:translateX(4px)}}';
        document.head.appendChild(s);
    })();

    /* ────────────────────────────────────────────
       Export
    ─────────────────────────────────────────── */
    if (typeof module !== 'undefined' && module.exports) {
        module.exports = SliderCaptcha;
    } else {
        global.SliderCaptcha = SliderCaptcha;
    }

})(window);
