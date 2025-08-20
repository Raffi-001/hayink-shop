<x-filament-panels::page>
    <div>
        @assets
        <link rel="stylesheet" type="text/css" href="http://hi.test/fpd-js/dist/css/fancyProductDesigner.css?v=3.3.3.0">
        <script src="http://hi.test/js/app/fabric.js?v=3.3.3.0" defer></script>
        <script src="http://hi.test/fpd-js/dist/js/FancyProductDesigner.js?v=3.3.3.0" defer></script>
        <script>

        </script>
        @endassets
        @script
            <script>
                document.addEventListener('livewire:initialized', () => {
                    // Runs immediately after Livewire has finished initializing
                    // on the page...
                    const appOptions = {
                        productsJSON: 'http://hi.test/fpd-js/data/products/product-categories.json',
                        designsJSON: 'http://hi.test/designs-catalog',
                        layouts: 'http://hi.test/fpd-js/data/layouts/data.json',
                        langJSON: 'http://hi.test/fpd-js/data/langs/default.json',
                        initialActiveModule: 'products',
                        // modalMode: '#open-modal',
                        mainBarModules: [
                            'products',
                            // 'images',
                            // 'text',
                            'designs',
                            // 'manage-layers',
                            // 'text-layers',
                            // 'save-load'
                        ],
                        textTemplates: [
                            {
                                text: "Text Template Content",
                                properties: {
                                    fontSize: 30,
                                    fontFamily: "Lobster"
                                }
                            },
                            {
                                text: "Another Text Template",
                                properties: {
                                    fontSize: 50,
                                    fontFamily: "Pacifico"
                                }
                            }
                        ],
                        fileServerURL: 'http://hi.test/art/upload-design', //enter the url to the file-handler.php, see https://github.com/radykal/fpd-js-server
                        facebookAppId: '',
                        instagramClientId: '',
                        instagramRedirectUri: 'http://hi.test/fpd-js/data/html/instagram_auth.html',
                        instagramTokenUri: '', //enter the url to the instagram-token.php, see https://github.com/radykal/fpd-js-server
                        colorPickerPalette: ["#000", "#f4cccc", "#fce5cd", "#fff2cc", "#d9ead3", "#d0e0e3", "#cfe2f3", "#d9d2e9", "#ead1dc", '#5f27cd', '#222f3e', '#10ac84'],
                        pixabayApiKey: '',
                        pixabayLang: 'en',
                        pixabayHighResImages: false,
                        elementParameters: {

                        },
                        customImageParameters: {
                            removable: true,
                            draggable: true,
                            resizable: true,
                            autoCenter: true,
                            // price: 10,
                            maxSize: 10,
                            autoSelect: true,
                            advancedEditing: true
                        },
                        customTextParameters: {
                            autoCenter: true,
                            draggable: true,
                            removable: true,
                            colors: true,
                        },
                    }


                const fpd = new FancyProductDesigner(
                    document.getElementById('fpd-target'),
                    appOptions
                );

                    console.log(fpd.getProduct());

                })

            </script>
        @endscript

        <div id="fpd-target" class="fpd-sidebar fpd-shadow-2 " style="height: 1000px;"></div>

    </div>

</x-filament-panels::page>
