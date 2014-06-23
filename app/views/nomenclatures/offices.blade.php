@extends('layouts.main')

@section('content')

    <h1 class="noms">Nomenclatures - Offices</h1>

    <form class="nomenclatures-form"
        action="{{ (isset($office)) ? URL::route('nomenclatures-offices-edit-post', array('id' => $office['id'] )) : URL::route('nomenclatures-offices-post')}}"
        method="POST"
    >
        <fieldset class="nomenclatures-fieldset">
        <legend>
            @if(isset($office))
                Edit Office
            @else
                Add New Office
            @endif
        </legend>
            <table class="nomenclatures-table">
                @if(isset($office))
                <tr>
                    <td class="back">
                        <a href="{{URL::route('nomenclatures-offices')}}">Back</a>
                     </td>
                </tr>
                @endif
                <tr>
                    <td>
                        <input  type="text"
                            name="name"
                            placeholder="Name of the office"
                            maxlength="20"
                            <?php
                            if (isset($office) || Input::old('name')) {
                                if (Input::old('name')) {
                                    echo 'value="'.Input::old('name').'"';
                                } else {
                                    echo 'value="'.$office['name'].'"';
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
                        <textarea rows="5" name="desc" placeholder="Description"><?php
                            if (isset($office) || Input::old('desc')) {
                                if (Input::old('desc')) {
                                    echo Input::old('desc');
                                } else {
                                    echo $office['desc'];
                                }
                            }
                        ?></textarea>
                        <br>
                        @if($errors->has('desc'))
                            <span class="errors">{{ $errors->first('desc') }}</span>
                            <br>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="td-align-right">
                        @if(isset($office))
                            <input type="hidden" name="id" value="{{ $office['id'] }}">
                        @endif
                        {{ Form::token() }}
                        <input type="submit" value="{{ (isset($office)) ? 'Update' : 'Save' }}">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
    @if(isset($offices) && $offices)
    <hr class="fancy-line" width="80%" />
    <div class="nomenclatures-div-list">
        <table border="0px" class="nomenclatures-table-list">
            <tr>
                <th>ID</th>
                <th>Office</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Del</th>
            </tr>
                @foreach($offices as $office)
                <tr>
                    <td class="text-center">{{ $office['id'] }}</td>
                    <td class="text-left">{{ $office['name'] }}</td>
                    <td class="desc text-left">{{ $office['desc'] }}</td>
                    <td class="text-center">
                        <a href="{{URL::route('nomenclatures-offices-edit', array('id' => $office['id'] ))}}">
                            <img src="{{ URL::asset('x.gif') }}" class="img_edit">
                        </a>
                    </td>
                    <td class="text-center">
                        <a  onclick="alertify.confirm('Are you sure you want to delete this office?', function (e) {
                                        if (e) {
                                        location.href = '<?php
                                                echo URL::route('nomenclatures-offices-delete', array('id' => $office['id'] ))
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
                @endforeach
        </table>
    </div>
    @endif
@endsection