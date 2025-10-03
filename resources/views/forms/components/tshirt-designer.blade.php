{{-- resources/views/forms/components/tshirt-designer.blade.php --}}
<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @php
        // read background from field, fallback to neutral if none set
        $bgUrl = $getBackground() ?? 'https://i.ibb.co/2g1cV2c/tshirt-blank.png';
    @endphp

    @assets
    {{-- Load your JS libs here (Fabric.js, etc.) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>
    <style> canvas { border: 1px solid #ddd; } </style>
    @endassets

    <div
        wire:ignore
        x-data
        x-init="$nextTick(() => window.initTshirtDesigner?.('{{ $getId() }}', '{{ $getStatePath() }}', @js($bgUrl), @js($getState())))"
    >
        <input type="file" id="td-input-{{ $getId() }}" class="mb-2">
        <canvas id="td-canvas-{{ $getId() }}" width="400" height="500"></canvas>
    </div>

    @script
    <script>
        // Guard against duplicate definitions when field re-renders:
        window.initTshirtDesigner = window.initTshirtDesigner ?? function (id, statePath, bgUrl, initialState) {
            const canvasEl = document.getElementById('td-canvas-' + id)
            if (!canvasEl || canvasEl.dataset.initialized === '1') return
            canvasEl.dataset.initialized = '1'

            const canvas = new fabric.Canvas('td-canvas-' + id, { preserveObjectStacking: true })

            // ✅ Use background from PHP
            fabric.Image.fromURL(bgUrl, (img) => {
                img.selectable = false
                img.evented = false
                img.scaleToWidth(canvas.getWidth())
                canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas))
            }, { crossOrigin: 'anonymous' })

            // Restore saved JSON (if editing)
            if (initialState && Object.keys(initialState).length) {
                try { canvas.loadFromJSON(initialState, canvas.renderAll.bind(canvas)) } catch (e) {}
            }

            // Upload handler
            const inputEl = document.getElementById('td-input-' + id)
            if (inputEl) {
                inputEl.addEventListener('change', (e) => {
                    const file = e.target.files?.[0]; if (!file) return
                    const reader = new FileReader()
                    reader.onload = (f) => {
                        fabric.Image.fromURL(f.target.result, (img) => {
                            img.set({
                                left: canvas.width/2,
                                top: canvas.height/2,
                                originX: 'center',
                                originY: 'center'
                            })
                            img.scaleToWidth(150)
                            canvas.add(img).setActiveObject(img)
                            canvas.renderAll()
                            // Dehydrate state into the Filament field
                            window.Livewire?.find(@this.__instance.id)?.set(statePath, canvas.toJSON())
                        })
                    }
                    reader.readAsDataURL(file)
                })
            }

            // Save on changes
            canvas.on('object:added', () => window.Livewire?.find(@this.__instance.id)?.set(statePath, canvas.toJSON()))
            canvas.on('object:modified', () => window.Livewire?.find(@this.__instance.id)?.set(statePath, canvas.toJSON()))
        }

        // Re-init after SPA navigation (wire:navigate)
        document.addEventListener('livewire:navigated', () => {
            document.querySelectorAll('[id^="td-canvas-"]').forEach(el => {
                const id = el.id.replace('td-canvas-', '')
                const statePath = el.closest('[wire\\:ignore]')?.querySelector('[id^="td-canvas-"]')
                    ? @json($getStatePath()) : null
                if (statePath) window.initTshirtDesigner(id, statePath, @js($bgUrl), @js($getState()))
            })
        })
    </script>
    @endscript
</x-dynamic-component>
