<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Support\Str;

class BlogPostResource extends Resource
{
    use Translatable;

    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\Section::make('Content Details')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                            Forms\Components\TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true),

                            Forms\Components\Textarea::make('excerpt')
                                ->rows(3)
                                ->required(),

                            Forms\Components\MarkdownEditor::make('content')
                                ->required()
                                ->columnSpanFull(),
                        ])->columnSpan(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\Section::make('Publishing & Images')
                            ->schema([
                                Forms\Components\Toggle::make('is_published')
                                    ->label('Published')
                                    ->default(true),

                                Forms\Components\Select::make('blog_category_id')
                                    ->label('Category')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->nullable(),

                                Forms\Components\Radio::make('image_type')
                                    ->label('Image Source')
                                    ->options([
                                        'upload' => 'Upload File',
                                        'url' => 'Image URL',
                                    ])
                                    ->default(fn ($record) => $record && $record->featured_image_url ? 'url' : 'upload')
                                    ->live()
                                    ->dehydrated(false),

                                Forms\Components\FileUpload::make('featured_image')
                                    ->label('Upload Image')
                                    ->directory('blog-images')
                                    ->image()
                                    ->hidden(fn (Get $get) => $get('image_type') === 'url'),

                                Forms\Components\TextInput::make('featured_image_url')
                                    ->label('External Image URL')
                                    ->url()
                                    ->hidden(fn (Get $get) => $get('image_type') === 'upload'),
                            ]),

                        Forms\Components\Section::make('SEO')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title')
                                    ->label('Meta Title')
                                    ->maxLength(60),
                                Forms\Components\Textarea::make('meta_description')
                                    ->label('Meta Description')
                                    ->rows(2)
                                    ->maxLength(160),
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
                Tables\Columns\TextColumn::make('category.name')->label('Category')->badge()->color('primary'),
                Tables\Columns\IconColumn::make('is_published')->boolean(),
                Tables\Columns\TextColumn::make('views')->label('Views')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Created')->dateTime('M d, Y')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}