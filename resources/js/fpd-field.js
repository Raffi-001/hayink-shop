// resources/js/fpd-field.js
window.fpdField = function ({ state }) {
    return {
        fpd: null,
        state,
        jsonKB: 0,
        get hasDesign() { return Array.isArray(this.state) && this.state.length > 0 },
        init() {
            const el = this.$refs.stage
            this.fpd = new window.FancyProductDesigner(el, {})
            this.fpd.addEventListener('ready', () => { if (this.hasDesign) this.fpd.loadProduct(this.state); this.sync() })
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
