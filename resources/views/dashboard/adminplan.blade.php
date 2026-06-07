@extends('tyro-dashboard::layouts.admin')

@section('title', 'Adminplan')

@section('breadcrumb')
<a href="{{ route($dashboardRoute::name('index')) }}">Dashboard</a>
<span class="breadcrumb-separator">/</span>
<span>Adminplan</span>
@endsection

@section('content')
<div class="page-header">
    <div class="page-header-row">
        <div>
            <h1 class="page-title">Adminplan</h1>
            <p class="page-description" style="font-size: 1rem;">Administrative page for Adminplan.</p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="font-size: 1.0625rem;">Adminplan Management</h3>
    </div>
    <div class="card-body">
        <p>This is a new admin dashboard page. Start building your administrative content here.</p>
    </div>
</div>
@endsection
