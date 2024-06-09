<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Task;
use Orchid\Support\Facades\Layout;

class TaskShowScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Task $task): iterable
    {
        return [
            'task' => $task
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Просмотр задачи';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::legend('task', [
                'title'       => 'Название',
                'description' => 'Описание',
                'completed'   => 'Выполнено',
            ]),
        ];
    }
}
