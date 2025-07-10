@extends('layouts.app')

@section('content')
<div class="d-flex flex-row-reverse min-vh-100">
   
    
    <main class="flex-grow-1 p-4">
        <h1>Your Main Content Here</h1>
    </main>
     
     <aside class="w-25 bg-white shadow">
        <x-sidebar />
    </aside>

</div>
@endsection