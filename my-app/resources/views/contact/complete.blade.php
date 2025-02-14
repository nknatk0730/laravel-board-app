@extends('layout')

@section('content')
  <h1>お問い合わせ完了</h1>
  <p>お問い合わせありがとうございました。</p>
  <a href="{{ route('contact.index') }}">お問い合わせに戻る</a>
    
@endsection