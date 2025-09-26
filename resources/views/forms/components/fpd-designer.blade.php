<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @assets
    <link rel="stylesheet" type="text/css"
          href="http://hi.test/fpd-js/dist/css/fancyProductDesigner.css?v=3.3.3.0">
    <script src="http://hi.test/js/app/fabric.js?v=3.3.3.0"></script>
    <script src="http://hi.test/fpd-js/dist/js/FancyProductDesigner.js?v=3.3.3.0"></script>

    <script>
        window.fpdField = function ({ state }) {
            return {
                fpd: null,
                state,
                jsonKB: 0,

                get hasDesign() {
                    return Array.isArray(this.state) && this.state.length > 0
                },

                init() {
                    const el = this.$refs.stage
                    if (!el || el.__fpdInitialized) return
                    el.__fpdInitialized = true

                    const startWhenVisible = () => {
                        if (el.offsetWidth === 0 || el.offsetHeight === 0) {
                            requestAnimationFrame(startWhenVisible)
                            return
                        }

                        const appOptions = {
                            productsJSON: 'http://hi.test/fpd-js/data/products/product-categories.json',
                            designsJSON:  'http://hi.test/designs-catalog',
                            layouts:      'http://hi.test/fpd-js/data/layouts/data.json',
                            langJSON:     'http://hi.test/fpd-js/data/langs/default.json',
                            initialActiveModule: 'products',
                            mainBarModules: ['products', 'images', 'text', 'uploads'],
                            customImageParameters: { autoCenter: true, draggable: true, resizable: true, removable: true },
                            customTextParameters: { autoCenter: true, draggable: true, removable: true }
                        }

                        this.fpd = new window.FancyProductDesigner(el, appOptions)
                        window.currentFPD = this.fpd

                        this.fpd.addEventListener('ready', () => {
                            if (this.hasDesign) {
                                try { this.fpd.loadProduct(this.state) } catch (e) {}
                            }
                        })

                        const sync = () => {
                            if (!this.fpd || !this.fpd.currentViewInstance) return
                            const product = this.fpd.getProduct()
                            if (product && product.length > 0) {
                                this.state = product
                                try { this.jsonKB = (new Blob([JSON.stringify(product)]).size / 1024).toFixed(1) } catch {}
                            }
                        }

                        this.fpd.addEventListener('productCreate', sync)
                        ;['elementAdd','elementRemove','elementModify','viewCreate','viewRemove','viewSelect','historyAction']
                            .forEach(evt => this.fpd.addEventListener(evt, sync))

                        // ✅ Listen for Livewire upload events
                            Livewire.on("fpd-add-images", (data) => {
                                const urls = data.urls || []
                                console.log('🔍 FPD received URLs:', urls) // 👈 debug log
                                urls.forEach(url => {
                                    this.fpd.addCustomImage(url, "Uploaded Image", {
                                        autoCenter: true,
                                        removable: true,
                                        resizable: true,
                                        draggable: true,
                                    })
                                })
                            })
                    }
                    startWhenVisible()
                },
            }
        }
    </script>
    @endassets

    <div
        x-data="fpdField({
            state: $wire.entangle('{{ $getStatePath() }}').defer
        })"
        x-init="init()"
        class="space-y-3"
    >
        <div class="rounded border bg-white" wire:ignore> {{-- ✅ FULL wire:ignore --}}
            <div x-ref="stage" class="fpd-sidebar fpd-shadow-2 w-full" style="height: 700px;"></div>
        </div>

        <div class="text-xs text-gray-500">
            JSON size: <span x-text="jsonKB"></span> KB
        </div>
    </div>
</x-dynamic-component>
