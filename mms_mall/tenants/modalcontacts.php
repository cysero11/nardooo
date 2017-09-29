<script type="text/javascript">
$(function(){
    loadcompanyposition();
});

function telno()
{
    $.mask.definitions['~']='[+-]';
    $('.input-mask-date').mask('99/99/9999');
    $('.input-mask-phone').mask('(999) 999-9999');
    $('.input-mask-tele').mask('(99)-999-9999');
    $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
    $(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
}

$.mask.definitions['~']='[+-]';
$('.input-mask-date').mask('99/99/9999');
$('.input-mask-month').mask('99/99/9999');
$('.input-mask-phone').mask('(999) 999-9999');
$('.input-mask-tele').mask('(99)-999-9999');
$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});

function loadcompanyposition()
{
    $.ajax({
        type: 'POST',
        url: 'tenants/tenantmainclass.php',
        data: 'form=loadcompanyposition',
        success: function(data)
        {
            $("#designation").html(data);
        }
    });
}
</script>

<style media="screen">
    #modalcontactperson label{
        font-weight: 700;
        color: black !important;
    }
    #modalcontactperson input,
    #modalcontactperson select{
        color: black !important;
        font-size: 14px;
    }
</style>

<div class="modal fade" role="dialog" id="modalcontactperson" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Contact Person</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <center class="col-md-4 col-md-offset-4">
                        <div class="image">
                            <img class="img-thumbnail imageName" id="imgcontact" style="height: 140px; width: 140px; border: 2px solid #bdc3c7; margin-bottom: 8px;">
                        </div>
                        <form method="post" name="posting_contactimage" id="posting_contactimage" >
                            <input id="contactimage" name="contactimage" class="form-control" type="file" onchange="showimgcontact();" accept="image/*"/>
                            <input type="hidden" class="conidpic" name="conidpic" id="conidpic" />
                            <input type="hidden" class="comidpic" name="comidpic" id="comidpic" />
                        </form>
                    </center>
                </div>
                <br>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Last Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm" id="lname" />
                            <input type="text" class="form-control input-sm" id="conid" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-4 control-label">First Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm" id="fname" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Middle Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm" id="mname" />
                        </div>
                    </div>
                </div>

                <div id="appendinfo">
                    <div class="divko">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Mobile No.</label>
                                <div class="col-md-8">
                                    <div class="input-group" id="company_contact_mobile" style="width: 100%;">
                                        <input type="text" id="spinner3" class="mobno spinbox-input form-control input-mask-phone mobilenum" maxlength="12">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Telephone No.</label>
                                <div class="col-md-8">
                                    <div class="input-group" id="company_contact_mobile" style="width: 100%;">
                                        <input type="text" id="spinner3" class="telno spinbox-input form-control input-mask-tele telnum" maxlength="11">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Email</label>
                                <div class="col-md-8">
                                    <input type="text" class="email form-control input-sm txtEmail"/>
                                    <span class="errohere" style="color: red; font-weight: 700;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button title="Add Information" class="btn btn-xs btn-primary pull-right" onclick="addinfo();"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Company Position</label>
                        <div class="col-md-8">
                            <select class="form-control input-sm" id="designation">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Address</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm" id="address" />
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary" onclick="savecontactperson();" style="border-radius: 3px;">Save</button>
                <button class="btn btn-sm btn-danger" onclick="$('#modalcontactperson').modal('hide');" style="border-radius: 3px;">Cancel</button>
            </div>
        </div>
    </div>
</div>
