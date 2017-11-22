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

  <dl>

    <dt><a href="/adventures/create">Create a new adventure</a></dt>
    <dd></dd>

    <dt><a href="/adventures">List all adventures</a></dt>
    <dd></dd>

  </dl>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
