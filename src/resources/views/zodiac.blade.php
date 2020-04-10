@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($zodiac != null)
                            @foreach ($zodiac as $z)
                                <div style="color: red;font-size: large"> {{ $z->zodiac }}
                                    <p style="color: black">總體評價 : {{ $z->total_comment }}</p>
                                    <p style="color: black">總體評分 : {{ $z->total_score }}</p>
                                    <p style="color: black">戀愛評價 : {{ $z->love_comment }}</p>
                                    <p style="color: black">戀愛評分 : {{ $z->love_score }}</p>
                                    <p style="color: black">事業評價 : {{ $z->business_comment }}</p>
                                    <p style="color: black">事業評分 : {{ $z->business_score }}</p>
                                    <p style="color: black">財運評價 : {{ $z->fortune_comment }}</p>
                                    <p style="color: black">財運評分 : {{ $z->fortune_score }}</p>
                                </div>
                            @endforeach
                        @else
                            今日尚未有任何記錄！
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
