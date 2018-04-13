@extends('layouts.app')

@section('content')
<div class="container">
    <div class="my-3">
        <form action="{{route('works.index')}}">
            <label for="start">Start date</label><input value="{{$start}}" class="mx-3" id="start" name="start" data-toggle="datepicker">
            <label for="end">End Date</label><input value="{{$end}}" class="mx-3" id="end" name="end" data-toggle="datepicker">
            <button type="submit" class="btn btn-sm btn-outline-info">Filter</button>
        </form>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Session::has('message'))
                        <div class="alert alert-success">
                            <p>{{Session::get('message')}}</p>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Date</th>
                                <th>Work</th>
                                <th>hour</th>
                            </tr>
                            @foreach($works as $work)
                            <tr>
                                <td>
                                    {{$work->created_at->toDateString() }} - 
                                    ({{$work->created_at->diffForHumans()}})
                                </td>
                                <td>
                                    {{$work->topic}}
                                    <a class="badge badge-info" style="cursor: pointer;" href="{{route('works.edit', $work->id)}}">edit</a>
                                    <form onsubmit="return confirm('Are you sure you want to delete this entry?')" method="post" class="d-inline-block" action="{{route('works.destroy', $work->id)}}">
                                        @csrf
                                        @method('delete')
                                        <button style="outline: none; border: none; cursor: pointer;" class="badge badge-danger" type="sumit">Delete</button>
                                    </form>
                                </td>
                                <td>
                                    {{$work->hour}}
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <th colspan="2">total_hours</th>
                                <th>{{$total_hours}}</th>
                            </tr>
                        </table>
                    </div>
                    <div>
                        {{$works->links()}}
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Days</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="{{Request::url()}}?start={{Carbon::now()->subDays(7)->format('Y-m-d')}}&end={{Carbon::now()->format('Y-m-d')}}">Last 7 days</a></li>
                        <li class="list-group-item"><a href="{{Request::url()}}?start={{Carbon::now()->subDays(6)->format('Y-m-d')}}&end={{Carbon::now()->format('Y-m-d')}}">Last 6 days</a></li>
                        <li class="list-group-item"><a href="{{Request::url()}}?start={{Carbon::now()->subDays(5)->format('Y-m-d')}}&end={{Carbon::now()->format('Y-m-d')}}">Last 5 days</a></li>
                        <li class="list-group-item"><a href="{{Request::url()}}?start={{Carbon::now()->subDays(4)->format('Y-m-d')}}&end={{Carbon::now()->format('Y-m-d')}}">Last 4 days</a></li>
                        <li class="list-group-item"><a href="{{Request::url()}}?start={{Carbon::now()->subDays(3)->format('Y-m-d')}}&end={{Carbon::now()->format('Y-m-d')}}">Last 3 days</a></li>
                        <li class="list-group-item"><a href="{{Request::url()}}?start={{Carbon::now()->subDays(2)->format('Y-m-d')}}&end={{Carbon::now()->format('Y-m-d')}}">Last 2 days</a></li>
                        <li class="list-group-item"><a href="{{Request::url()}}?start={{Carbon::now()->subDays(1)->format('Y-m-d')}}&end={{Carbon::now()->format('Y-m-d')}}">Last 1 days</a></li>
                    </ul>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Pagination</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="{{Request::url()}}?paginate=10000">All works</a></li>
                        <li class="list-group-item"><a href="{{Request::url()}}?paginate=50">50 works</a></li>
                        <li class="list-group-item"><a href="{{Request::url()}}?paginate=100">100 works</a></li>
                        <li class="list-group-item"><a href="{{Request::url()}}?paginate=200">200 works</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection


@section('script')
<script>
    $('[data-toggle="datepicker"]').datepicker({
      format: 'yyyy-mm-dd'
    });
</script>
@endsection