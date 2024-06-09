<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use App\Models\Task;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class TaskEditScreen extends Screen
{
    private $exists = false;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Task $task = null): iterable
    {
        $this->exists = $task->exists;

        return [
            'task' => $task ?? new Task(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Редактировать задачу';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Сохранить')
                ->icon('check')
                ->method('save'),
            Button::make('Удалить')
                ->icon('trash')
                ->confirm('Вы уверены, что хотите удалить эту задачу?')
                ->method('remove')
                ->canSee($this->exists),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('task.title')
                    ->title('Название')
                    ->placeholder('Введите название задачи')
                    ->required(),

                Input::make('task.description')
                    ->title('Описание')
                    ->placeholder('Введите описание'),

                Switcher::make('task.completed')
                    ->sendTrueOrFalse()
                    ->title('Выполнено'),
            ]),
        ];
    }

    public function save(Task $task)
    {
        $task->fill(request()->get('task'))->save();

        Alert::info('Задача сохранена успешно.');

        return redirect()->route('platform.task.list');
    }

    public function remove(Task $task)
    {
        $task->delete();

        Alert::info('Задача удалена успешно.');

        return redirect()->route('platform.task.list');
    }
}
