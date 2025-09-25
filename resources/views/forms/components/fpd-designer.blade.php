<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @assets
    {{-- ✅ your working 3.3.3.0 assets --}}
    <link rel="stylesheet" type="text/css"
          href="http://hi.test/fpd-js/dist/css/fancyProductDesigner.css?v=3.3.3.0">
    <script src="http://hi.test/js/app/fabric.js?v=3.3.3.0"></script>
    <script src="http://hi.test/fpd-js/dist/js/FancyProductDesigner.js?v=3.3.3.0"></script>

    <script>
        // single global helper to initialize exactly once per element
        window.fpdField = function ({ state }) {
            return {
                fpd: null,
                state,            // entangled Livewire state (array of views)
                jsonKB: 0,

                get hasDesign() { return Array.isArray(this.state) && this.state.length > 0 },

                init() {
                    const el = this.$refs.stage
                    if (!el) return console.error('FPD container missing')

                    // 💡 Guard against Livewire/Alpine re-renders
                    if (el.__fpdInitialized) return
                    el.__fpdInitialized = true

                    // 💡 wait until the element has real size (hidden tabs/accordions)
                    const startWhenVisible = () => {
                        if (el.offsetWidth === 0 || el.offsetHeight === 0) {
                            requestAnimationFrame(startWhenVisible); return
                        }

                        const appOptions = {
                            productsJSON: 'http://hi.test/fpd-js/data/products/product-categories.json',
                            designsJSON:  'http://hi.test/designs-catalog',
                            layouts:      'http://hi.test/fpd-js/data/layouts/data.json',
                            langJSON:     'http://hi.test/fpd-js/data/langs/default.json',
                            initialActiveModule: 'products',
                            mainBarModules: ['products', 'images'],
                            textTemplates: [
                                { text: "Text Template Content", properties: { fontSize: 30, fontFamily: "Lobster" } },
                                { text: "Another Text Template", properties: { fontSize: 50, fontFamily: "Pacifico" } },
                            ],
                            fileServerURL: 'http://hi.test/art/upload-design',
                            instagramRedirectUri: 'http://hi.test/fpd-js/data/html/instagram_auth.html',
                            colorPickerPalette: ["#000","#fff"],
                            customImageParameters: { removable:true, draggable:true, resizable:true, autoCenter:true, maxSize:10, autoSelect:true, advancedEditing:true },
                            customTextParameters:  { autoCenter:true, draggable:true, removable:true, colors:false },
                        }

                        // ✅ Instantiate once
                        this.fpd = new window.FancyProductDesigner(el, appOptions)

                        // When core is ready…
                        this.fpd.addEventListener('ready', () => {
                            // If you already have a saved design, restore it.
                            if (this.hasDesign) {
                                try { this.fpd.loadProduct(this.state) } catch (e) { console.warn('loadProduct failed', e) }
                            }
                            // If you prefer to force a blank view when empty, uncomment:
                            // else { this.fpd.loadProduct([{ title: 'Front', elements: [] }]) }
                        })

                        // Start syncing after a product exists
                        const sync = () => {
                            if (!this.fpd || !this.fpd.currentViewInstance) return
                            const product = this.fpd.getProduct()
                            this.state = product
                            try { this.jsonKB = (new Blob([JSON.stringify(product)]).size / 1024).toFixed(1) } catch {}
                        }

                        this.fpd.addEventListener('productCreate', sync)
                        ;['elementAdd','elementRemove','elementModify','viewCreate','viewRemove','viewSelect','historyAction']
                            .forEach(evt => this.fpd.addEventListener(evt, sync))
                    }
                    startWhenVisible()
                },
            }
        }
    </script>
    @endassets

    <div
        x-data="fpdField({
            // two-way bind THIS field’s state; since the field name is 'fpd_design',
            // $getStatePath() points to the correct Livewire key.
            state: $wire.entangle('{{ $getStatePath() }}').defer
        })"
        x-init="init()"
        class="space-y-3"
    >
        <div class="rounded border bg-white">
            {{-- Important: prevent Livewire from patching inside the canvas --}}
            <div x-ref="stage" wire:ignore class="fpd-sidebar fpd-shadow-2 w-full" style="height: 700px;"></div>
        </div>

        <div class="text-xs text-gray-500">
            JSON size: <span x-text="jsonKB"></span> KB
        </div>
    </div>
</x-dynamic-component>
