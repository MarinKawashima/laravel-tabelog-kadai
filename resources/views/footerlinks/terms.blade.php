@extends('layouts.app')

@section('content')

<div class="container nagoyameshi-container pb-5">
    <div class="row justify-content-center">
        <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-10">
            <span>
                <a href="{{ url('/') }}">ホーム</a> > 会員規約
            </span>

            <h1 class="mb-4 text-center">会員規約</h1>                                             

            <div class="mb-4 terms">
                <p>この会員規約（以下、「本規約」といいます。）は、NAGOYAMESHI株式会社（以下、「当社」といいます。）がこのウェブサイト上で提供するサービス（以下、「本サービス」といいます。）の利用条件を定めるものです。登録ユーザーの皆さま（以下、「ユーザー」といいます。）には、本規約に従って、本サービスをご利用いただきます。</p>

                @foreach($terms as $term)
                    <div>
                        <h2>{{ $term->title }}</h2>
                        <p>{{ $term->content }}</p>
                    </div>
                @endforeach
            </div>                                               
        </div>                          
    </div>
</div>
@endsection