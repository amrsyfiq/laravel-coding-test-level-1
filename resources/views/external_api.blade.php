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
                <h4 class="pb-3">{{ __('Events Happened in World') }}</h4>
            </div>
            <div class="clearfix"></div>

            <div class="card">
                <div class="card-body m-3">
                    @if (isset($data['data']))
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Event</td>
                                    <td>Date</td>
                                    <td>Month</td>
                                    <td>Year</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['data'] as $key => $value)
                                <tr>
                                    <td>{{$value['_id']}}</td>
                                    <td>{{$value['event']}}</td>
                                    <td>{{$value['date']}}</td>
                                    <td>{{$value['month']}}</td>
                                    <td>{{$value['year']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger p-2">
                            {{ __('No Event Found.') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
