@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-10">
              <h5 class="">My To-do Lists</h5>
            </div>
            <div class="col-md-2">
              <a href="{{route('todo.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus fa-xl"></i> Create</a>
            </div>
          </div>
        </div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          todo index
        </div>
      </div>
    </div>
  </div>
</div>
@endsection