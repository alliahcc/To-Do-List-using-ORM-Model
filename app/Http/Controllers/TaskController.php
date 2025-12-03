<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        return view('dashboard', compact('tasks'));
    }

    public function createTask(){
        return view('createTask');
    }

    public function handleCreateTask(Request $request){
        $request->validate([
            'taskNo' => ['required', 'regex:/^[0-9]+$/'],
            'taskName' => ['required', 'regex:/^[A-Za-z0-9\s\-\.,!?()]+$/'],
            'priority' => ['required', 'regex:/^[A-Za-z]+$/'],
            'deadline' => ['required', 'date', 'after_or_equal:today'],
        ], [
            'taskNo.required' => 'Enter a Task No.',
            'taskNo.regex' => 'Task No. can only include numbers.',

            'taskName.required' => 'Enter a Task Name.',
            'taskName.regex' => 'Task name can only include letters, numbers, spaces, dashes, and punctuation.',
        
            'priority.required' => 'Enter the priority number.',
            'priority.regex' => 'Priority must be High, Medium, or Low.',
        
            'deadline.required' => 'Enter the submission date.',
            'deadline.date' => 'Enter a valid date.',
            'deadline.after_or_equal' => 'The deadline cannot be in the past.',
        ]);
            // Pass the properties to the insertRecord method
            $this->insertRecord($request);

             // Back to summary or display accounts
             return redirect()->route('dashboard');
    }
    // INSERT RECORD
        public function insertRecord(Request $request){
            $task = Task::create([
                'taskNo' => $request->taskNo,
                'taskName' => $request->taskName,
                'priority' => $request->priority,
                'deadline' => $request->deadline,
                'status' => 'In Progress',
            ]);
        }
    // DISPLAY THE FORM WITH OLD VALUES
        public function editRecord($id) {
            $task = Task::findOrFail($id); 
            return view('updateTask', compact('task'));
        }
    // SAVES THE UPDATED VALUES
        public function updateRecord(Request $request, $id){
            $tasks = Task::findOrFail($id)->update([
                'taskNo' => $request->taskNo,
                'taskName' => $request->taskName,
                'priority' => $request->priority,
                'deadline' => $request->deadline,
        ]);
            return redirect()->route('progress');
        }
        // SOFT DELETE
        public function softDeleteRecord($id) {
            $task = Task::findOrFail($id);
            $task->delete();
            return redirect()->route('dashboard');
        }
        // FORCE DELETE
        public function forceDeleteRecord($id){
            $tasks = Task::withTrashed()->where('id',$id)->forceDelete();
            return redirect()->route('trashbin');
        }
        //RESTORE RECORD
        public function restoreRecord($id){
            $tasks = Task::withTrashed()->where('id',$id)->restore();
            return redirect()->route('dashboard');
        }
        // CHANGE THE STATUS FROM IN PROGRESS TO COMPLETED
        public function completeTask($id){
            $task = Task::find($id);
            $task->status = 'Completed';
            $task->save();
            return redirect()->back()->with('success', 'Task marked as completed!');
        }
        // SHOW IN PROGRESS PAGE
        public function progress(){     
            $tasks = Task::where('status', 'In Progress')->get();
            return view('progress', compact('tasks'));
        }   
        // SHOW COMPLETED PAGE
        public function completed(){
            $tasks = Task::where('status', 'Completed')->get();
            return view('completed', compact('tasks'));
        }
        // SHOW TRASH BIN PAGE
        public function trashbin(){
            $tasks = Task::onlyTrashed()->get();
            return view('trashbin', compact('tasks'));
        }
        public function totalTasks($id)
        {
            $totalTask = Task::count('id');
            return view('dashboard', compact('totalTask'));
        }
}
