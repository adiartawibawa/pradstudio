<?php

namespace App\Livewire\Pages\Admin\Blog;

use App\Models\Category;
use App\Models\Post;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class EditPost extends Component implements HasSchemas, HasActions
{
    use InteractsWithSchemas;
    use InteractsWithActions;

    public Post $post;

    public ?array $data = [];

    public function mount(string $slug): void
    {
        $this->post = Post::where('slug', $slug)->firstOrFail();

        $this->form->fill($this->post->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255),

                        RichEditor::make('body')
                            ->label('Isi Artikel')
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'],
                                ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                ['table', 'attachFiles'],
                                ['undo', 'redo'],
                            ])
                            ->floatingToolbars([
                                'paragraph' => [
                                    'bold',
                                    'italic',
                                    'underline',
                                    'strike',
                                    'subscript',
                                    'superscript',
                                ],
                                'heading' => [
                                    'h1',
                                    'h2',
                                    'h3',
                                ],
                                'table' => [
                                    'tableAddColumnBefore',
                                    'tableAddColumnAfter',
                                    'tableDeleteColumn',
                                    'tableAddRowBefore',
                                    'tableAddRowAfter',
                                    'tableDeleteRow',
                                    'tableMergeCells',
                                    'tableSplitCell',
                                    'tableToggleHeaderRow',
                                    'tableDelete',
                                ],
                            ])
                            ->required(),

                        Toggle::make('is_featured')
                            ->label('Tulisan Unggulan')
                            ->default(false),

                        FileUpload::make('featured_image')
                            ->label('Gambar Utama')
                            ->directory('posts')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                            ]),

                        Textarea::make('excerpt')
                            ->label('Ringkasan')
                            ->required()
                            ->rows(6)
                            ->maxLength(300)->reactive()
                            ->helperText(function ($state) {
                                $max = 300;
                                $remaining = $max - strlen($state ?? '');

                                if ($remaining <= 20) {
                                    return new HtmlString("<span class='text-red-600 font-semibold'>{$remaining} karakter tersisa</span>");
                                }

                                return "{$remaining} karakter tersisa";
                            }),

                        Select::make('category_id')
                            ->label('Kategori')
                            ->options(Category::query()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required(),
                            ])
                            ->createOptionUsing(function (array $data) {
                                return Category::create($data)->getKey();
                            }),

                        SpatieTagsInput::make('tags')
                            ->label('Tag'),

                        Toggle::make('published')
                            ->label('Publikasikan?')
                            ->default(false)
                            ->reactive(),

                        DateTimePicker::make('publish_date')
                            ->label('Tanggal Publikasi')
                            ->default(now())
                            ->visible(fn($get) => $get('published')),

                        Actions::make([
                            Action::make('update')
                                ->label('Update')
                                ->color('primary')
                                ->action(fn() => $this->update()),

                            Action::make('cancel')
                                ->label('Batal')
                                ->color('secondary')
                                ->action(fn() => $this->redirectRoute('admin.blog')),
                        ]),
                    ])
            ])
            ->statePath('data')
            ->model($this->post);
    }

    public function update(): void
    {
        $this->post->update($this->form->getState());

        Notification::make()
            ->success()
            ->title('Tulisan berhasil diperbaiki')
            ->send();

        $this->redirectRoute('admin.blog.edit', $this->post->slug);
    }

    public function render()
    {
        return view('livewire.pages.admin.blog.edit-post');
    }
}
