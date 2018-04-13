@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card mt-5">
        <div class="card-header">Add a work hour</div>
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
            <form method="post" action="{{route('works.store')}}">
                @csrf
                <div class="form-group">
                    <label for="start">Date</label>
                    <input class="form-control" value="{{date('Y-m-d')}}" id="start" name="created_at" data-toggle="datepicker">
                </div>
                
                    <div class="form-group">
                        <label for="topic">Topic</label>
                        <input type="text" name="topic" id="topic" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="hour">Hour</label>
                        <input type="text" name="hour" id="hour" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-ouline-info">Add a work hour</button>
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