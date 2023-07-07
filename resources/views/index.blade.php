@extends('layout.app')

@section('content')
    <contact-form endpoint="{{ route('contacts.create') }}"/>
@endsection