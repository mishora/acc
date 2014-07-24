@extends('layouts.main')

@section('content')

    <h1 class="noms">Nomenclatures - Partners</h1>

    <form class="nomenclatures-form"
        action="{{ (isset($partner)) ? URL::route('nomenclatures-partners-edit-post', array('id' => $partner['id'] )) : URL::route('nomenclatures-partners-post')}}"
        method="POST"
    >
        <fieldset class="nomenclatures-fieldset">
        <legend>
            @if(isset($partner))
                Edit Partner - {{ $partner['id'] }}
            @else
                Add New Partner
            @endif
        </legend>
            <table class="nomenclatures-table">
                @if(isset($partner))
                <tr>
                    <td class="back">
                        <a href="{{URL::route('nomenclatures-partners')}}">Back</a>
                     </td>
                </tr>
                @endif
                <tr>
                    <td>
                        <input  type="text"
                            name="short_name"
                            placeholder="Short Name Of The Partner (required)"
                            maxlength="32"
                            <?php
                            if (isset($partner) || Input::old('short_name')) {
                                if (Input::old('short_name')) {
                                    echo 'value="'.Input::old('short_name').'"';
                                } else {
                                    echo 'value="'.$partner['short_name'].'"';
                                }
                            }
                            ?>
                        >
                        <br>
                        @if($errors->has('short_name'))
                            <span class="errors">{{ $errors->first('short_name') }}</span>
                            <br>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <input  type="text"
                            name="full_name"
                            placeholder="Full Name"
                            <?php
                            if (isset($partner) || Input::old('full_name')) {
                                if (Input::old('full_name')) {
                                    echo 'value="'.Input::old('full_name').'"';
                                } else {
                                    echo 'value="'.$partner['full_name'].'"';
                                }
                            }
                            ?>
                        >
                        <br>
                        @if($errors->has('full_name'))
                            <span class="errors">{{ $errors->first('full_name') }}</span>
                            <br>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <input  type="text"
                            name="mol"
                            placeholder="MOL"
                            maxlength="64"
                            <?php
                            if (isset($partner) || Input::old('mol')) {
                                if (Input::old('mol')) {
                                    echo 'value="'.Input::old('mol').'"';
                                } else {
                                    echo 'value="'.$partner['mol'].'"';
                                }
                            }
                            ?>
                        >
                        <br>
                        @if($errors->has('mol'))
                            <span class="errors">{{ $errors->first('mol') }}</span>
                            <br>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="country">
                            <option value="-1">-- Select Country --</option>
                            @include('countries')
                        </select>
                        <br>
                        @if($errors->has('country'))
                            <span class="errors">{{ $errors->first('country') }}</span>
                            <br>
                        @endif
                        @if(isset($partner) && !Input::old('country'))
                            <script type="text/javascript">
                                set_selected_option('country', '<?php echo $partner['country']; ?>');
                            </script>
                        @endif
                        @if(Input::old('country'))
                            <script type="text/javascript">
                                set_selected_option('country', '<?php echo Input::old('country'); ?>');
                            </script>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <input  type="text"
                            name="eic"
                            placeholder="ID"
                            maxlength="32"
                            <?php
                            if (isset($partner) || Input::old('eic')) {
                                if (Input::old('eic')) {
                                    echo 'value="'.Input::old('eic').'"';
                                } else {
                                    echo 'value="'.$partner['eic'].'"';
                                }
                            }
                            ?>
                        >
                        <br>
                        @if($errors->has('eic'))
                            <span class="errors">{{ $errors->first('eic') }}</span>
                            <br>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <input  type="text"
                            name="vat"
                            placeholder="VAT ID"
                            maxlength="32"
                            <?php
                            if (isset($partner) || Input::old('vat')) {
                                if (Input::old('vat')) {
                                    echo 'value="'.Input::old('vat').'"';
                                } else {
                                    echo 'value="'.$partner['vat'].'"';
                                }
                            }
                            ?>
                        >
                        <br>
                        @if($errors->has('vat'))
                            <span class="errors">{{ $errors->first('vat') }}</span>
                            <br>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <input  type="text"
                            name="address"
                            placeholder="Address"
                            maxlength="255"
                            <?php
                            if (isset($partner) || Input::old('address')) {
                                if (Input::old('address')) {
                                    echo 'value="'.Input::old('address').'"';
                                } else {
                                    echo 'value="'.$partner['address'].'"';
                                }
                            }
                            ?>
                        >
                        <br>
                        @if($errors->has('address'))
                            <span class="errors">{{ $errors->first('address') }}</span>
                            <br>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <input  type="text"
                            name="mail"
                            placeholder="E-mail"
                            maxlength="60"
                            <?php
                            if (isset($partner) || Input::old('mail')) {
                                if (Input::old('mail')) {
                                    echo 'value="'.Input::old('mail').'"';
                                } else {
                                    echo 'value="'.$partner['mail'].'"';
                                }
                            }
                            ?>
                        >
                        <br>
                        @if($errors->has('mail'))
                            <span class="errors">{{ $errors->first('mail') }}</span>
                            <br>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <input  type="text"
                            name="phone"
                            placeholder="Phone"
                            maxlength="60"
                            <?php
                            if (isset($partner) || Input::old('phone')) {
                                if (Input::old('phone')) {
                                    echo 'value="'.Input::old('phone').'"';
                                } else {
                                    echo 'value="'.$partner['phone'].'"';
                                }
                            }
                            ?>
                        >
                        <br>
                        @if($errors->has('phone'))
                            <span class="errors">{{ $errors->first('phone') }}</span>
                            <br>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <input  type="text"
                            name="bank"
                            placeholder="Bank Name"
                            maxlength="64"
                            <?php
                            if (isset($partner) || Input::old('bank')) {
                                if (Input::old('bank')) {
                                    echo 'value="'.Input::old('bank').'"';
                                } else {
                                    echo 'value="'.$partner['bank'].'"';
                                }
                            }
                            ?>
                        >
                        <br>
                        @if($errors->has('bank'))
                            <span class="errors">{{ $errors->first('bank') }}</span>
                            <br>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <input  type="text"
                            name="bic"
                            placeholder="BIC Code"
                            maxlength="16"
                            <?php
                            if (isset($partner) || Input::old('bic')) {
                                if (Input::old('bic')) {
                                    echo 'value="'.Input::old('bic').'"';
                                } else {
                                    echo 'value="'.$partner['bic'].'"';
                                }
                            }
                            ?>
                        >
                        <br>
                        @if($errors->has('bic'))
                            <span class="errors">{{ $errors->first('bic') }}</span>
                            <br>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <input  type="text"
                            name="iban"
                            placeholder="IBAN"
                            maxlength="32"
                            <?php
                            if (isset($partner) || Input::old('iban')) {
                                if (Input::old('iban')) {
                                    echo 'value="'.Input::old('iban').'"';
                                } else {
                                    echo 'value="'.$partner['iban'].'"';
                                }
                            }
                            ?>
                        >
                        <br>
                        @if($errors->has('iban'))
                            <span class="errors">{{ $errors->first('iban') }}</span>
                            <br>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="td-align-right">
                        @if(isset($partner))
                            <input type="hidden" name="id" value="{{ $partner['id'] }}">
                        @endif
                        {{ Form::token() }}
                        <input type="submit" value="{{ (isset($partner)) ? 'Update' : 'Save' }}">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
    @if(isset($partners) && $partners)
    <hr class="fancy-line" width="80%" />
    <div class="nomenclatures-div-list">
        <table border="0px" class="nomenclatures-table-list">
            <tr>
                <th>ID</th>
                <th>Partner</th>
                <th>Full name</th>
                <th>Country</th>
                <th>ID</th>
                <th>VAT ID</th>
                <th>Address</th>
                <th>E-mail</th>
                <th>Phone</th>
                <th>Edit</th>
                <th>Del</th>
            </tr>
                @foreach($partners as $partner)
                <tr>
                    <td class="text-center">{{ $partner['id'] }}</td>
                    <td class="text-left">{{ $partner['short_name'] }}</td>
                    <td class="desc text-left">{{ $partner['full_name'] }}</td>
                    <td class="desc text-left">{{ Config::get('maps.countries.'.$partner['country']) }}</td>
                    <td class="desc text-left">{{ $partner['eic'] }}</td>
                    <td class="desc text-left">{{ $partner['vat'] }}</td>
                    <td class="desc text-left">{{ $partner['address'] }}</td>
                    <td class="desc text-left">{{ $partner['mail'] }}</td>
                    <td class="desc text-left">{{ $partner['phone'] }}</td>
                    <td class="text-center">
                        <a href="{{URL::route('nomenclatures-partners-edit', array('id' => $partner['id'] ))}}">
                            <img src="{{ URL::asset('x.gif') }}" class="img_edit">
                        </a>
                    </td>
                    <td class="text-center">
                        <a  onclick="alertify.confirm('Are you sure you want to delete this Partner?', function (e) {
                                        if (e) {
                                        location.href = '<?php
                                                echo URL::route('nomenclatures-partners-delete', array('id' => $partner['id'] ))
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