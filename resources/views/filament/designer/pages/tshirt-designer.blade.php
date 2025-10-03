<x-filament::page>
    <h2 class="text-xl font-bold mb-4">🧵 Simple T-Shirt Designer</h2>

    <input type="file" id="fileInput" class="mb-4">

    <canvas id="tshirtCanvas" width="400" height="500" class="border border-gray-300"></canvas>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const canvas = new fabric.Canvas('tshirtCanvas', {
                preserveObjectStacking: true
            });

            // Background t-shirt
            const tshirtUrl = "http://hi.test/fpd-js/images/t-oversize-black-front.png"; // replace with your own
            fabric.Image.fromURL(tshirtUrl, (img) => {
                img.selectable = false;
                img.evented = false;
                img.scaleToWidth(canvas.width);
                canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
            });

            // File upload
            document.getElementById('fileInput').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function(f) {
                    fabric.Image.fromURL(f.target.result, (img) => {
                        img.set({
                            left: canvas.width / 2,
                            top: canvas.height / 2,
                            originX: 'center',
                            originY: 'center',
                            cornerStyle: 'circle',
                            transparentCorners: false,
                        });
                        img.scaleToWidth(150);
                        canvas.add(img).setActiveObject(img);
                        canvas.renderAll();
                    });
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
</x-filament::page>
