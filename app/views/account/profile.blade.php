@extends('layouts.main')

@section('content')
    <h1 class="noms">Profile</h1>
    <form class="nomenclatures-form" action="{{ URL::action('profile-edit') }}" method="post">
        <fieldset class="nomenclatures-fieldset profile-fieldset">
            <legend>
                Edit profile
            </legend>
            <table class="nomenclatures-table" align="center">
                <tr>
                    <td colspan="2">
                        <p class="profile-titles">
                            User Data
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="description">Username: </td>
                    <td class="desc">
                        {{ $me['username'] }}
                    </td>
                </tr>
                <tr>
                    <td class="description">Name: </td>
                    <td>
                        <input type="text" name="name" value="{{ (Input::old('name')) ? Input::old('name') : $me['name'] }}">
                        <br>
                        @if($errors->has('name'))
                            <span class="errors">{{ $errors->first('name') }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="description">Last name: </td>
                    <td>
                        <input type="text"
                                name="last_name"
                                value="{{ (Input::old('last_name')) ? Input::old('last_name') : $me['last_name'] }}"
                        >
                        <br>
                        @if($errors->has('last_name'))
                            <span class="errors">{{ $errors->first('last_name') }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="description">Email: </td>
                    <td>
                        <input type="email" name="email" value="{{ (Input::old('email')) ? Input::old('email') : $me['email'] }}">
                        <br>
                        @if($errors->has('email'))
                            <span class="errors">{{ $errors->first('email') }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p class="profile-titles">
                            Change Password
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="description">
                        Password:
                    </td>
                    <td>
                        <input type="password" name="password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td class="description">
                        Password Again:
                    </td>
                    <td class="description">
                        <input type="password" name="password_again" placeholder="New Password Again" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p class="profile-titles">
                            Save data
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="description">
                        Password:
                    </td>
                    <td>
                        <input type="password" name="old_password" placeholder="Old Password" autocomplete="off">
                        <br>
                        @if($errors->has('old_password'))
                            <span class="errors">{{ $errors->first('old_password') }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right">
                        {{ Form::token() }}
                        <input type="submit" name="save" value="Save">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
@stop

