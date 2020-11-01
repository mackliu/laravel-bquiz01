@extends('home')

@section("center")
@if(!empty(session('error')))
    <div class="alert alert-danger w-50 m-auto">{{ session('error') }}</div>
@endif
<form action="/login" method="post">
    @csrf
    <p class='text-center my-3'>帳號：<input class="border-bottom py-2" type="text" name="acc" ></p>
    <p class='text-center my-3'>密碼：<input class="border-bottom py-2" type="password" name="pw" ></p>
    <p class="text-center my-3">
        <input type="submit" value="登入" class="btn btn-primary">
        <input type="reset" value="重置" class="btn btn-warning">
        </p>
</form>
@endsection