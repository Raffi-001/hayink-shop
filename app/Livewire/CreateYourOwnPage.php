<?php

namespace App\Livewire;

use App\Models\CustomProductRequest;
use Awcodes\Palette\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\ToggleButtons;
use http\Env\Request;
use IbrahimBougaoua\RadioButtonImage\Actions\RadioButtonImage;
use Livewire\Component;
use Illuminate\View\View;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

class CreateYourOwnPage extends Component implements HasForms
{
    use InteractsWithForms;

    // Livewire properties
    public $name;
    public $phone_number;
    public $email;
    public $design;       // For FileUpload
    public $regions = []; // For multi-region selection
    public $sizes = [];   // For Repeater

    // Image positions
    public $positions = [
        'medium_back' => 'images/positioning-1.png',
        'full_front' => 'images/positioning-2.png',
        'left_chest' => 'images/positioning-3.png',
        'left_sleeve' => 'images/positioning-4.png',
        'right_sleeve' => 'images/positioning-5.png',
        'full_back' => 'images/positioning-6.png',
    ];

    public function mount(): void
    {
        $this->form->fill([
            'name' => null,
            'phone_number' => null,
            'email' => null,
            'design' => null,
            'regions' => [],
            'sizes' => [],
        ]);
    }


    public function render(): View
    {
        return view('livewire.create-your-own-page');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required(),
            TextInput::make('phone_number')
                ->required(),
            TextInput::make('email')
                ->email()
                ->required(),
            // Design Upload
            FileUpload::make('design')
                ->label('Upload Your Design')
                ->image()
                ->directory('designs')
                ->required(),

            // SpatieMediaLibraryFileUpload::make('design')
            //     ->label('Upload Your Design')
            //     ->collection('custom-product-requests')
            //     ->image()
            //     ->required(),

            // Region Selection (multi-select)
            RadioButtonImage::make('regions')
                ->label('Select T-Shirt Region(s)')
                ->options($this->positions)
                ->required(),

            // Sizes & quantities
            Repeater::make('sizes')
                ->label('Sizes & Quantities')
                ->columns(3)
                ->schema([
                    ColorPicker::make('color')
                        ->storeAsKey()
                        ->colors([
                            'black' => '#000000',
                            'white' => '#ffffff',
                            'offwhite' => '#F2F0EF',
                        ]),
                    Select::make('size')
                        ->label('Size')
                        ->options([
                            'XS', 'S', 'M', 'L', 'XL', 'XXL',
                        ])
                        ->dehydrated(),
                    TextInput::make('qty')
                        ->numeric()
                        ->minValue(0)
                        ->default(0)
                        ->label('Quantity'),
                ])
                ->default(function () {
                    return collect(['S','M','L','XL'])->map(fn ($size) => [
                        'size' => $size,
                        'qty' => 0,
                    ])->toArray();
                }),
        ]);
    }

    public function submit()
    {
        $data = $this->form->getState();

        $productRequest = CustomProductRequest::create([
            'name' => data_get($data, 'name'),
            'phone_number' => data_get($data, 'phone_number'),
            'email' => data_get($data, 'email'),
            'regions' => data_get($data, 'regions'),
            'sizes' => data_get($data, 'sizes'),
        ]);

        if (!empty($data['design'])) {
            $path = storage_path('app/public/' . $data['design']);
            $productRequest->addMedia($path)->toMediaCollection('designs');
        }


        // $data['design'] contains the uploaded file path
        session()->flash('success', 'Your order has been submitted!');

        return redirect('/');
    }
}
