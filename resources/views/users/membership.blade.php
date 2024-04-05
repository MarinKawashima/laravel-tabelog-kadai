@extends('layouts.app')

@section('content')
    <span style="margin-left: 100px;">
        <a href="{{ route('mypage') }}">マイページ</a> > 有料会員ページ
    </span>

    @auth
        @if(Auth::user()->membership)
            <h1 class="text-center">有料会員 退会</h1>
            <div class="d-flex justify-content-center">
                <form action="{{ route('membership.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="membership" value="0">
                    <button type="submit" class="btn nagoyameshi-delete-submit-button">退会する</button>
                </form>
            </div>
        @else
            <h1 class="text-center">有料会員 登録</h1>

            <div class="row justify-content-center">
                <div class="col-md-3"> 
                    <div class="card mb-4">
                        <div class="card-header text-center">
                            有料プランの内容
                        </div>                  
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">・当日の2時間前までならいつでも予約可能</li>
                            <li class="list-group-item">・店舗をお好きなだけお気に入りに追加可能</li>
                            <li class="list-group-item">・レビューを全件閲覧可能</li>
                            <li class="list-group-item">・レビューを投稿可能</li>
                            <li class="list-group-item">・月額たったの300円</li>
                        </ul>
                    </div>
                    <hr class="mb-4">
                </div>
            </div>
            
            {{-- サブスクリプションを設定する箇所 --}}
            <form id="setup-form" action="{{ route('membership.subscribe') }}" method="post">
                @csrf
                <input id="card-holder-name" type="text" placeholder="カード名義人">

                <!-- ストライプ要素のプレースホルダ -->
                <div id="card-element"></div>

                <button type="button" id="card-button" data-secret="{{ $intent->client_secret }}">
                    有料会員登録
                </button>
            </form>



            {{-- <div class="p-6 bg-white border-b border-gray-200">
                <h3>サブスクリプション</h3>
                <form id="setup-form">
                    <input id="card-holder-name" type="text" placeholder="カード名義人">
                    <div id="card-element"></div>
                    <button id="card-button">
                        サブスクリプション
                    </button>
                </form>
            </div> --}}

            {{-- 有料会員登録ボタン
            <div class="d-flex justify-content-center">
                <form action="{{ route('membership.subscribe') }}" method="POST">
                    @csrf
                    <input type="hidden" name="membership" value="1">
                    <button type="submit"class="btn nagoyameshi-submit-button ">登録</button>
                </form>
            </div> --}}



            @push('scripts')
                <script src="https://js.stripe.com/v3/"></script>
                <script>
                    const stripe = Stripe('pk_test_51OggezBrEd7MaVTh6RkLW78ZcqERBMeOCahlh5gxSRUagAlzusLbh0BLH2iEJNkAa7SpcqTkd0xCgF75NA1hyYkl00lk4eUfDY');

                    const elements = stripe.elements();
                    const cardElement = elements.create('card');
                    cardElement.mount('#card-element');

                    const cardHolderName = document.getElementById('card-holder-name');
                    const cardButton = document.getElementById('card-button');
                    // ここから追加しました。
                    const clientSecret = cardButton.dataset.secret;

                    cardButton.addEventListener('click', async (e) => {
                        e.preventDefault()
                        const { setupIntent, error } = await stripe.confirmCardSetup(
                            clientSecret, {
                                payment_method: {
                                    card: cardElement,
                                    billing_details: { name: cardHolderName.value }
                                }
                            }
                        );

                        if (error) {
                            cosole.log(error);
                        } else {
                            stripePaymentIdHandler(setupIntent.payment_method);
                        }
                    });

                    function stripePaymentIdHandler(paymentMethodId) {
                        // Insert the paymentMethodId into the form so it gets submitted to the server
                        const form = document.getElementById('setup-form');

                        const hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'paymentMethodId');
                        hiddenInput.setAttribute('value', paymentMethodId);
                        form.appendChild(hiddenInput);

                        // Submit the form
                        form.submit();
                    }


                    // cardButton.addEventListener('click', async (e) => {
                    // e.preventDefault();
                    // console.log(cardHolderName.value)
                    // });

                    // .confirmCardSetup('{SETUP_INTENT_CLIENT_SECRET}', {
                    //     payment_method: {
                    //     card: cardElement,
                    //     billing_details: { name: cardholderName, // 取得した名前を設定 },
                    //     },
                    // })
                    // .then(function(result) {
                    //     // Handle result.error or result.setupIntent
                    // });

                    // console.log(stripe)
                </script>
            @endpush
        @endif
    @endauth

@endsection