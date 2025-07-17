<?php

namespace App\Livewire;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Support\HtmlString;

class ApplyAsAnArtistPage extends Component implements HasForms
{
    use InteractsWithForms;

    public array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function submit()
    {
        //
    }

    public function render(): View
    {
        return view('livewire.apply-as-an-artist-page');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Wizard::make([
                Wizard\Step::make('Personal Information')
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->required(),
                        TextInput::make('phone_number')
                            ->required(),
                        TextInput::make('country')
                            ->label('Country of residency')
                            ->required(),
                    ]),
                Wizard\Step::make('Delivery')
                    ->schema([
                        TextInput::make('portfolio_url')
                            ->helperText('Behance, Instagram, personal site, etc.'),
                        SpatieMediaLibraryFileUpload::make('porfolio_samples')
                            ->image()
                            ->previewable()
                            ->multiple(),
                    ]),
                Wizard\Step::make('Billing')
                    ->schema([
                        Textarea::make('about_myself')
                            ->label('Tell Us About Yourself as an Artist'),
                        Textarea::make('type_of_design')
                            ->label('What Kind of Designs Do You Create?'),
                        Textarea::make('how_did_you_hear')
                            ->label('How did you hear about us?'),
                    ]),
            ])->submitAction(new HtmlString('<button type="submit">Submit</button>'))
                ->nextAction(fn ($action) => $action->label('Next')->color('gray'))
                ->previousAction(fn ($action) => $action->label('Back')->color('gray')),

        ])->statePath('data');
    }
}
