<style>
    .vertical-line {
        border-left: 1px solid #000; /* 縦の線のスタイルを定義 */
        height: 30px; /* 線の高さを設定 */
        margin: 0 15px; /* 線の左右のマージンを調整 */
    }
</style>

<nav class="navbar navbar-expand-md navbar-light shadow-sm nagoyameshi-header-container">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mr-5 mt-2">
                @guest
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="{{ route('register') }}">登録</a>
                    </li>
                    <li class="vertical-line"></li>
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                    </li>
                    <hr>
                @else
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="{{ route('mypage') }}">
                            <i class="fas fa-user mr-1"></i>{{ Auth::user()->name }}さん
                        </a>
                    </li>

                    <li class="vertical-line"></li>

                    @if(Auth::user()->membership)
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="{{ route('mypage.favorite') }}">
                            <i class="far fa-heart"></i>
                        </a>
                    </li>
                    <li class="vertical-line"></li>
                    @endif

                    <li class="nav-item mr-5">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            ログアウト
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
