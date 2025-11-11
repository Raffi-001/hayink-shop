<?php

namespace App\Livewire;

use App\Mail\CreateYourOwnProductReceived;
use App\Models\CustomProductRequest;
use Awcodes\Palette\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use IbrahimBougaoua\RadioButtonImage\Actions\RadioButtonImage;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\View\View;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Radio;
use Filament\Forms\Get;

class CreateYourOwnPage extends Component implements HasForms
{
    use InteractsWithForms;

    public $name;
    public $phone_number;
    public $email;
    public $design;       // For FileUpload
    public $regions = []; // For multi-region selection
    public $sizes = [];   // For Repeater
    public $product_type = 'tshirt';

    public $tshirtPositions = [
        'medium_back' => 'images/positioning-1.png',
        'full_front' => 'images/positioning-2.png',
        'left_chest' => 'images/positioning-3.png',
        'left_sleeve' => 'images/positioning-4.png',
        'right_sleeve' => 'images/positioning-5.png',
        'full_back' => 'images/positioning-6.png',
    ];

    public $hoodiePositions = [
        'front' => 'images/hoodie-positioning-front.png',
        'back' => 'images/hoodie-positioning-back.png',
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

            Radio::make('product_type')
                ->label('Product Type')
                ->options([
                    'tshirt' => 'T-Shirt',
                    'hoodie' => 'Hoodie',
                ])
                ->default('tshirt')
                ->live(),
                // ->afterStateUpdated(fn ($state, callable $set) => $set('regions', null))

            RadioButtonImage::make('regions')
                ->label('Select T-Shirt Region(s)')
                ->options($this->tshirtPositions)
                ->visible(fn (Get $get): bool=> $get('product_type') === 'tshirt')
                ->required(),

            RadioButtonImage::make('regions')
                ->label('Select Hoodie Region(s)')
                ->options($this->hoodiePositions)
                ->visible(fn (Get $get): bool => $get('product_type') === 'hoodie')
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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['product_type'] = 'tshirt';

        return $data;
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

        Mail::to('kh.hagop@gmail.com')
            ->queue(new CreateYourOwnProductReceived($data));

        return redirect('/thanks-1');
    }
}
