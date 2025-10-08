<?php

namespace App\Livewire;

use App\Models\ArtistApplication;
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
        $data = $this->form->getState();

        // 1. Create the application (exclude portfolio_samples since it goes to Spatie media)
        $artistApplication = ArtistApplication::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'phone_number'  => $data['phone_number'],
            'country'       => $data['country'],
            'portfolio_url' => $data['portfolio_url'] ?? null,
            'about_myself'  => $data['about_myself'] ?? null,
            'type_of_design'=> $data['type_of_design'] ?? null,
            'how_did_you_hear' => $data['how_did_you_hear'] ?? null,
        ]);

        // 2. Attach portfolio samples (if uploaded)
        if (!empty($data['porfolio_samples'])) {
            foreach ($data['porfolio_samples'] as $sample) {
                $artistApplication
                    ->addMedia($sample)
                    ->toMediaCollection('porfolio-samples');
            }
        }

        // 3. Flash message + redirect
        session()->flash('success', 'Your application has been submitted successfully!');
        return redirect('/thanks-2');
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
                        TextInput::make('name')->required(),
                        TextInput::make('email')->email()->required(),
                        TextInput::make('phone_number')->required(),
                        TextInput::make('country')->label('Country of residency')->required(),
                    ]),
                Wizard\Step::make('Portfolio')
                    ->schema([
                        TextInput::make('portfolio_url')
                            ->requiredWithout('portfolio_samples')
                            ->helperText('Behance, Instagram, personal site, etc.'),
                        SpatieMediaLibraryFileUpload::make('portfolio_samples')
                            ->collection('portfolio-samples')
                            ->requiredWithout('porfolio_url')
                            ->image()
                            ->previewable()
                            ->multiple(),
                    ]),
                Wizard\Step::make('About')
                    ->schema([
                        Textarea::make('about_myself')->label('Tell Us About Yourself as an Artist'),
                        Textarea::make('type_of_design')->label('What Kind of Designs Do You Create?'),
                        Textarea::make('how_did_you_hear')->label('How did you hear about us?'),
                    ]),
            ])
                ->submitAction(new HtmlString('<button type="submit">Submit</button>'))
                ->nextAction(fn ($action) => $action->label('Next')->color('gray'))
                ->previousAction(fn ($action) => $action->label('Back')->color('gray')),

        ])->statePath('data');
    }
}
