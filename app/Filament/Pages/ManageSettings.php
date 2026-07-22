<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use App\Services\SettingsService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;

class ManageSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.manage-settings';

    protected static ?string $navigationGroup = 'System';

    protected static ?string $title = 'Site Settings';

    public ?array $data = [];

    public function mount(SettingsService $settingsService): void
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Settings')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General')
                            ->icon('heroicon-m-globe-alt')
                            ->schema([
                                Forms\Components\TextInput::make('site_name')
                                    ->label('Site Name')
                                    ->required()
                                    ->default('Mohammad Sulieman Ibrahim'),
                                Forms\Components\TextInput::make('site_tagline')
                                    ->label('Tagline')
                                    ->default('Developer, Creator & Writer'),
                                Forms\Components\Textarea::make('site_description')
                                    ->label('Site Description (SEO)')
                                    ->rows(3)
                                    ->maxLength(160)
                                    ->helperText('Used as the default meta description for search engines.'),
                                Forms\Components\FileUpload::make('logo_path')
                                    ->label('Site Logo')
                                    ->image()
                                    ->directory('brand')
                                    ->deletable(true),
                            ]),
                        Forms\Components\Tabs\Tab::make('About Me')
                            ->icon('heroicon-m-user')
                            ->schema([
                                Forms\Components\TextInput::make('author_name')
                                    ->label('Full Name')
                                    ->default('Mohammad Sulieman Ibrahim'),
                                Forms\Components\TextInput::make('author_title')
                                    ->label('Professional Title')
                                    ->default('Full Stack Developer'),
                                Forms\Components\Textarea::make('author_bio')
                                    ->label('Short Bio')
                                    ->rows(4)
                                    ->helperText('A brief introduction displayed on the About page.'),
                                Forms\Components\FileUpload::make('author_photo')
                                    ->label('Profile Photo')
                                    ->image()
                                    ->directory('brand')
                                    ->circleCropper(),
                                Forms\Components\TextInput::make('author_email')
                                    ->label('Contact Email')
                                    ->email(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Social Links')
                            ->icon('heroicon-m-link')
                            ->schema([
                                Forms\Components\TextInput::make('github_url')
                                    ->label('GitHub URL')
                                    ->url()
                                    ->placeholder('https://github.com/username'),
                                Forms\Components\TextInput::make('linkedin_url')
                                    ->label('LinkedIn URL')
                                    ->url()
                                    ->placeholder('https://linkedin.com/in/username'),
                                Forms\Components\TextInput::make('twitter_url')
                                    ->label('Twitter / X URL')
                                    ->url()
                                    ->placeholder('https://twitter.com/username'),
                                Forms\Components\TextInput::make('facebook_url')
                                    ->label('Facebook URL')
                                    ->url(),
                                Forms\Components\TextInput::make('instagram_url')
                                    ->label('Instagram URL')
                                    ->url(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(SettingsService $settingsService): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService->clearCache();

        Notification::make()
            ->success()
            ->title('Settings updated successfully')
            ->send();
    }
}
