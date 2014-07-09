@extends('layouts.main')

@section('content')
    <h1 class="noms">Overview And Reports</h1>
    <table class="nomenclatures-table-list overview-table">
        <tr>
            <td colspan="15">
                <form action="{{ URL::action('overview-filters') }}" method="post">
                    <label for="from">From</label>
                    <input  type="text" id="from" name="from_date"
                                {{(Session::has('from_date')) ? ' value="'.date('d-M-Y', (int)Session::get('from_date')).'"' : ''}}
                            class="input_text_autosend" placeholder="From Pay Date"
                    >
                    <label for="to">To</label>
                    <input type="text" id="to" name="to_date"
                                {{(Session::has('from_date')) ? ' value="'.date('d-M-Y', (int)Session::get('to_date')).'"' : ''}}
                            class="input_text_autosend" placeholder="To Pay Date">
                    <select id="dd" name="offices_filter" class="select_autosend" style="margin-left: 30px;">
                        <option value="-1">-- All Offices --</option>
                        @foreach($offices as $office)
                            <option value="{{ $office['id'] }}"
                                {{ ($office['id'] == Session::get('offices_filter')) ? 'selected="selected"' : ''}}
                            >
                                {{ $office['name'] }}
                            </option>
                        @endforeach
                    </select>
                    <select name="type_filter" class="select_autosend">
                        <option value="-1">-- All Types --</option>
                        @foreach(Config::get('maps.type') as $key => $type)
                            <option value="{{ $key }}"
                                {{ (Session::has('type_filter') && $key == Session::get('type_filter')) ? 'selected="selected"' : ''}}
                            >
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                    <select name="cats_filter" class="select_autosend">
                        <option value="-1">-- All Categories --</option>
                        @foreach($cats as $cat)
                            <option value="{{ $cat['id'] }}"
                                {{ ($cat['id'] == Session::get('cats_filter')) ? 'selected="selected"' : ''}}
                            >
                                {{ $cat['name'] }}
                            </option>
                        @endforeach
                    </select>
                    {{ Form::token() }}
                </form>
            </td>
        </tr>
        <tr class="empty_row">
            <td class="empty_row_td" colspan="15"></td>
        </tr>
        <tr>
            <?php
                $o = '';
                if (Session::has('order_by')) {
                    $o = Session::get('order_by');
                }
                $italic = 'style="font-style: italic; text-decoration: underline; color: #ccc;"';
            ?>
            <th title="Click to order by ID">
                <a href="{{ URL::to('order', array('by' => 'id')) }}" {{ $o == 'id' ? $italic : ''}}>ID</a>
            </th>
            <th title="Click to order by Office">
                <a href="{{ URL::to('order', array('by' => 'office')) }}" {{ $o == 'office' ? $italic : ''}}>Office</a>
            </th>
            <th title="Click to order by Type">
                <a href="{{ URL::to('order', array('by' => 'type')) }}" {{ $o == 'type' ? $italic : ''}}>Type</a>
            </th>
            <th title="Click to order by Category">
                <a href="{{ URL::to('order', array('by' => 'cat')) }}" {{ $o == 'cat' ? $italic : ''}}>Category</a>
            </th>
            <th title="Click to order by Name">
                <a href="{{ URL::to('order', array('by' => 'name')) }}" {{ $o == 'name' ? $italic : ''}}>Name</a>
            </th>
            <th title="Click to order by Quantity">
                <a href="{{ URL::to('order', array('by' => 'quantity')) }}" {{ $o == 'quantity' ? $italic : ''}}>Quantity</a>
            </th>
            <th title="Click to order by Price">
                <a href="{{ URL::to('order', array('by' => 'price')) }}" {{ $o == 'price' ? $italic : ''}}>Price <small>(&euro;)</small></a>
            </th>
            <th title="Click to order by Amount">
                <a href="{{ URL::to('order', array('by' => 'amount')) }}" {{ $o == 'amount' ? $italic : ''}}>Amount <small>(&euro;)</small></a>
            </th>
            <th title="Click to order by Issue Date">
                <a href="{{ URL::to('order', array('by' => 'issue_date')) }}" {{ $o == 'issue_date' ? $italic : ''}}>Issue Date</a>
            </th>
            <th title="Click to order by Due Date">
                <a href="{{ URL::to('order', array('by' => 'pay_date')) }}" {{ $o == 'pay_date' ? $italic : ''}}>Due Date</a>
            </th>
            <th title="Click to order by Reason">
                <a href="{{ URL::to('order', array('by' => 'reason')) }}" {{ $o == 'reason' ? $italic : ''}}>Reason</a>
            </th>
            <th title="Click to order by Issued Checked">
                <a href="{{ URL::to('order', array('by' => 'issue_check')) }}" {{ $o == 'issue_check' ? $italic : ''}}>Issued</a>
            </th>
            <th title="Click to order by Paid Checked">
                <a href="{{ URL::to('order', array('by' => 'pay_check')) }}" {{ $o == 'pay_check' ? $italic : ''}}>Paid
            </th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php $num=0; ?>
        @foreach($items as $item)

        <?php

        $insertedBG = '';
        if (Session::has('insertedId')) {
            if (Session::get('insertedId') == $item['id']) {
                $insertedBG = ' style="background: linear-gradient(rgba(79, 114, 152, 0.1), #fff, rgba(79, 114, 152, 0.1));"';
            }
        }
        ?>

        <tr{{ $insertedBG }} id="{{ $item['id'] }}">
            <td title="{{ $item['desc'] }}" style="text-align: center;">{{ $item['id'] }}</td>
            <td title="{{ $item['desc'] }}">{{ $offices_names[$item['office']] }}</td>
            <td title="{{ $item['desc'] }}">{{ Config::get('maps.type.'.$item['type']) }}</td>
            <td title="{{ $item['desc'] }}">{{ $cats_names[$item['cat']] }}</td>
            <td title="{{ $item['desc'] }}">{{ $item['name'] }}</td>
            <td title="Quantity: {{ number_format($item['quantity'], 3, '.', ' ') }}" style="text-align: right;">
                {{ number_format($item['quantity'], 2, '.', ' ') }}
            </td>
            <td{{ ($item['inexact']) ? ' title="Prognosis: '.number_format($item['price'], 2, '.', ' ').' &euro;"
                style="color: #660000;font-weight: bold;text-align: right;"' :
                ' title="'.number_format($item['price'], 2, '.', ' ').' &euro;" style="text-align: right;"'}}
            >
                {{ number_format($item['price'], 2, '.', ' ') }}
            </td>
            <td title="Amount: {{ number_format($item['amount'], 5, '.', ' ') }} &euro;" style="text-align: right;">
                {{ number_format($item['amount'], 2, '.', ' ') }}
            </td>
            <td title="{{ $item['desc'] }}">
                {{ date('d.M.Y',$item['issue_date']) }}
            </td>
            <td title="{{ $item['desc'] }}">
                {{ date('d.M.Y',$item['pay_date']) }}
            </td>
            <td title="{{ $item['reason'] }}">{{ $item['reason'] }}</td>
            <td style="text-align: center">
                <?php $num++; ?>
                <form id="form_{{ $num }}" action="{{ URL::action('mark') }}" method="post">
                    <a href="" class="form_send" id="a_{{ $num }}">
                        <input type="hidden" name="id" value="{{ $item['id'] }}">
                        <input type="hidden" name="type" value="issue_check">
                        @if($item['issue_check'])
                            <img src="{{ URL::asset('x.gif') }}" class="img_status_ok">
                        @else
                            <img src="{{ URL::asset('x.gif') }}" class="img_status_not">
                        @endif

                    </a>
                    {{ Form::token() }}
                </form>
            </td>
            <td style="text-align: center">
                <?php $num++; ?>
                <form id="form_{{ $num }}" action="{{ URL::action('mark') }}" method="post">
                    <a href="" class="form_send" id="a_{{ $num }}">
                        <input type="hidden" name="id" value="{{ $item['id'] }}">
                        <input type="hidden" name="type" value="pay_check">
                        @if($item['pay_check'])
                            <img src="{{ URL::asset('x.gif') }}" class="img_status_ok">
                        @else
                            <img src="{{ URL::asset('x.gif') }}" class="img_status_not">
                        @endif
                        {{ Form::token() }}
                    </a>
                    {{ Form::token() }}
                </form>
            </td>
            <td class="text-center">
                <a href="{{URL::route('items-edit', array('id' => $item['id'] ))}}">
                    <img src="{{ URL::asset('x.gif') }}" class="img_edit">
                </a>
            </td>
            <td class="text-center">
                <a  onclick="alertify.confirm('Are you sure you want to delete this office?', function (e) {
                                if (e) {
                                location.href = '<?php
                                        echo URL::route('items-delete', array('id' => $item['id'] ))
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
        <tr class="empty_row">
            <td class="empty_row_td" colspan="15"></td>
        </tr>
        <tr id="result">
            <td colspan="15" style="text-align: right;padding: 0px">
                <table class="result" border="0px" cellspacing="0px" cellpadding="15px">
                    <tr class="incomes">
                        <td style="color: #003300;width: 100px;border-right:1px solid #ccc;">Incomes: </td>
                        <td style="color: #003300;font-weight:bold;">{{ number_format($incomes, 2, '.', ' ') }}</td>
                        <td style="color: #003300;font-weight:bold;">&euro;</td>
                    </tr>
                    <tr class="expenses">
                        <td style="color: #330000;border-right:1px solid #ccc;">Expenses: </td>
                        <td style="color: #660000;font-weight:bold;">{{ number_format($expenses, 2, '.', ' ') }}</td>
                        <td style="color: #660000;font-weight:bold;">&euro;</td>
                    </tr>
                    <tr class="balance">
                        <td style="border-right:1px solid #ccc;">Balance: </td>
                        <td style="font-weight:bold;">{{ number_format(($incomes - $expenses), 2, '.', ' ') }}</td>
                        <td style="font-weight:bold;">&euro;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@stop
