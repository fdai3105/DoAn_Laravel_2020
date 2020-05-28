@extends('layouts.master')

<div class="container-fluid">
    <div class="row">
        <!-- left panel -->
        <div class="col-sm-2 sidenav">
            @include('admin.adminnav')
        </div>

        <!-- right panel -->
        <div class="col-sm-10" style="background-color:white;margin-left: 16.5%">
            @include('admin.brand.rightpanel')
        </div>
    </div>
</div>