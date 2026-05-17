@extends('layouts.app')

@section('content')
<!-- ============================================================
     MAIN APP WRAPPER
     ============================================================ -->
<div x-cloak>
    <!-- Login Screen -->
    @include('partials.login')
</div>
@endsection

<style>
[x-cloak] { display: none !important; }
</style>
