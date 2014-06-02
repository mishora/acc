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
            <table class="nomenclatures-table" align="center">
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
                            if (isset($office)) {
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
                            if (isset($office)) {
                                if (Input::old('name')) {
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
    @if(isset($offices))
    <hr class="fancy-line" width="80%" />
    <div class="nomenclatures-div-list">
        <table align="center" border="0px" class="nomenclatures-table-list">
            <tr>
                <th>ID</th>
                <th>Office</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Del</th>
            </tr>
                @foreach($offices as $office)
                <tr>
                    <td>{{ $office['id'] }}</td>
                    <td>{{ $office['name'] }}</td>
                    <td class="desc">{{ $office['desc'] }}</td>
                    <td><a href="{{URL::route('nomenclatures-offices-edit', array('id' => $office['id'] ))}}">Edit</a></td>
                    <td>
                        <a  onclick="if (!confirm('Selete?')) return false"
                            href="{{URL::route('nomenclatures-offices-delete', array('id' => $office['id'] ))}}"
                        >
                            Del
                        </a>
                    </td>
                </tr>
                @endforeach

        </table>

    </div>
    @endif
@endsection