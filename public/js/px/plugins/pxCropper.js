/*!
 * jQuery Image Cropper (ICP)
 * Full readable version
 */

(function ($) {
    const defaults = {
        outputWidth: 800,
        outputHeight: 600,
        aspectRatio: null,
        maxFileSize: 95000,
        allowedMb: 10,
        mimeType: "image/jpeg",
        quality: 0.92,
        minQuality: 0.5,
        maxDimension: 4000,
        boundingBox: null,
        onOpen: null,
        onClose: null,
        onComplete: null
    };

    // Convert Base64 DataURL to Blob
    function dataURLtoBlob(dataURL) {
        const parts = dataURL.split(",");
        const mime = parts[0].match(/:(.*?);/)[1];
        const binary = atob(parts[1]);
        const len = binary.length;
        const u8 = new Uint8Array(len);
        for (let i = 0; i < len; i++) u8[i] = binary.charCodeAt(i);
        return new Blob([u8], { type: mime });
    }

    $.fn.imageCropper = function (options) {
        const settings = $.extend({}, defaults, options || {});
        if (!settings.outputWidth || !settings.outputHeight) {
            console.error("imageCropper: outputWidth and outputHeight must be specified.");
            return this;
        }

        let modalElements = null;
        let state = null;

        // Create or reuse modal
        function createModal() {
            if (modalElements) return modalElements;

            const $overlay = $('<div class="icp-overlay" style="display:none"></div>');
            const $modal = $(`
                <div class="icp-modal" role="dialog" aria-modal="true" aria-label="Image cropper">
                    <div class="icp-header">
                        <div>
                            <div class="icp-title">Crop Image</div>
                            <div class="icp-hint">Drag to pan; mousewheel to zoom; use slider to adjust zoom.</div>
                        </div>
                        <div>
                            <button class="icp-btn secondary icp-cancel">Cancel</button>
                            <button class="icp-btn icp-confirm">Crop & Save</button>
                        </div>
                    </div>
                    <div class="icp-body">
                        <div class="icp-canvas-wrap">
                            <canvas class="icp-canvas"></canvas>
                            <div class="icp-crop-box" aria-hidden="true"></div>
                        </div>
                        <div class="icp-controls">
                            <div>
                                <label>Zoom</label>
                                <input type="range" class="icp-zoom" min="0.1" max="3" step="0.01" value="1">
                            </div>
                            <div>
                                <label>Preview output size</label>
                                <div class="icp-preview" style="border:1px solid #ddd; padding:6px; text-align:center;">
                                    <canvas class="icp-preview-canvas" width="200" height="150" style="max-width:100%;height:auto"></canvas>
                                </div>
                            </div>
                            <div style="margin-top:auto">
                                <div style="font-size:13px;color:#444">Output: <span class="icp-output-size"></span></div>
                                <div style="font-size:12px;color:#666;margin-top:6px">Format: <span class="icp-mime"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="icp-footer">
                        <button class="icp-btn secondary icp-cancel2">Cancel</button>
                        <button class="icp-btn icp-confirm2">Crop & Save</button>
                    </div>
                </div>
            `);

            $overlay.append($modal);
            $("body").append($overlay);

            modalElements = {
                $overlay,
                $modal,
                $canvas: $modal.find(".icp-canvas"),
                $cropBox: $modal.find(".icp-crop-box"),
                $zoom: $modal.find(".icp-zoom"),
                $previewCanvas: $modal.find(".icp-preview-canvas"),
                $outputSize: $modal.find(".icp-output-size"),
                $mime: $modal.find(".icp-mime"),
                $confirm: $modal.find(".icp-confirm, .icp-confirm2"),
                $cancel: $modal.find(".icp-cancel, .icp-cancel2")
            };
            return modalElements;
        }

        // Open cropper modal
        function openCropper(file, fileName) {
            const ui = createModal();
            const canvas = ui.$canvas[0];
            const ctx = canvas.getContext("2d");
            const preview = ui.$previewCanvas[0];
            const previewCtx = preview.getContext("2d");

            state = {
                img: new Image(),
                imgNaturalWidth: 0,
                imgNaturalHeight: 0,
                translate: { x: 0, y: 0 },
                scale: 1,
                dragging: false,
                lastPointer: null
            };

            ui.$mime.text(settings.mimeType);
            ui.$outputSize.text(`${settings.outputWidth}px × ${settings.outputHeight}px`);

            const reader = new FileReader();
            reader.onload = (ev) => {
                state.img.onload = function () {
                    let iw = state.img.naturalWidth;
                    let ih = state.img.naturalHeight;

                    // Downscale if too large
                    if (settings.maxDimension && Math.max(iw, ih) > settings.maxDimension) {
                        const scale = settings.maxDimension / Math.max(iw, ih);
                        iw = Math.round(iw * scale);
                        ih = Math.round(ih * scale);
                        const tempCanvas = document.createElement("canvas");
                        tempCanvas.width = iw;
                        tempCanvas.height = ih;
                        tempCanvas.getContext("2d").drawImage(state.img, 0, 0, iw, ih);
                        state.img = new Image();
                        state.img.onload = setupCanvas;
                        state.img.src = tempCanvas.toDataURL("image/png");
                    } else {
                        setupCanvas();
                    }

                    function setupCanvas() {
                        state.imgNaturalWidth = iw;
                        state.imgNaturalHeight = ih;
                        const parentRect = ui.$canvas.parent()[0].getBoundingClientRect();
                        const displayWidth = Math.max(300, Math.floor(parentRect.width));
                        const displayHeight = Math.max(200, Math.floor(Math.min(parentRect.height, 0.6 * window.innerHeight)));
                        const dpr = window.devicePixelRatio || 1;

                        canvas.width = displayWidth * dpr;
                        canvas.height = displayHeight * dpr;
                        canvas.style.width = `${displayWidth}px`;
                        canvas.style.height = `${displayHeight}px`;
                        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
                        ctx.imageSmoothingQuality = "high";

                        state.scale = Math.min(displayWidth / iw, displayHeight / ih, 1);
                        state.translate.x = (displayWidth - iw * state.scale) / 2;
                        state.translate.y = (displayHeight - ih * state.scale) / 2;

                        let cropW, cropH;
                        if (settings.boundingBox) {
                            cropW = settings.boundingBox.width;
                            cropH = settings.boundingBox.height;
                        } else {
                            const ratio = settings.aspectRatio || (settings.outputWidth / settings.outputHeight);
                            cropW = 0.8 * displayWidth;
                            cropH = cropW / ratio;
                            if (cropH > 0.8 * displayHeight) {
                                cropH = 0.8 * displayHeight;
                                cropW = cropH * ratio;
                            }
                        }

                        ui.$cropBox.css({
                            width: cropW + "px",
                            height: cropH + "px",
                            left: (displayWidth - cropW) / 2 + "px",
                            top: (displayHeight - cropH) / 2 + "px"
                        });

                        ui.$zoom.attr({ min: 0.1, max: Math.max(3, 5 * state.scale) }).val(state.scale);

                        renderMain();
                        renderPreview();
                    }
                };
                state.img.src = ev.target.result;
            };
            reader.readAsDataURL(file);

            ui.$overlay.fadeIn(100);
            if (typeof settings.onOpen === "function") settings.onOpen();

            // === Interactions ===
            function pointerPos(evt) {
                if (evt.touches && evt.touches.length) return { x: evt.touches[0].clientX, y: evt.touches[0].clientY };
                return { x: evt.clientX, y: evt.clientY };
            }
            function canvasOffsetPos(x, y) {
                const rect = canvas.getBoundingClientRect();
                return { x: x - rect.left, y: y - rect.top };
            }
            function startDrag(e) { e.preventDefault(); state.dragging = true; state.lastPointer = canvasOffsetPos(pointerPos(e).x, pointerPos(e).y); }
            function moveDrag(e) { if (!state.dragging) return; e.preventDefault(); const now = canvasOffsetPos(pointerPos(e).x, pointerPos(e).y); state.translate.x += now.x - state.lastPointer.x; state.translate.y += now.y - state.lastPointer.y; state.lastPointer = now; renderMain(); renderPreview(); }
            function stopDrag() { state.dragging = false; }
            function onWheel(e) { e.preventDefault(); const factor = e.deltaY < 0 ? 1.08 : 0.92; const p = canvasOffsetPos(pointerPos(e).x, pointerPos(e).y); const old = state.scale; const newScale = Math.max(parseFloat(ui.$zoom.attr("min")), Math.min(parseFloat(ui.$zoom.attr("max")), old * factor)); const dx = (p.x - state.translate.x) / old; const dy = (p.y - state.translate.y) / old; state.scale = newScale; state.translate.x = p.x - dx * newScale; state.translate.y = p.y - dy * newScale; ui.$zoom.val(state.scale); renderMain(); renderPreview(); }
            function zoomSlider() { const val = parseFloat(ui.$zoom.val()); const cropRect = ui.$cropBox[0].getBoundingClientRect(); const canvasRect = canvas.getBoundingClientRect(); const centerX = (cropRect.left + cropRect.right) / 2 - canvasRect.left; const centerY = (cropRect.top + cropRect.bottom) / 2 - canvasRect.top; const oldScale = state.scale; const dx = (centerX - state.translate.x) / oldScale; const dy = (centerY - state.translate.y) / oldScale; state.scale = val; state.translate.x = centerX - dx * val; state.translate.y = centerY - dy * val; renderMain(); renderPreview(); }

            function renderMain() {
                const dpr = window.devicePixelRatio || 1;
                const w = canvas.width / dpr;
                const h = canvas.height / dpr;
                ctx.clearRect(0, 0, w, h);
                ctx.fillStyle = "#222";
                ctx.fillRect(0, 0, w, h);
                ctx.save();
                ctx.translate(state.translate.x, state.translate.y);
                ctx.scale(state.scale, state.scale);
                ctx.drawImage(state.img, 0, 0);
                ctx.restore();

                const cropRect = ui.$cropBox[0].getBoundingClientRect();
                const canvasRect = canvas.getBoundingClientRect();
                const x = cropRect.left - canvasRect.left;
                const y = cropRect.top - canvasRect.top;
                const cw = cropRect.width;
                const ch = cropRect.height;

                ctx.fillStyle = "rgba(0,0,0,0.45)";
                ctx.fillRect(0, 0, w, y);
                ctx.fillRect(0, y, x, ch);
                ctx.fillRect(x + cw, y, w - (x + cw), ch);
                ctx.fillRect(0, y + ch, w, h - (y + ch));
            }

            function getCropRect() {
                const cropRect = ui.$cropBox[0].getBoundingClientRect();
                const canvasRect = canvas.getBoundingClientRect();
                const srcX = (cropRect.left - canvasRect.left - state.translate.x) / state.scale;
                const srcY = (cropRect.top - canvasRect.top - state.translate.y) / state.scale;
                const srcW = cropRect.width / state.scale;
                const srcH = cropRect.height / state.scale;
                return { srcX, srcY, srcW, srcH };
            }

            function renderPreview() {
                const rect = getCropRect();
                const pw = preview.width;
                const ph = preview.height;
                previewCtx.clearRect(0, 0, pw, ph);
                previewCtx.fillStyle = "#fff";
                previewCtx.fillRect(0, 0, pw, ph);
                previewCtx.drawImage(state.img, rect.srcX, rect.srcY, rect.srcW, rect.srcH, 0, 0, pw, ph);
            }

            function closeCropper() {
                canvas.removeEventListener("mousedown", startDrag);
                canvas.removeEventListener("touchstart", startDrag);
                window.removeEventListener("mousemove", moveDrag);
                window.removeEventListener("touchmove", moveDrag);
                window.removeEventListener("mouseup", stopDrag);
                window.removeEventListener("touchend", stopDrag);
                canvas.removeEventListener("wheel", onWheel);
                ui.$zoom.off("input change", zoomSlider);
                ui.$overlay.fadeOut(120);
                state = null;
                if (typeof settings.onClose === "function") settings.onClose();
            }

            canvas.addEventListener("mousedown", startDrag);
            canvas.addEventListener("touchstart", startDrag, { passive: false });
            window.addEventListener("mousemove", moveDrag);
            window.addEventListener("touchmove", moveDrag, { passive: false });
            window.addEventListener("mouseup", stopDrag);
            window.addEventListener("touchend", stopDrag);
            canvas.addEventListener("wheel", onWheel, { passive: false });
            ui.$zoom.on("input change", zoomSlider);
            ui.$cancel.off("click").on("click", closeCropper);
            ui.$overlay.off("click").on("click", (e) => { if (e.target === ui.$overlay[0]) closeCropper(); });

            ui.$confirm.off("click").on("click", async function () {
                ui.$confirm.prop("disabled", true).text("Processing...");
                try {
                    const cropped = await cropAndCompress();
                    const input = ui.$modal.data("triggerInput") || $("input[type=file]").first();
                    if (input && cropped && cropped.blob) {
                        const file = new File([cropped.blob], cropped.fileName, { type: cropped.mimeType });
                        const dt = new DataTransfer();
                        dt.items.add(file);
                        input[0].files = dt.files;
                        if (input[0].nextElementSibling?.tagName === "LABEL") input[0].nextElementSibling.textContent = file.name;
                        else input.attr("title", file.name);
                    }
                    if (typeof settings.onComplete === "function") settings.onComplete(cropped);
                } catch (err) { console.error("Crop error", err); }
                finally { ui.$confirm.prop("disabled", false).text("Crop & Save"); closeCropper(); }
            });

            async function cropAndCompress() {
                if (!state || !state.img) return null;
                const rect = getCropRect();
                const outW = settings.outputWidth;
                const outH = settings.outputHeight;
                const outCanvas = document.createElement("canvas");
                outCanvas.width = outW;
                outCanvas.height = outH;
                const outCtx = outCanvas.getContext("2d");
                outCtx.fillStyle = settings.mimeType === "image/png" ? "rgba(0,0,0,0)" : "#fff";
                outCtx.fillRect(0, 0, outW, outH);
                outCtx.drawImage(state.img, rect.srcX, rect.srcY, rect.srcW, rect.srcH, 0, 0, outW, outH);

                let quality = settings.quality;
                let dataURL = outCanvas.toDataURL(settings.mimeType, quality);
                let blob = dataURLtoBlob(dataURL);

                if (settings.maxFileSize && blob.size > settings.maxFileSize) {
                    if (settings.mimeType === "image/jpeg") {
                        while (blob.size > settings.maxFileSize && quality > settings.minQuality + 0.01) {
                            quality -= 0.06;
                            dataURL = outCanvas.toDataURL("image/jpeg", quality);
                            blob = dataURLtoBlob(dataURL);
                        }
                    }

                    // Resize loop if still too big
                    let attempt = 0, w = outW, h = outH;
                    while (blob.size > settings.maxFileSize && attempt < 8) {
                        attempt++;
                        w = Math.round(w * 0.9);
                        h = Math.round(h * 0.9);
                        outCanvas.width = w;
                        outCanvas.height = h;
                        outCtx.fillStyle = settings.mimeType === "image/png" ? "rgba(0,0,0,0)" : "#fff";
                        outCtx.fillRect(0, 0, w, h);
                        outCtx.drawImage(state.img, rect.srcX, rect.srcY, rect.srcW, rect.srcH, 0, 0, w, h);
                        dataURL = outCanvas.toDataURL(settings.mimeType, quality);
                        blob = dataURLtoBlob(dataURL);
                    }
                }

                return {
                    blob,
                    dataURL,
                    fileName: fileName || "cropped." + (settings.mimeType === "image/jpeg" ? "jpg" : "png"),
                    mimeType: settings.mimeType,
                    width: outCanvas.width,
                    height: outCanvas.height
                };
            }
        }

        // Bind to input elements
        return this.each(function () {
            const $input = $(this);
            $input.on("change", function () {
                const file = this.files[0];
                if (!file) return;
                if (file.size > settings.allowedMb * 1024 * 1024) { alert("File too large!"); return; }
                createModal().$modal.data("triggerInput", $input);
                openCropper(file, file.name);
            });
        });
    };
})(jQuery);
