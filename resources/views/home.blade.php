@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p><strong><a href="/adventures/create">Create a new adventure</a></strong></p>

                    <p><strong><a href="/adventures">List my adventures</a></strong></p>

                    <p><strong><a href="/read">Read published adventures</a></strong></p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
