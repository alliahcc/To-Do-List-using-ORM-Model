@extends('layouts.master')

@section('content_here')

<div class="row mt-5 justify-content-center">
    <div class="col-md-4">
       <h2 class="mb-4" style="color: #693D6D;">Add Task</h2>
         <div class="card shadow p-4">
             <div class="card-body">
                    <form action="{{route('createTask.submit')}}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="taskNo" class="form-label">Task No.</label>
                            <input name="taskNo" value="{{old('taskNo')}}" type="text" class="form-control">
                        </div>
                        @error('taskNo')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        <div class="mb-2">
                            <label for="taskName" class="form-label">Task Name</label>
                            <input name="taskName" value="{{old('taskName')}}" type="text" class="form-control">
                        </div>
                        @error('taskName')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div class="mb-2">
                            <label for="priority" class="form-label">Priority</label>
                            <input name="priority" value="{{old('priority')}}" type="text" class="form-control">
                        </div>
                        @error('priority')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div class="mb-2">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input name="deadline" value="{{old('deadline')}}" type="date" class="form-control">
                        </div>
                        @error('deadline')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary mt-4 px-4" type="submit" style="background-color: #693D6D; border: none; color: white;">Add</button>
                        </div>
                    </form>
            </div>
       </div>
    </div>
</div>
@endsection