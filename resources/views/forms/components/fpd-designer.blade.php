{{-- resources/views/forms/components/fpd-designer.blade.php --}}

<script>
    // define BEFORE x-data runs
    window.fpdField = window.fpdField ?? function ({ state }) {
        return {
            fpd: null,
            state,
            jsonKB: 0,
            get hasDesign() { return Array.isArray(this.state) && this.state.length > 0 },
            init() {
                const el = this.$refs.stage
                if (!window.FancyProductDesigner) {
                    console.error('FancyProductDesigner is not on window.')
                    return
                }
                this.fpd = new window.FancyProductDesigner(el, {})

                this.fpd.addEventListener('ready', () => {
                    if (this.hasDesign) this.fpd.loadProduct(this.state)
                    this.sync()
                })

                ;['elementAdd','elementRemove','elementModify','viewCreate','viewRemove','viewSelect','historyAction']
                    .forEach(evt => this.fpd.addEventListener(evt, () => this.sync()))
            },
            sync() {
                const product = this.fpd.getProduct()
                this.state = product
                try { this.jsonKB = (new Blob([JSON.stringify(product)]).size / 1024).toFixed(1) } catch {}
            },
        }
    }
</script>

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div
        x-data="fpdField({ state: $wire.entangle('{{ $getStatePath() }}').defer })"
        x-init="init()"
        class="space-y-3"
    >
        <div class="rounded border bg-white">
            <div x-ref="stage" style="min-height:520px"></div>
        </div>
        <div class="text-xs text-gray-500">
            JSON size: <span x-text="jsonKB"></span> KB
        </div>
    </div>
</x-dynamic-component>
