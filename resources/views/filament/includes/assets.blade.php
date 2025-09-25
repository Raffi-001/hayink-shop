{{-- resources/views/filament/includes/fpd-assets.blade.php --}}


<script>
    // Define Alpine helper BEFORE your field uses x-data
    window.fpdField = function ({ state }) {
        return {
            fpd: null,
            state,
            jsonKB: 0,
            get hasDesign(){ return Array.isArray(this.state) && this.state.length > 0 },

            init() {
                const el = this.$refs.stage
                if (!el) return console.error('FPD container missing')

                if (!window.FancyProductDesigner) return console.error('FPD JS not loaded')

                this.fpd = new window.FancyProductDesigner(el, {})

                // Wait until ready, then ensure at least one view exists
                this.fpd.addEventListener('ready', () => {
                    if (this.hasDesign) {
                        this.fpd.loadProduct(this.state)
                    } else {
                        this.fpd.loadProduct([{ title: 'Front', elements: [] }])
                    }
                })

                // Start syncing only after a product exists
                this.fpd.addEventListener('productCreate', () => this.sync())

                ;['elementAdd','elementRemove','elementModify','viewCreate','viewRemove','viewSelect','historyAction']
                    .forEach(evt => this.fpd.addEventListener(evt, () => this.sync()))
            },

            sync() {
                if (!this.fpd || !this.fpd.currentViewInstance) return
                const product = this.fpd.getProduct()
                this.state = product
                try { this.jsonKB = (new Blob([JSON.stringify(product)]).size/1024).toFixed(1) } catch {}
            },
        }
    }
</script>
