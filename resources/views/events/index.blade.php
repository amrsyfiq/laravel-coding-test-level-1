<!-- Author : Muhammad Amir Syafiq -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

            <div class="float-start">
                <h4 class="pb-3">{{ __('My Events') }}</h4>
            </div>
            <div class="float-end">
                <a href="{{ route('event.create') }}" class="btn btn-info float-right"><i class="fa fa-plus" aria-hidden="true"></i> Create Event</a> 
            </div>
            <div class="float-end" style="margin-right: 1em;">
                <form action="{{ route('search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search name"/>
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-warning">Search & Clear</button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>

            @if (count($events) != 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <td>ID</td>
                        <td>Event Name</td>
                        <td>Slug</td>
                        <td>Start At</td>
                        <td>End At</td>
                        <td>Created At</td>
                        <td>Updated At</td>
                        <td colspan="2">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr>
                            <td>{{$event->id}}</td>
                            <td>{{$event->name}}</td>
                            <td>{{$event->slug}}</td>
                            <td>{{$event->startAt}}</td>
                            <td>{{$event->endAt}}</td>
                            <td>{{$event->created_at}}</td>
                            <td>{{$event->updated_at}}</td>
                            <td>
                                <a href="{{ route('event.edit', $event->id) }}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            </td>
                            <td>
                                <form action="{{ route('event.destroy', $event->id) }}" style="display: inline" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" style="color: #000;"aria-hidden="true"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $events->onEachSide(5)->links() }}
            @else
                <div class="alert alert-danger p-2">
                    {{ __('No Event Found. Please create a event') }}
                    <a href="{{ route('event.create') }}"> here</a> !
                </div>
            @endif

                {{-- <div class="card mb-3">
                    <h5 class="card-header">
                        {{ __($event->name) }}
                        <span class="badge rounded-pill bg-light text-dark">Created - {{ __( $event->created_at->diffForHumans() ) }}</span>
                    </h5>

                    <div class="card-body">
                        <div class="card-text">
                            <div class="float-start">
                                    {{ __($event->slug) }}
                                <br>
                                    <span class="badge rounded-pill bg-success text-white">New</span>

                                <small>Last Updated - {{ __( $event->updated_at->diffForHumans() ) }}</small>
                            </div>
                            <div class="float-end">
                                <a href="{{ route('task.index', $event->id) }}" class="btn btn-info"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
                                <a href="{{ route('event.edit', $event->id) }}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <form action="{{ route('event.destroy', $event->id) }}" style="display: inline" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" style="color: #000;"aria-hidden="true"></i></button>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div> --}}

            {{-- @if (count($events) === 0)
                <div class="alert alert-danger p-2">
                    {{ __('No Event Found. Please create a event') }}
                    <a href="{{ route('event.create') }}"> here</a> !
                </div>
            @endif --}}
        </div>
    </div>
</div>
@endsection
