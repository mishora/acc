@extends('layouts.main')

@section('content')
    <h1 class="noms">Overview And Reports</h1>
    <table class="nomenclatures-table-list overview-table">
        <tr>
            <th>ID</th>
            <th>Office</th>
            <th>Type</th>
            <th>Category</th>
            <th>Name</th>
            <th>Issue Date</th>
            <th>Pay Date</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Amount</th>
            <th>Issued</th>
            <th>Paid</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach($items as $item)
        <tr>
            <td title="{{ $item['desc'] }}" style="text-align: center;">{{ $item['id'] }}</td>
            <td title="{{ $item['desc'] }}">{{ $offices_names[$item['office']] }}</td>
            <td title="{{ $item['desc'] }}">{{ Config::get('maps.type.'.$item['type']) }}</td>
            <td title="{{ $item['desc'] }}">{{ $cats_names[$item['cat']] }}</td>
            <td title="{{ $item['desc'] }}">{{ $item['name'] }}</td>
            <td title="{{ $item['desc'] }}">{{ date('d.M.Y',$item['issue_date']) }}</td>
            <td title="{{ $item['desc'] }}">{{ date('d.M.Y',$item['pay_date']) }}</td>
            <td title="{{ $item['desc'] }}" style="text-align: right;">
                {{ number_format($item['quantity'], 2, '.', ' ') }}
            </td>
            <td title="{{ $item['desc'] }}" style="text-align: right;">
                {{ number_format($item['price'], 2, '.', ' ') }} &euro;
            </td>
            <td title="{{ $item['desc'] }}" style="text-align: right;">
                {{ number_format($item['amount'], 2, '.', ' ') }} &euro;
            </td>
            <td style="text-align: center">
                <a href="">
                    @if($item['issue_check'])
                        <img src="{{ URL::asset('x.gif') }}" class="img_status_ok">
                    @else
                        <img src="{{ URL::asset('x.gif') }}" class="img_status_not">
                    @endif
                </a>
            </td>
            <td style="text-align: center">
                <a href="">
                    @if($item['status'])
                        <img src="{{ URL::asset('x.gif') }}" class="img_status_ok">
                    @else
                        <img src="{{ URL::asset('x.gif') }}" class="img_status_not">
                    @endif
                </a>
            </td>
            <td class="text-center">
                <a href="">
                    <img src="{{ URL::asset('x.gif') }}" class="img_edit">
                </a>
            </td>
            <td class="text-center">
                <a  onclick="alertify.confirm('Are you sure you want to delete this office?', function (e) {
                                if (e) {
                                location.href = '<?php
                                        echo URL::route('nomenclatures-offices-delete', array('id' => $item['id'] ))
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
@stop

<!--
URL::route('nomenclatures-offices-edit', array('id' => $office['id'] ))
-->