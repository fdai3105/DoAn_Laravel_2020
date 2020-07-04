@extends('layouts.master')
<style>
    label {
        color: white !important;
    }
</style>
<div class="container-fluid bg-dark" style="height:100vh;display: flex;justify-content: center;">
    <div class="col-lg-3" style="align-self: center;">
        <h3 style="color:white !important; text-align: center;">fdBlog Admin Panel</h3>
        <form action="{{route('getLogin')}}" method="POST">
            {{csrf_field()}}
            <div>
                @include('common.errors')
            </div>
            <div class="form-group">
                <label class="col control-label">Email</label>
                <div class="col">
                    <input type="text" class="form-control" name="email">
                    <div class="invalid-tooltip">
                        Please choose a unique and valid username.
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col control-label">Password</label>
                <div class="col">
                    <input type="password" class="form-control" name="password">
                    <div class="invalid-tooltip">
                        Please choose a unique and valid username.
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row" style="margin:0px">
                    <div class="col-lg-6" style="text-align: left;">
                        <a href="/" class="btn btn-secondary">
                            <i class="fa fa-chevron-left"></i> Homepage
                        </a>
                    </div>
                    <div class="col-lg-6" style="text-align: right;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-sign-in"></i> Login
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>