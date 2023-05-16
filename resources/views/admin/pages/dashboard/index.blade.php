@extends('admin.main')
@section('content')
@php
    $list_widget = [
        [
            'icon' => 'fa-caret-square-o-right',
            'count'=> '179',
            'tittle' => 'New Sign ups',
            'description' => 'Lorem ipsum psdea itgum rixt.'
        ],
        [
            'icon' => 'fa-comments-o',
            'count'=> '179',
            'tittle' => 'New Sign ups',
            'description' => 'Lorem ipsum psdea itgum rixt.'
        ],
        [
            'icon' => 'fa-sort-amount-desc',
            'count'=> '179',
            'tittle' => 'New Sign ups',
            'description' => 'Lorem ipsum psdea itgum rixt.'
        ],
        [
            'icon' => 'fa-check-square-o',
            'count'=> '179',
            'tittle' => 'New Sign ups',
            'description' => 'Lorem ipsum psdea itgum rixt.'
        ]
    ]
@endphp
<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>Dashboard</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Quản lý thống kê</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    @foreach ($list_widget as $widget)
                        @include("admin.elements.widget_dashboard",$widget)
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection