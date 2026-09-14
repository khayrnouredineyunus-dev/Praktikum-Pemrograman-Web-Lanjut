<nav class="navbar">
    <span class="navbar-merek">Portfolio</span>

    <ul class="navbar-menu">
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'aktif' : '' }}">Home</a></li>
        <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'aktif' : '' }}">About</a></li>
        <li><a href="{{ route('education') }}" class="{{ request()->routeIs('education') ? 'aktif' : '' }}">Education</a></li>
        <li><a href="{{ route('projects') }}" class="{{ request()->routeIs('projects') ? 'aktif' : '' }}">Projects</a></li>
    </ul>
</nav>
