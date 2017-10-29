@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Currency Converter
                    <a href="{{ route('dashboard') }}"><button class="btn btn-default btn-sm pull-right">Manage Currency</button></a></div>

                <div class="panel-body">
                    <div>
                        <table class="table">
                            <tr>
                                <td>
                                    <select name="from" class="form-control" id="from">
                                        <option disabled="disabled" selected="selected" value="">From</option>
                                    </select>
                                <td>
                                    <select name="to" class="form-control" id="to">
                                        <option disabled="disabled" selected="selected" value="">TO</option>
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control" placeholder="Enter amount" name="amount" id="amount" type="number">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">Result: <span id="result"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>

        $(document).ready(function(){
            getCurrency();

            $('#from').change(convert);
            $('#to').change(convert);
            $('#amount').keyup(convert);
        });



        function convert() {
            console.log("hjfjh");
            var to = $('#to').val();
            var from = $('#from').val();
            var amount = $('#amount').val();

            if(to != '' && from != '' && amount != '') {

                $.ajax({
                    url: "api/currency/convert/?to=" + to + "&from=" + from + "&amount=" + amount,
                    type: "GET",
                    dataType: 'json',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('Authorization', "Bearer {{ Auth::user()->api_token }}")
                    },
                    success: function (data) {
                        $('#result').text(data.amount);
                    }
                });
            }
        }

        function displayData(json) {
            $.each(json, function(i, value) {
                $('#to').append($('<option>').text(value.name).attr('value', value.code));
                $('#from').append($('<option>').text(value.name).attr('value', value.code));
            });
        }

        function getCurrency() {

            $.ajax({
                url: "api/currency/list/",
                type: "GET",
                dataType: 'json',
                beforeSend: function(xhr){xhr.setRequestHeader('Authorization', "Bearer {{ Auth::user()->api_token }}")},
                success: function(data) { displayData(data); }
            });
        }

    </script>
@endsection
