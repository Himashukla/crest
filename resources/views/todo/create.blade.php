@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-success text-white">
          <h5 class="">Create a new To-do List</h5>
        </div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <form action="{{route('todo.store')}}" method="POST" id="todo-create">
            @csrf
            <div class="row mb-3">
              <label for="title" class="col-md-2 col-form-label text-md-end">Task Title</label>

              <div class="col-md-10">
                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                  required data-parsley-required-message="Please enter task title." data-parsley-maxlength="25"
                  data-parsley-maxlength-message="Title must be of 25 letters or less.">

                @error('title')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="title" class="col-md-2 col-form-label text-md-end">Set Status</label>
            
              <div class="col-md-10">
                @foreach(\Config::get('Option.task_status') as $option)
                <input type="radio" class="@error('status') is-invalid @enderror" name="status" required
                  data-parsley-required-message="Please select title." value="{{$option}}" @if($loop->first) checked @endif> {{$option}}
                @endforeach
                @error('title')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="title" class="col-md-2 col-form-label text-md-end">Set Proirity</label>
            
              <div class="col-md-10">
                @foreach(\Config::get('Option.task_priority') as $option)
                <input type="radio" class="@error('status') is-invalid @enderror" name="priority" required
                  data-parsley-required-message="Please select title." value="{{$option}}" @if($loop->first) checked @endif> {{$option}}
                @endforeach
                @error('title')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-md-9">
                <h5>Add Task Items</h5>
              </div>
              <div class="col-md-3">
                <a class="btn btn-primary addTaskItem"><i class="fa-solid fa-plus fa-xl"></i>
                  Add New Item</a>
              </div>
            </div>
            <hr>
            @include('todo.task')
            <div class="addTaskItemDiv"></div>

            <div class="row mb-0">
              <div class="col-md-12 text-center">
                <button type="submit" name="submit" class="btn btn-primary mr-3">
                  Submit
                </button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $('#todo-create').parsley();
  var temp = 1;
  $('.addTaskItem').click(function(){
    temp = temp + 1;
    $.get('{{route("task.addblock")}}',{'temp':temp},function(data){
      $('.addTaskItemDiv').append(data.view);
    });
  });

  $(document).on('click','.btnRemove',function(){
    $('.div'+$(this).data('temp')).remove();
  });
  
</script>
@endsection