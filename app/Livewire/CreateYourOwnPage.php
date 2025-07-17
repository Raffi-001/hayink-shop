<?php

namespace App\Livewire;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\View\View;
use Livewire\Component;
use Lunar\Facades\CartSession;
use Lunar\Models\Cart;
use Lunar\Models\Order;

class CreateYourOwnPage extends Component implements HasForms
{
    use InteractsWithForms;

    public $positions = [
        'medium-back' => [
            'img' => 'images/positioning-1.png',
        ],
        'full-front' => [
            'img' => 'images/positioning-2.png',
        ],
        'left-chest' => [
            'img' => 'images/positioning-3.png',
        ],
        'left-sleeve' => [
            'img' => 'images/positioning-4.png',
        ],
        'right-sleeve' => [
            'img' => 'images/positioning-5.png',
        ],
        'full-back' => [
            'img' => 'images/positioning-6.png',
        ],
    ];

    public $selectedPositions = [];

    public function togglePosition($key)
    {
        if (in_array($key, $this->selectedPositions)) {
            // Unselect it
            $this->selectedPositions = array_filter(
                $this->selectedPositions,
                fn ($selected) => $selected !== $key
            );
        } else {
            // Select it
            $this->selectedPositions[] = $key;
        }
    }

    public function render(): View
    {
        return view('livewire.create-your-own-page');
    }

    public function form(Form $form)
    {
        return $form->schema([
            Wizard::make([
                Wizard\Step::make('Product Specs')
                    ->schema([
                        Repeater::make('products')
                            ->schema([
                                TextInput::make('design_name')->required(),
                                TextInput::make('quantity')->numeric()->required()->default(10),
                                SpatieMediaLibraryFileUpload::make('design')->required(),
                                Radio::make('position')
                                    ->options([
                                        'medium_back' => 'Medium Back',
                                        'full_front' => 'Full Front',
                                        'left_chest' => 'Left Chest',
                                        'left_sleeve' => 'Left Sleeve',
                                        'right_sleeve' => 'Right Sleeve',
                                        'full_back' => 'Full Back',
                                    ])
                                    ->required(),
                                Textarea::make('notes'),
                            ])->defaultItems(2),
                    ]),
                Wizard\Step::make('Personal Info')
                    ->schema([
                        TextInput::make('name'),
                        TextInput::make('email'),
                        TextInput::make('phone_number'),
                    ])
            ])
        ]);
    }
}
