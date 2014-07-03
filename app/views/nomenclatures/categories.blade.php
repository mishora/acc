@extends('layouts.main')

@section('content')

    <h1 class="noms">Nomenclatures - Categories</h1>

    <form class="nomenclatures-form"
        action="{{ (isset($cat)) ? URL::route('nomenclatures-categories-edit-post', array('id' => $cat['id'] )) : URL::route('nomenclatures-categories-post')}}"
        method="POST"
    >
        <fieldset class="nomenclatures-fieldset">
        <legend>
            @if(isset($cat))
                Edit Category
            @else
                Add New Category
            @endif
        </legend>
            <table class="nomenclatures-table">
                @if(isset($cat))
                <tr>
                    <td class="back">
                        <a href="{{URL::route('nomenclatures-categories')}}">Back</a>
                     </td>
                </tr>
                @endif
                <tr>
                    <td>
                        <select name="type" class="nomenclatures-select">
                            <option value="-1">-- Select Type --</option>
                            <option value="{{ INCOMES }}">Incomes</option>
                            <option value="{{ EXPENSES }}">Expenses</option>
                            <option value="{{ OTHER }}">Unspecified</option>
                        </select>
                        <br>
                        @if($errors->has('type'))
                            <span class="errors">{{ $errors->first('type') }}</span>
                            <br>
                        @endif
                        @if(isset($cat) && !Input::old('type'))
                            <script type="text/javascript">
                                set_selected_option('type', '<?php echo $cat['type']; ?>');
                            </script>
                        @endif
                        @if(Input::old('type') > -1)
                            <script type="text/javascript">
                                set_selected_option('type', '<?php echo Input::old('type'); ?>');
                                console.log('<?php echo Input::old('type'); ?>');
                            </script>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="access" class="nomenclatures-select">
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
                        @if(isset($cat) && !Input::old('access'))
                            <script type="text/javascript">
                                set_selected_option('access', '<?php echo $cat['access']; ?>');
                            </script>
                        @endif
                        @if(Input::old('access'))
                            <script type="text/javascript">
                                set_selected_option('access', '<?php echo Input::old('access'); ?>');
                            </script>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <input  type="text"
                            name="name"
                            placeholder="Name of the category"
                            maxlength="20"
                            <?php
                            if (isset($cat) || Input::old('name')) {
                                if (Input::old('name')) {
                                    echo 'value="'.Input::old('name').'"';
                                } else {
                                    echo 'value="'.$cat['name'].'"';
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
                            if (isset($cat) || Input::old('desc')) {
                                if (Input::old('desc')) {
                                    echo Input::old('desc');
                                } else {
                                    echo $cat['desc'];
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
                        @if(isset($cat))
                            <input type="hidden" name="id" value="{{ $cat['id'] }}">
                        @endif
                        {{ Form::token() }}
                        <input type="submit" value="{{ (isset($cat)) ? 'Update' : 'Save' }}">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
    @if(isset($cats) && $cats)
    <hr class="fancy-line" width="80%" />
    <div class="nomenclatures-div-list">
        <table border="0px" class="nomenclatures-table-list">
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Type</th>
                <th>Description</th>
                <th>Access</th>
                <th>Edit</th>
                <th>Del</th>
            </tr>
            @foreach($cats as $cat)
                <tr>
                    <td class="text-center">{{ $cat['id'] }}</td>
                    <td class="text-left">{{ $cat['name'] }}</td>
                    <td class="text-left">{{ Config::get('maps.type.'.$cat['type']) }}</td>
                    <td class="desc text-left">{{ $cat['desc'] }}</td>
                    <td class="text-left">{{ Config::get('maps.access.'.$cat['access']) }}</td>
                    <td title="Edit" class="text-center" style="padding: 0px;">
                        <a href="{{URL::route('nomenclatures-categories-edit', array('id' => $cat['id'] ))}}">
                            <img src="{{ URL::asset('x.gif') }}" class="img_edit">
                        </a>
                    </td>
                    <td title="Delete" style="padding: 0px;" class="text-center">
                        <a onclick="alertify.confirm('Are you sure you want to delete this office?', function (e) {
                                        if (e) {
                                            location.href = '<?php
                                                    echo URL::route('nomenclatures-categories-delete', array('id' => $cat['id'] ));
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