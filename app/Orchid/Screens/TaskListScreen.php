<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use App\Models\Task;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class TaskListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'tasks' => Task::all(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список задач';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Создать задачу')
                ->icon('plus')
                ->route('platform.task.create'),
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
            Layout::table('tasks', [
                TD::make('title', 'Название')
                    ->render(function (Task $task) {
                        return Link::make($task->title)
                            ->route('platform.task.edit', $task);
                    }),
                TD::make('completed', 'Выполнено')
                    ->render(function (Task $task) {
                        return $task->completed ? 'Да' : 'Нет';
                    }),
            ]),
        ];
    }
}
