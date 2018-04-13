@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card mt-5">
        <div class="card-header">update a work hour</div>
        <div class="card-body">
            @if($errors->all())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
            <form method="post" action="{{route('works.update', $work->id)}}">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="start">Date</label>
                    <input value="{{$work->created_at->toDateString()}}" class="form-control" id="start" name="created_at" data-toggle="datepicker">
                </div>
                
                    <div class="form-group">
                        <label for="topic">Topic</label>
                        <input value="{{$work->topic}}" type="text" name="topic" id="topic" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="hour">Hour</label>
                        <input value="{{$work->hour}}" type="text" name="hour" id="hour" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-ouline-info">update a work hour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('[data-toggle="datepicker"]').datepicker({
      format: 'yyyy-mm-dd',
    });
</script>
@endsection