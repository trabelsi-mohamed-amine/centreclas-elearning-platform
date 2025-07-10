<!-- Extend a base layout -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Students Enrolled in {{ $session->title }}</h1>

    @if($students->isEmpty())
        <p>No students are enrolled in this session.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    @if($student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('teachers.interface') }}" class="btn btn-secondary">Back to Sessions</a>
</div>
@endsection
