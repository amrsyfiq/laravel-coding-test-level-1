<!-- Author : Muhammad Amir Syafiq -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Update your event here!') }}
                </div>
            </div>

            <div class="float-start">
                <h4 class="pb-3">{{ __('Update events - ') }}{{ $event->title }}</h4>
            </div>
            <div class="float-end">
                <a href="{{ route('event.index') }}" class="btn btn-info float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> All event</a> 
            </div>
            <div class="clearfix"></div>

            <div class="card card-body bg-light p-4">
                <form action="{{ route('event.update', $event->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control mb-2" id="name" name="name" value="{{ $event->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="startAt" class="form-label">Start At</label>
                            <input type="datetime-local" class="form-control" id="startAt" name="startAt" rows="5" value="{{ $event->startAt }}"></input>
                            @error('startAt')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="endAt" class="form-label">End At</label>
                            <input type="datetime-local" class="form-control" id="endAt" name="endAt" rows="5" value="{{ $event->endAt }}"></input>
                            @error('endAt')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
                    <a href="{{ route('event.index') }}" class="btn btn-default"> Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
