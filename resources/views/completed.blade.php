@extends('layouts.master')

@section('content_here')
 <nav class="navbar navbar-expand-lg">
    <div class="container mt-4">
    <a class="navbar-brand dashboard" href="{{route('dashboard')}}">Dashboard</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link in-progress" href="{{route('progress')}}">In Progress</a></li>
                <li class="nav-item"><a class="nav-link completed" href="{{route('completed')}}">Completed</a></li>
                <li class="nav-item"><a class="nav-link trashbin" href="{{route('trashbin')}}">Trash Bin</a></li>
            </ul>
        </div>
        </div>
    </div>
 </nav>

<div class="container mt-5">
    <div class= "d-flex justify-content-between">
        <h2 class="mb-4" style="color:#432246 ">Completed Tasks</h2>
    </div>
    <table class="table table-bordered table-hover shadow p-1">
        <thead style="background-color: #693D6D; color:white">
            <tr class='text-center'>
                <th class= "fw-light">Task No.</th>
                <th class= "fw-light">Task Name</th>
                <th class= "fw-light">Priority</th>
                <th class= "fw-light">Deadline</th>
                <th class= "fw-light">Status</th>
            </tr>
        </thead>
    
        <tbody>
        @foreach($tasks as $task)
            <tr class="text-center">
                <td>{{ $task->taskNo }}</td>
                <td>{{ $task->taskName }}</td>
                <td>{{ $task->priority }}</td>
                <td>{{ $task->deadline }}</td>
                <td>{{ $task->status }}</td>
            </tr>
        @endforeach
@endsection