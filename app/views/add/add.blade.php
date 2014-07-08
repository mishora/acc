@extends('layouts.main')
<?php
$offc_list = NomenclaturesController::getOfficesList();
$cat_list = NomenclaturesController::getCatsList();
?>
@section('content')
    @if(isset($item))
        <h1 class="noms">Edit Item</h1>
    @else
        <h1 class="noms">Add New Item</h1>
    @endif
    <form class="nomenclatures-form"
        action="{{ (isset($item)) ? URL::action('items-post', array('id' => $item['id'] )) : URL::action('items-post')}}"
        method="post"
    >
        <fieldset class="nomenclatures-fieldset">
            <legend>
                @if(isset($item))
                    Edit Item
                @else
                    Add New Item
                @endif
            </legend>
            <table class="nomenclatures-table add_items" style="width:97%">
                @if(isset($item))
                <tr>
                    <td class="back">
                        <a href="{{URL::route('overview')}}">Back</a>
                     </td>
                </tr>
                @endif
                <tr>
                    <td>
                        <select name="office" onchange="if(this.value >= 0) {this.style.color = '#333';} else {this.style.color = '#aaa';}">
                            <option value="-1">-- Select Office --</option>
                            @foreach($offc_list as $offc)
                                <option value="{{ $offc['id'] }}">{{ $offc['name'] }}</option>
                            @endforeach
                        </select>
                        <br>
                        @if($errors->has('office'))
                            <span class="errors">{{ $errors->first('office') }}</span>
                        @endif
                        @if(isset($item))
                            <script type="text/javascript">
                                set_selected_option('office', '<?php echo $item['office']; ?>');
                                console.log('<?php echo Input::old('office'); ?>');
                            </script>
                        @endif
                        @if(Input::old('office') > -1)
                            <script type="text/javascript">
                                set_selected_option('office', '<?php echo Input::old('office'); ?>');
                                console.log('<?php echo Input::old('office'); ?>');
                            </script>
                        @endif
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
                        <br>
                        @if($errors->has('cat'))
                            <span class="errors">{{ $errors->first('cat') }}</span>
                        @endif
                        @if(isset($item))
                            <script type="text/javascript">
                                set_selected_option('cat', '<?php echo $item['cat']; ?>');
                                console.log('<?php echo Input::old('office'); ?>');
                            </script>
                        @endif
                        @if(Input::old('cat') > -1)
                            <script type="text/javascript">
                                set_selected_option('cat', '<?php echo Input::old('cat'); ?>');
                                console.log('<?php echo Input::old('cat'); ?>');
                            </script>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="name"
                            placeholder="Name"
                            {{ (isset($item['name']) && !Input::old('name')) ? ' value="'.e($item['name']).'"' : ''}}
                            {{ (Input::old('name')) ? ' value="'.e(Input::old('name')).'"' : ''}}
                        >
                        <br>
                        @if($errors->has('name'))
                            <span class="errors">{{ $errors->first('name') }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">
                        <table cellpadding="0px" cellspacing="0px" >
                            <tr class="input_numbers" style="vertical-align: top;">
                                <td style="text-align: left;">
                                    <p>Quantity</p>
                                    <input type="number" name="quantity" step="any" id="qty"
                                        {{ (isset($item['quantity']) && !Input::old('quantity')) ? ' value="'.e($item['quantity']).'"' : ''}}
                                        {{ (Input::old('quantity')) ? ' value="'.e(Input::old('quantity')).'"' : ''}}
                                    >
                                    <br>
                                    @if($errors->has('quantity'))
                                        <span class="errors">{{ $errors->first('quantity') }}</span>
                                    @endif
                                </td>
                                <td style="padding-left: 10px;text-align: left;">
                                    <p>Price (&euro;)</p>
                                    <input type="number" name="price" step="any" id="price"
                                        {{ (isset($item['price']) && !Input::old('price')) ? ' value="'.e($item['price']).'"' : ''}}
                                        {{ (Input::old('price')) ? ' value="'.e(Input::old('price')).'"' : ''}}
                                    >
                                    <br>
                                    @if($errors->has('price'))
                                        <span class="errors">{{ $errors->first('price') }}</span>
                                    @endif
                                </td>
                                <td style="vertical-align: bottom;">
                                    <input id="inexact" type="checkbox" name="inexact"
                                    <?php
                                    if (isset($item) && !Input::old('inexact') ) {
                                        if ($item['inexact'] > 0) {
                                            echo 'checked="checked"';
                                        }
                                    } else if (Input::old('inexact')) {
                                        if (Input::old('inexact') > 0) {
                                        	echo 'checked="checked"';
                                        }
                                    } else {
                                    	echo 'checked="checked"';
                                    }

                                    ?>
                                    >
                                    <label for="inexact" style="font-size: 14px;">
                                        Prognosis
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="input_numbers">
                    <td style="text-align: left;">
                    <p>Amount (&euro;)</p>
                        <input style="width: 100%; text-align: center; font-weight: bold;"
                                type="number" name="amount" step="any"
                                {{ (isset($item['amount']) && !Input::old('amount')) ? ' value="'.$item['amount'].'"' : ''}}
                                {{ (Input::old('amount')) ? ' value="'.Input::old('amount').'"' : ''}}
                        >
                        <br>
                        @if($errors->has('amount'))
                            <span class="errors">{{ $errors->first('amount') }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea rows="5" name="desc" placeholder="Description" style="width: 98%;"><?php

                            if (isset($item) || Input::old('desc')) {
                                if (Input::old('desc')) {
                                    echo Input::old('desc');
                                } else {
                                    echo $item['desc'];
                                }
                            }
                        ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td id="dates" style="text-align: left;">
                        <table cellpadding="0px" cellspacing="0px">
                            <tr class="input_numbers" style="vertical-align: top;">
                                <td style="text-align: left;">
                                    <?php
                                    if (isset($item) && !Input::old('issue_date')) {
                                        echo '<script type="text/javascript">
                                                    issue_date = "'.date('d-M-Y', $item['issue_date']).'";
                                              </script>';
                                    }
                                    if (Input::old('issue_date')) {
                                        echo '<script type="text/javascript">
                                                    issue_date = "'.Input::old('issue_date').'";
                                              </script>';
                                    }
                                    ?>
                                    <p>Issue Date: </p>
                                    <input  type="text" name="issue_date"
                                            class="datepicker" value="{{ (Input::old('issue_date')) ? Input::old('issue_date') : '' }}"
                                            placeholder="Click to Select"
                                    >
                                    <br>
                                    @if($errors->has('issue_date'))
                                        <span class="errors">{{ $errors->first('issue_date') }}</span>
                                    @endif
                                </td>
                                <td style="padding-left: 10px;text-align: left;">
                                    <?php
                                    if (isset($item) && !Input::old('pay_date')) {
                                        echo '<script type="text/javascript">
                                                    pay_date = "'.date('d-M-Y', $item['pay_date']).'";
                                              </script>';
                                    }
                                    if (Input::old('pay_date')) {
                                        echo '<script type="text/javascript">
                                                    pay_date = "'.Input::old('pay_date').'";
                                              </script>';
                                    }
                                    ?>
                                    <p>Due Date: </p>
                                    <input type="text" name="pay_date"
                                            class="datepicker" value=""
                                            placeholder="Click to Select"
                                    >
                                    <br>
                                    @if($errors->has('pay_date'))
                                        <span class="errors">{{ $errors->first('pay_date') }}</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Reason: </p>
                        <input type="text" name="reason"
                            placeholder="Reason"
                            {{ (isset($item['reason']) && !Input::old('reason')) ? ' value="'.$item['reason'].'"' : ''}}
                            {{ (Input::old('reason')) ? ' value="'.Input::old('reason').'"' : ''}}
                        >
                        <br>
                        @if($errors->has('name'))
                            <span class="errors">{{ $errors->first('name') }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="td-align-right" style="padding-top: 20px;">
                        @if(isset($item))
                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                        @endif
                        {{ Form::token() }}
                        <input type="submit" value="Save" name="save">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
@stop
