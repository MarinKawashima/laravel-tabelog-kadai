@extends('layouts.app')

@section('content')
<div class="container nagoyameshi-container pb-5">
    <div class="row justify-content-center">
        <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-10">
            <span>
                <a href="{{ url('/') }}">ホーム</a> > 会社概要
            </span>

            <h1 class="mb-4 text-center">会社概要</h1>                                    

            <div class="container mb-4">
                <div class="row pb-2 mb-2 border-bottom">
                    <div class="col-3">
                        <span class="fw-bold">会社名</span>
                    </div>

                    <div class="col">
                        <span>NAGOYAMESHI株式会社</span>
                    </div>
                </div>                    

                <div class="row pb-2 mb-2 border-bottom">
                    <div class="col-3">
                        <span class="fw-bold">所在地</span>
                    </div>

                    <div class="col">
                        <span>〒101-0022 東京都千代田区神田練塀町300番地 住友不動産秋葉原駅前ビル5F</span>
                    </div>
                </div>

                <div class="row pb-2 mb-2 border-bottom">
                    <div class="col-3">
                        <span class="fw-bold">代表者</span>
                    </div>

                    <div class="col">
                        <span>侍 太郎</span>
                    </div>
                </div> 
                
                <div class="row pb-2 mb-2 border-bottom">
                    <div class="col-3">
                        <span class="fw-bold">設立</span>
                    </div>

                    <div class="col">
                        <span>2015年3月19日</span>
                    </div>
                </div>   
                
                <div class="row pb-2 mb-2 border-bottom">
                    <div class="col-3">
                        <span class="fw-bold">資本金</span>
                    </div>

                    <div class="col">
                        <span>110,000千円</span>
                    </div>
                </div>

                <div class="row pb-2 mb-2 border-bottom">
                    <div class="col-3">
                        <span class="fw-bold">事業内容</span>
                    </div>

                    <div class="col">
                        <span>飲食店等の情報提供サービス</span>
                    </div>
                </div>                    
                
                <div class="row pb-2 mb-2 border-bottom">
                    <div class="col-3">
                        <span class="fw-bold">従業員数</span>
                    </div>

                    <div class="col">
                        <span>50名</span>
                    </div>
                </div>                                       
            </div>                                               
        </div>
    </div>
</div>

@endsection