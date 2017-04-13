<header>
    <img src="{{ asset('img/banner.jpg') }}" alt="OPG Sarac banner">
    <img class='logo' src="{{ asset('img/logo.png') }}" alt="OPG Sarac banner">
    <nav>
        <div class="toggle">
            <svg height="50px" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" width="25px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M4,10h24c1.104,0,2-0.896,2-2s-0.896-2-2-2H4C2.896,6,2,6.896,2,8S2.896,10,4,10z M28,14H4c-1.104,0-2,0.896-2,2  s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,14,28,14z M28,22H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2  S29.104,22,28,22z"></path></svg>
        </div>
        <div class="links">
            <a class="{{ Request::is('/') ? 'active' : '' }}" href="{{ route('home') }}">O nama</a>
            <a class="{{ setActive('biljke') }}" href="{{ route('plants.index') }}">Biljke</a>
            <a class="{{ setActive('proizvodi') }}" href="{{ route('products.index') }}">Proizvodi</a>
            <a class="{{ setActive('galerija') }}" href="{{ route('gallery.index') }}">Galerija</a>
            <a class="{{ setActive('kontakt') }}" href="{{ route('contact.index') }}">Kontakt</a>
            @if(Auth::check())
                @if(Auth::user()->hasRole('Admin'))
                    <a class="{{ setActive('admin') }}" href="{{ route('admin.index') }}">Admin</a>
                @endif
                <a style='background:lightblue;color:black' title='Odjava' href="{{ route('auth.logout') }}"><i class="fa fa-sign-out"></i></a>
            @else
            <a title='Prijava' class="{{ Request::is('prijava') ? 'active' : '' }}" href="{{ route('auth.login') }}"><i class="fa fa-lock"></i></a>
            @endif
        </div>
    </nav>
</header>
