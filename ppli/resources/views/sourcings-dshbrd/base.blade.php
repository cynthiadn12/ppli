@extends('layouts.app-template')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sourcing Dashboard
            </h1>
            <ol class="breadcrumb">
                <!-- li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li-->
                <li class="active">Sourcing Dashboard</li>
            </ol>
        </section>
    @yield('action-content')
    <!-- /.content -->
    </div>
@endsection