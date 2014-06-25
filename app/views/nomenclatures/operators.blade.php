@extends('layouts.main')

@section('content')

    <h1 class="noms">Nomenclatures - Operators</h1>
    <form class="nomenclatures-form"
        action="{{ (isset($operator)) ? URL::route('nomenclatures-operators-edit-post', array('id' => $operator['id'] )) : URL::route('nomenclatures-operators-post')}}"
        method="POST" autocomplete="off"
    >
        <fieldset class="nomenclatures-fieldset">
            <legend>
                @if(isset($operator))
                    Edit Operator
                @else
                    Add New Operator
                @endif
            </legend>
            <table class="nomenclatures-table" align="center">
                @if(isset($operator))
                <tr>
                    <td class="back">
                        <a href="{{URL::route('nomenclatures-operators')}}">Back</a>
                     </td>
                </tr>
                @endif
                <tr>
                    <td>
                        @if(!isset($operator))
                            <input type="text" name="username" placeholder="Username" autocomplete="off"
                                <?php
                                if (Input::old('username')) {
                                    echo 'value="'.Input::old('username').'"';
                                }
                                ?>
                            >
                            <br>
                            @if($errors->has('username'))
                                <span class="errors">{{ $errors->first('username') }}</span>
                                <br>
                            @endif
                        @else
                            {{ $operator['name'] }} {{ $operator['last_name'] }}
                        @endif
                    </td>
                </tr>
                @if(!isset($operator))
                    <tr>
                        <td>
                            <input type="password" name="password" placeholder="Password" autocomplete="off" style="display: none">
                            <input type="password" name="password" placeholder="Password" autocomplete="off">
                            <br>
                            @if($errors->has('password'))
                                <span class="errors">{{ $errors->first('password') }}</span>
                                <br>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" name="password_again" placeholder="Password Again" autocomplete="off">
                            <br>
                            @if($errors->has('password_again'))
                                <span class="errors">{{ $errors->first('password_again') }}</span>
                                <br>
                            @endif
                        </td>
                    </tr>
                @endif
                <tr>
                    <td>
                        <select name="access" class="nomenclatures-select" onchange="if(this.value > 0) {this.style.color = '#333';} else {this.style.color = '#aaa';}" >
                            <option class="option-first" value="-1">-- Select Access Permissions --</option>
                            <option value="1">Administrator</option>
                            <option value="2">Manager</option>
                            <option value="3">Operator</option>
                        </select>
                        <br>
                        @if($errors->has('access'))
                            <span class="errors">{{ $errors->first('access') }}</span>
                            <br>
                        @endif
                        @if(isset($operator) && !Input::old('access'))
                            <script type="text/javascript">
                                set_selected_option('access', '<?php echo $operator['access']; ?>');
                            </script>
                        @endif
                        @if(Input::old('access'))
                            <script type="text/javascript">
                                set_selected_option('access', '<?php echo Input::old('access'); ?>');
                            </script>
                        @endif
                    </td>
                </tr>
                @if(!isset($operator))
                    <tr>
                        <td>
                            <input  type="text"
                                name="name"
                                placeholder="Name"
                                maxlength="20"
                                <?php
                                if (isset($operator) || Input::old('name')) {
                                    if (Input::old('name')) {
                                        echo 'value="'.Input::old('name').'"';
                                    } else {
                                        echo 'value="'.$operator['name'].'"';
                                    }
                                }
                                ?>
                            >
                            <br>
                            @if($errors->has('name'))
                                <span class="errors">{{ $errors->first('name') }}</span>
                                <br>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input  type="text"
                                name="last_name"
                                placeholder="Last Name"
                                maxlength="20"
                                <?php
                                if (isset($operator) || Input::old('last_name')) {
                                    if (Input::old('last_name')) {
                                        echo 'value="'.Input::old('last_name').'"';
                                    } else {
                                        echo 'value="'.$operator['last_name'].'"';
                                    }
                                }
                                ?>
                            >
                            <br>
                            @if($errors->has('last_name'))
                                <span class="errors">{{ $errors->first('name') }}</span>
                                <br>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="email" name="email" placeholder="E-mail"
                                <?php
                                if (isset($operator) || Input::old('email')) {
                                    if (Input::old('email')) {
                                        echo 'value="'.Input::old('email').'"';
                                    } else {
                                        echo 'value="'.$operator['email'].'"';
                                    }
                                }
                                ?>
                            >
                            <br>
                            @if($errors->has('email'))
                                <span class="errors">{{ $errors->first('email') }}</span>
                                <br>
                            @endif
                        </td>
                    </tr>
                @else
                    <tr>
                        <td>
                            <select name="ban" style="color: #333">
                                <option value="0"{{ ($operator['ban'] == 0) ? ' selected="selected"' : '' }}>Active</option>
                                <option value="1"{{ ($operator['ban'] == 1) ? ' selected="selected"' : '' }}>Blocked</option>
                            </select>
                        </td>
                    </tr>
                @endif
                <tr>
                    <td class="td-align-right">
                        @if(isset($operator))
                            <input type="hidden" name="id" value="{{ $operator['id'] }}">
                        @endif
                        {{ Form::token() }}
                        <input type="submit" value="{{ (isset($operator)) ? 'Update' : 'Save' }}">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
    @if(isset($operators) && count($operators) > 1)
    <hr class="fancy-line" width="80%" />
    <div class="nomenclatures-div-list">
        <table border="0px" class="nomenclatures-table-list">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Access</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Del</th>
            </tr>
            @foreach($operators as $operator)
                @if($operator['id'] != Auth::id())
                <tr>
                    <td class="text-center">{{ $operator['id'] }}</td>
                    <td class="text-left">{{ $operator['name'] }} {{ $operator['last_name'] }}</td>
                    <td class="text-left">{{ Config::get('maps.access.'.$operator['access']) }}</td>
                    <td class="text-left">{{ Config::get('maps.ban.'.$operator['ban']) }}</td>
                    <td class="text-center">
                        <a href="{{URL::route('nomenclatures-operators-edit', array('id' => $operator['id'] ))}}">
                            <img src="{{ URL::asset('x.gif') }}" class="img_edit">
                        </a>
                    </td>
                    <td class="text-center">
                        <a  onclick="alertify.confirm('Are you sure you want to delete this office?', function (e) {
                                        if (e) {
                                            location.href = '<?php
                                                    echo URL::route('nomenclatures-operators-delete', array('id' => $operator['id'] ));
                                                ?>';
                                            } else {
                                                return false;
                                            }
                                        })"
                            href="#"
                        >
                            <img src="{{ URL::asset('x.gif') }}" class="img_delete">
                        </a>
                    </td>
                </tr>
                @endif
            @endforeach
        </table>
    </div>
    @endif
@endsection