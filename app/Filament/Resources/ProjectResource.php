<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Concerns\Translatable;

class ProjectResource extends Resource
{
    use Translatable;

    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\Section::make('Project Details')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                            Forms\Components\TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true),

                            Forms\Components\TextInput::make('url')
                                ->label('Project URL')
                                ->url()
                                ->placeholder('https://example.com')
                                ->helperText('The live website URL. Will be shown as an iframe preview on the portfolio page.'),

                            Forms\Components\Textarea::make('description')
                                ->rows(4)
                                ->required(),

                            Forms\Components\TagsInput::make('technologies')
                                ->placeholder('Add a technology...')
                                ->helperText('e.g. Laravel, React, Vue.js, PHP')
                                ->separator(','),
                        ])->columnSpan(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\Section::make('Publishing')
                            ->schema([
                                Forms\Components\Toggle::make('is_published')
                                    ->label('Published')
                                    ->default(true),

                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Featured Project')
                                    ->helperText('Featured projects appear first and on the homepage.'),

                                Forms\Components\TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Lower numbers appear first.'),
                            ]),

                        Forms\Components\Section::make('Fallback Image')
                            ->description('Used when iframe cannot load the site.')
                            ->schema([
                                Forms\Components\FileUpload::make('featured_image')
                                    ->label('Screenshot / Image')
                                    ->directory('project-images')
                                    ->image()
                                    ->imageEditor(),
                            ]),
                    ])->columnSpan(1),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('display_image')->label('Image')->square(),
                Tables\Columns\TextColumn::make('title')->searchable()->weight('bold')->limit(40),
                Tables\Columns\TextColumn::make('url')->label('URL')->limit(30)->color('primary'),
                Tables\Columns\IconColumn::make('is_featured')->boolean()->label('Featured'),
                Tables\Columns\IconColumn::make('is_published')->boolean()->label('Published'),
                Tables\Columns\TextColumn::make('sort_order')->label('Order')->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
