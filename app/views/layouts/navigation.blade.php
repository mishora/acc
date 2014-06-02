<div class="nav">
    <ul class="topmenu">
        <li class="first_button"><a href="{{ URL::route('home') }}">Home</a></li>
        <li><a href="#">Reports</a></li>
        <li>
            <a href="{{ URL::route('nomenclatures-offices') }}">Nomenclatures</a>
            <ul>
                <li><a href="{{ URL::route('nomenclatures-offices') }}">Offices</a></li>
                <li><a href="{{ URL::route('nomenclatures-categories') }}">Categories</a></li>
                <li><a href="{{ URL::route('nomenclatures-operators') }}">Operators</a></li>
            </ul>
        </li>
        <li><a href="{{ URL::route('account-sign-out') }}">Sign Out</a></li>
    </ul>
</div>
