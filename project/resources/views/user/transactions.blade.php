@extends('user.includes.master')

@section('content')

    <div id="wrapper" class="go-section">
        <div class="row">
            <div class="container">
                <div class="container">
                    <!-- Form Name -->
                    <div class="col-sm-12 col-md-12 panel-right">
                        <div class="panel panel-default">

                            <div class="panel-body table-responsive">
                                <h4>Account Transactions</h4>
                                <div class="row" style="margin-bottom: 20px">
                                        <div class="col-md-4" style="padding-left: 0"><input name="min" placeholder="Select Date" class="form-control" id="min" type="text"></div>
                                        <div class="col-md-1 text-center">To</div>
                                        <div class="col-md-4" style="padding-left: 0"><input name="max" placeholder="Select Date" class="form-control" id="max" type="text"></div>
                                </div>

                                <table class="table table-striped" id="example">
                                    <thead>
                                    <tr style="background-color: #1a242f; color: #FFF">
                                        <th>Date</th>
                                        <th>Transaction ID#</th>
                                        <th>Action</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($transactions as $transaction)
                                        <tr style="cursor: pointer" onclick="transdetail({{$transaction->id}})" data-toggle="modal" data-target="#myModal">
                                            <td>{{date('Y-m-d',strtotime($transaction->trans_date))}}</td>
                                            <td>{{$transaction->transid}}</td>
                                            <td>{{$transaction->reason}}</td>
                                            <td><strong class="{{$transaction->type}}">{{$transaction->sign}}${{$transaction->amount}}</strong></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No Transactions.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade-scale" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg modal-request">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Transection Details</h4>
                </div>
                <div class="modal-body">
                    <div class="row" id="transdetail">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('footer')
    <script>
        function transdetail(id){
            $.get('{{url('/')}}/account/transdetail/'+id, function(response){
                $("#transdetail").html(response);
            });
        }

        $(document).ready(function(){

//            $.fn.dataTable.ext.search.push(
//                function (settings, data, dataIndex) {
//                    var min = $('#min').datepicker("getDate");
//                    var max = $('#max').datepicker("getDate");
//                    var startDate = new Date(data[0]);
//                    if (min == null && max == null) { return true; }
//                    if (min == null && startDate <= max) { return true;}
//                    if(max == null && startDate >= min) {return true;}
//                    if (startDate <= max && startDate >= min) { return true; }
//                    return false;
//                }
//            );




            $.fn.dataTableExt.afnFiltering.push(

                function (oSettings, aData, iDataIndex) {
                    if (($('#min').length > 0 && $('#min').val() !== '') || ($('#max').length > 0 && $('#max').val() !== '')) {
                        var today = new Date();
                        var dd = today.getDate();
                        var mm = today.getMonth();
                        var yyyy = today.getFullYear();
                        console.log(today+"-- "+dd+" --"+mm+" --"+yyyy);
                        if (dd < 10) dd = '0' + dd;

                        if (mm < 10) mm = '0' + mm;

                        today = yyyy + '-' + mm + '-' + dd;
                        var minVal = $('#min').val();
                        var maxVal = $('#max').val();
                        //alert(minVal+"   ----   "+maxVal);
                        if (minVal !== '' || maxVal !== '') {
                            var iMin_temp = minVal;
                            if (iMin_temp === '') {
                                iMin_temp = '1980/01/01';
                            }

                            var iMax_temp = maxVal;
                            var arr_min = iMin_temp.split("-");

                            var arr_date = aData[0].split("-");
//console.log(arr_min[2]+"-- "+arr_min[0]+" --"+arr_min[1]);
                            var iMin = new Date(arr_min[2], arr_min[0]-1, arr_min[1]);
                            //  console.log(iMin);
                            // console.log(" --"+yyy);


                            var iMax = '';
                            if (iMax_temp != '') {
                                var arr_max = iMax_temp.split("-");
                                iMax = new Date(arr_max[2], arr_max[0]-1, arr_max[1], 0, 0, 0, 0);
                            }



                            var iDate = new Date(arr_date[2], arr_date[0]-1, arr_date[1], 0, 0, 0, 0);
                            //alert(iMin+" -- "+iMax);
                            //  console.log("Test data "+iMin+" -- "+iMax+"-- "+iDate+" --"+(iMin <= iDate && iDate <= iMax));
                            if (iMin === "" && iMax === "") {
                                return true;
                            } else if (iMin === "" && iDate < iMax) {
                                // alert("inside max values"+iDate);
                                return true;
                            } else if (iMax === "" && iDate >= iMin) {
                                // alert("inside max value is null"+iDate);                    
                                return true;
                            } else if (iMin <= iDate && iDate <= iMax) {
                                //  alert("inside both values"+iDate);
                                return true;
                            }
                            return false;
                        }
                    }
                    return true;
                });
            
            
            

            $("#min").datepicker({
                dateFormat:"yy-mm-dd",
                onSelect: function (date) {
                    var selectedDate = new Date(date);
                    var msecsInADay = 86400000;
                    var endDate = new Date(selectedDate.getTime() + msecsInADay);

                    $("#max").datepicker( "option", "minDate", endDate );
                    table.draw();
                    },
                changeMonth: true,
                changeYear: true
            });
            $("#max").datepicker({
                dateFormat:"yy-mm-dd",
                onSelect: function () {
                    //var date1 = $('#max').datepicker('getDate');
//                    var date2 = $('#max').datepicker('getDate');
//                    date2.setDate(date2.getDate()+1);
//                    $('#max').datepicker('setDate', date2);
                    //$('#max').val(date1.getFullYear()+'-0'+date1.getMonth()+'-'+date1.getDate());

                    table.draw();
                    },
                changeMonth: true,
                changeYear: true
            });

            var table = $('#example').DataTable({
                "bSort": false
            });

            // Event listener to the two range filtering inputs to redraw on input
            $('#min, #max').change(function () {
                table.draw();
            });
        });



    </script>
@stop