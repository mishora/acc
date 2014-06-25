<div class="nav">
    <ul class="topmenu">
        <li class="first_button{{ $page=='home' ? ' current_page' : ''}}"><a href="{{ URL::route('home') }}">Home</a></li>
        <li{{ $page=='dashboard' ? ' class="current_page"' : ''}}>
            <a href="#">Dashboard</a>
            <ul>
                <li><a href="#">Add new item</a></li>
                <li><a href="#">Overview</a></li>
            </ul>
        </li>
        <li{{ $page=='nomenclatures' ? ' class="current_page"' : ''}}>
            <a href="{{ URL::route('nomenclatures-offices') }}">Nomenclatures</a>
            <ul>
                <li><a href="{{ URL::route('nomenclatures-offices') }}">Offices</a></li>
                <li><a href="{{ URL::route('nomenclatures-categories') }}">Categories</a></li>
                <li><a href="{{ URL::route('nomenclatures-operators') }}">Operators</a></li>
            </ul>
        </li>
        <li{{ $page=='profile' ? ' class="current_page"' : ''}}>
            <a href="{{ URL::route('profile') }}">Profile</a>
        </li>
        <li><a href="{{ URL::route('account-sign-out') }}">Sign Out</a></li>
    </ul>
</div>
