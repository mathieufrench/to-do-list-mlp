<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;
use Illuminate\View\View;
use Filament\Forms\Components\Grid;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Usernotnull\Toast\Concerns\WireToast;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class TodoList extends Component implements HasForms, HasTable
{
    use InteractsWithForms; 
    use InteractsWithTable; 
    use WireToast;
    public function mount(): void 
    {
        $this->form->fill();
    } 

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

    public function submit(): void
    {

        // dd($this->form->getState()); 
        $saved = app(Task::class)->createTask($this->form->getState());

        if ($saved == true) {
            $this->form->fill(['task_title' => '']);
            toast()->success('Item added')->push();
        } else {
            toast()->error('Error adding item');
        }
    }


    protected function getTableQuery(): Builder 
    {
        return app(Task::class)->allTasksForUser(auth()->user());
    } 

    protected function getTableColumns(): array 
    {
        return [
            TextColumn::make('title')
        ];
    }

    protected function getTableActions(): array
    {
        return [
            // ...
        ];
    }
}
