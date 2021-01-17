<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>科技大學校園資訊系統</title>
</head>
<body>
    <div class="container">
        <div class="header">
            {{-- @isset($useTitle) --}}
            <img src="{{asset('storage/'.$title->img)}}" alt="{{$title->text}}" class='w-100'>
            {{-- @endisset --}}
        </div>
        <div class="main d-flex" style="height:568px;">
            @yield("main")
        </div>

    <div class="footer">
        <div class="text-center" style='height:100px;line-height:100px;background:yellow;'>{{$bottom}}</div>
    </div>
</div>
<div id="modal"></div>
    <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    @yield("script")
</body>
</html>