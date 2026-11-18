<nav class="navbar">
    <span class="navbar-merek">Portfolio</span>

    <ul class="navbar-menu">
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'aktif' : '' }}">Home</a></li>
        <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'aktif' : '' }}">About</a></li>
        <li><a href="{{ route('education') }}" class="{{ request()->routeIs('education') ? 'aktif' : '' }}">Education</a></li>
        <li><a href="{{ route('projects') }}" class="{{ request()->routeIs('projects') ? 'aktif' : '' }}">Projects</a></li>

        @auth
            <li><a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts.*') ? 'aktif' : '' }}">Posts</a></li>
            <li class="navbar-pengguna">{{ Auth::user()->name }}</li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="tombol-keluar">Logout</button>
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}">Login</a></li>
        @endauth
    </ul>
</nav>