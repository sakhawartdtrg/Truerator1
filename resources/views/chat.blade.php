@extends('layouts.chatapp')

@section('content')
    <chatapp :relation_id="{!! auth()->user()->relation_id !!}"></chatapp>
@endsection

