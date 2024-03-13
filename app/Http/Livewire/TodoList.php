<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;
use Illuminate\View\View;
use Filament\Forms\Components\Grid;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;

class TodoList extends Component implements HasForms
{
    use InteractsWithForms; 
    public function render(): View
    {
        return view('tasks')->extends('layouts.app');
    }


    protected function getFormSchema(): Array 
    {
        return [
            Grid::make()
                ->schema([
                    TextInput::make('task_title')
                        ->disableLabel() // This keeps the label available for screen-readers
                        ->placeholder(__('fields.taskTitle'))
                        ->required()
                ])
        ];
    }

    public function submit($title): void
    {
        $saved = app(Task::class)->createTask($this->form->getState());

        if ($saved == true) {
            toast()->success('Item added');
        } else if ($saved = null) {
            toast()->notice('Cannot add blank task');
        } else {
            toast()->error('Error adding item');
        }
    }
}
