@extends('layout')
@section('content')
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
	display: block;
	background-color: white;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: white;
/*  float: left;
*/  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #F00;
  color: white;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #D00;
  color: white;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 40px 0px 0px 100px;
}
</style>
<div class="fetch_checkout">
@include('pages.fetch.checkout')
</div>

@endsection