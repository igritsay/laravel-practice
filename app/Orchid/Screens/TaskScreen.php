<?php

namespace App\Orchid\Screens;

use App\Models\Task;
use App\Models\User;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;

class TaskScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'tasks' => Task::latest()->get(),
            'users' => User::latest()->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Simple To-Do List';
    }

    public function description(): ?string
    {
        return 'Orchid Quickstart';
    }


    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Add Task')
                ->modal('taskModal')
                ->method('create')
                ->icon('plus'),
        ];
    }

    public function create(Request $request): void
    {
        // Validate form data, save task to database, etc.
        $request->validate([
            'task.name' => 'required|max:255',
        ]);

        $task = new Task();
        $task->name = $request->input('task.name');
        $task->save();
    }

    public function delete(Task $task): void
    {
        $task->delete();
        Alert::error('Tas was deleted successfully!');
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
                TD::make('name'),
                TD::make('Actions')
//                    ->render(function ($task) {
//                        dump($task->active);
//                    })
                    ->alignRight()
                    ->render(function (Task $task) {
                        return Button::make('Delete Task')
                            ->confirm('After deleting, the task will be gone forever.')
                            ->method('delete', ['task' => $task->id]);
                    }),
            ]),
            Layout::rows([
                ModalToggle::make('Add Task')
                ->modal('taskModal')
                ->method('create')
                ->icon('plus')
            ]),
//            Layout::table('users', [
//                TD::make('id'),
//                TD::make('name'),
//                TD::make('email'),
//            ]),
            Layout::modal('taskModal', Layout::rows([
                Input::make('task.name')
                    ->title('Name')
                    ->placeholder('Enter task name')
                    ->help('The name of the task to be created.'),
            ]))
                ->title('Create Task')
                ->applyButton('Add Task'),
        ];
    }
}
