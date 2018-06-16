@extends('layouts.adminpannel-app')

@section('content')
          <div class="container">
            <h2>User Details</h2>
            <div class="table-responsive" id="app">
               <userlist-component></userlist-component>
            </div>
          </div>
@endsection