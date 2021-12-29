@section('hamberger')
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#">
            <img src="{{ asset('adminmart/assets/images/text-logo.png') }}" alt="" width="124"
                height="40">
        </a>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__auth">
            @if (!Auth::check())
                <a href="{{ route('login') }}"><i class="fa fa-user"></i> Masuk</a>
            @else
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button"
                        id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Pesananku</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
        <a href="#"><i class="fa fa-youtube"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> customerservice@viggy.com</li>
            <li>Sekarang Anda bisa berbelanja dimana saja dan kapan saja.</li>
        </ul>
    </div>
</div>
@show
