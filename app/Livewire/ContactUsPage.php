<?php

namespace App\Livewire;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Livewire\Component;

class ContactUsPage extends Component implements HasForms
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

        // Mail::raw($data['message'], function ($mail) use ($data) {
        //     $mail->from('no-reply@example.com', 'Contact Form'); // 👈 REQUIRED
        //     $mail->to('support@example.com')
        //         ->subject('New Contact Form Message')
        //         ->replyTo($data['email'], $data['name']);
        // });

        session()->flash('success', 'Your message has been sent!');
        $this->form->fill(); // reset form
    }

    public function render(): View
    {
        return view('livewire.contact-us-page');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Full Name')
                ->required(),

            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required(),

            Textarea::make('message')
                ->label('Message')
                ->rows(5)
                ->required(),
        ])->statePath('data');
    }
}
