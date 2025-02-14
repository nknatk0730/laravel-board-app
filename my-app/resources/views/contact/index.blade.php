@extends('layout')

@section('content')
    <div class="max-w-96">
      <h2>Contact</h2>
      <form action="{{ route('contact.confirm') }}" method="POST" class="flex flex-col">
        @csrf
          <label for="name">Name</label>
          <input type="text" name="name" id="name" value="{{ old('name') }}" required>
          @if ($errors->has('name'))
            <p class="text-red-500">{{ $errors->first('name') }}</p>
          @endif
          <label for="email">Mail address</label>
          <input type="text" name="email" id="email" value="{{ old('email') }}" required>
          @error('record')
            <p class="text-red-500">{{ $errors->first('email') }}</p>
          @enderror
          <label for="message">Message</label>
          <textarea type="text" name="message" id="message" required>{{ old('name') }}</textarea>
          @error('message')
            <p class="text-red-500">{{ $errors->first('message') }}</p>
          <button class="mt-4 border rounded hover:bg-blue-500 " type="submit">Confirm</button>
      </form>
    </div>
@endsection