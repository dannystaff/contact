@extends('layout.app')

@section('content')
    <contact-list endpoint="{{ route('contacts.get') }}"/>
@endsection