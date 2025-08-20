<?php

namespace App\Livewire;

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

    public function render(): View
    {
        return view('livewire.create-your-own-page');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('design')
                ->label('Upload Your Design')
                ->image()
                ->directory('designs')
                ->required(),

            CheckboxList::make('regions')
                ->label('Select T-Shirt Region(s)')
                ->options([
                    'front' => 'Front',
                    'back' => 'Back',
                    'left_sleeve' => 'Left Sleeve',
                    'right_sleeve' => 'Right Sleeve',
                ])
                ->required(),

            Repeater::make('sizes')
                ->label('Sizes & Quantities')
                ->schema([
                    TextInput::make('size')
                        ->label('Size')
                        ->disabled()
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

        // Example: Save to DB or fire event
        // TShirtOrder::create($data);

        session()->flash('success', 'Your order has been submitted!');
    }
}
