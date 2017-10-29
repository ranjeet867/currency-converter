@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard
                        <a href="{{ route('home') }}"><button class="btn btn-default btn-sm pull-right">Home</button></a></div>
                    <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#currency">
                        Add Currencies
                    </button>

                    <div class="panel-body">
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Conversion Rate</th>
                                        <th>Last Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="currency" tabindex="-1" role="dialog"
         aria-labelledby="currency" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Add currency rates
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">

                    <form role="form">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Currency Name</label>
                            <input type="text" class="form-control"
                                   name="name" placeholder="Enter name" required="required"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Currency code</label>
                            <input type="text" class="form-control"
                                   name="code" placeholder="Enter currency code" required="required"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Conversion Rate (Price of $1)</label>
                            <input type="number" class="form-control"
                                   name="rate" placeholder="Enter conversion rate" required="required"/>
                        </div>

                    </form>


                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary add">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>

        $(document).ready(function(){
            getCurrency();

            $('body').on('click','.add',function(){

                var data = {
                    'name': $('input[name=name]').val(),
                    'code': $('input[name=code]').val(),
                    'rate': $('input[name=rate]').val()
                };


                $.ajax({
                    url: "api/currency/create/",
                    type: "POST",
                    data:data,
                    dataType: 'json',
                    beforeSend: function(xhr){xhr.setRequestHeader('Authorization', "Bearer {{ Auth::user()->api_token }}")},
                    success: function(data) {
                        displayData(data);
                        $('#currency').modal('toggle');
                    }
                });

            });

            $('table').on('click','.delete',function(){

                var id = $(this).attr('data-id');
                var row = $(this);

                $.ajax({
                    url: "api/currency/delete/" + id,
                    type: "DELETE",
                    dataType: 'json',
                    beforeSend: function(xhr){xhr.setRequestHeader('Authorization', "Bearer {{ Auth::user()->api_token }}")},
                    success: function(data) {
                        row.parents('tr').remove();
                    }
                });

            });


        });

        function displayData(json) {
            $.each(json, function(i, value) {

                var row = "<tr>\
                    <th scope='row'>" + i + "</th>\
                    <td>" + value.name + "</td>\
                    <td>" + value.code + "</td>\
                    <td>" + value.rate + "</td>\
                    <td>" + value.updated_at + "</td>\
                    <td>\
                    <button type='submit' class='btn btn-default btn-sm delete' data-id='" + value.id + "'><span class='glyphicon glyphicon-trash'></span></button>\
                    </td>\
                    </tr>";

                $("#data").append(row);

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
