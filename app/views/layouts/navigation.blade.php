<div class="nav">
    <ul class="topmenu">
        <li class="first_button{{ $page=='overview' ? ' current_page' : ''}}">
            <a href="{{ URL::route('overview') }}">Overview</a>
        </li>
        <li{{ $page=='add' ? ' class="current_page"' : ''}}>
            <a href="{{ URL::route('add') }}">Add New</a>
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
