@extends('layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('dashboard', 'active')
@section('content')
    <div class="dashboard_mainsec">
        <!-- statistical information -->
        <h3 class="heading_title">Statistical Information</h3>
        <div class="stats_box row">
            <h1>User After login</h1>
        </div>
    </div>
@endsection
