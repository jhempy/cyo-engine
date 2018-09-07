@extends('layouts.app')

@section('content')

This is a map for {{ $adventure->title }}.

<div class="mermaid">
{!! $adventure->mermaid !!}
</div>

@endsection

@section('page-js-script')
<script type="text/javascript">

    mermaid.initialize({startOnLoad:true});

</script>
@stop
