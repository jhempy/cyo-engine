@extends('layouts.app')

@section('content')

<div class="text-center">
    <p>Page map for <em><a href="/adventures/{{ $adventure->id }}/edit">{{ $adventure->title }}</a></em>.</p>
</div>

<div class="mermaid text-center">
{!! $adventure->mermaid !!}
</div>

@endsection

@section('page-js-script')
<script type="text/javascript">

    mermaid.initialize({startOnLoad:true});

</script>
@stop
