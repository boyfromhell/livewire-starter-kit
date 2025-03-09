<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public string $locale = '';
    public array $locales;

    public function mount(): void
    {
        $this->locale = auth()->user()->locale;
        $this->locales = [
            'en' => 'English',
            'ro' => 'Romanian',
        ];
    }

    public function updateLocale(): void
    {
        $this->validate([
            'locale' => 'required|string|in:en,ro',
        ],
        [
            'locale.in' => __('Invalid language'),
        ]);

        auth()->user()->update([
            'locale' => $this->locale,
        ]);

        $this->dispatch('locale-updated', name: auth()->user()->name);
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Language')" :subheading="__('Select your preferred language')">
        <form wire:submit="updateLocale" class="my-6 w-full space-y-6">
            <flux:select wire:model="locale" placeholder="{{ __('Select language') }}" name="locale">
                @foreach($locales as $key => $locale)
                    <flux:select.option value="{{ $key }}">{{ $locale }}</flux:select.option>
                @endforeach
            </flux:select>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="locale-updated">
                    {{ __('Saved') }}
                </x-action-message>
            </div>
        </form>
    </x-settings.layout>
</section>
