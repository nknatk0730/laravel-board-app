@extends('layout')

@section('content')
    <div class="max-w-96">
      <h2>Contact</h2>
      <form action="{{ route('contact.send') }}" method="POST" class="flex flex-col">
        @csrf
          <input type="hidden" name="name" value="{{ $contact['name'] }}">
          <input type="hidden" name="email" value="{{ $contact['email'] }}">
          <input type="hidden" name="message" value="{{ $contact['message'] }}">

          <label for="name">Name</label>
          <p>{{ $contact['name'] }}</p>
          <label for="email">Mail address</label>
          <p>{{ $contact['email'] }}</p>
          <label for="message">Message</label>
          <p>{{ $contact['message'] }}</p>
          <button type="button" onClick="history.back()" class="mt-4 border rounded hover:bg-yellow-500">Back</button>
          <button class="mt-4 border rounded hover:bg-blue-500 " type="submit">Send</button>
      </form>
    </div>
    
@endsection