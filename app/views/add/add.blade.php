@extends('layouts.main')
<?php
$offc_list = NomenclaturesController::getOfficesList();
$cat_list = NomenclaturesController::getCatsList();
?>
@section('content')
    <h1 class="noms">Add New Item</h1>
    <form class="nomenclatures-form"
        action=""
        method="POST"
    >
        <fieldset class="nomenclatures-fieldset">
            <legend>
                @if(1 > 1)
                    Edit Item
                @else
                    Add New Item
                @endif
            </legend>
            <table class="nomenclatures-table">
                <tr>
                    <td>
                        <select name="office" onchange="if(this.value >= 0) {this.style.color = '#333';} else {this.style.color = '#aaa';}">
                            <option value="-1">-- Select Office --</option>
                            @foreach($offc_list as $offc)
                                <option value="{{ $offc['id'] }}">{{ $offc['name'] }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="cat" onchange="if(this.value >= 0) {this.style.color = '#333';} else {this.style.color = '#aaa';}">
                            <option value="-1">-- Select Category --</option>
                            @foreach($cat_list as $cat)
                                <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="name" placeholder="Name">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
@stop
