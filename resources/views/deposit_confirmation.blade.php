<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <title>Mobile Responsive Website</title>
</head>
<style type="text/css">
.justify-content-center fieldset {
    padding-top: 1%;
}
.justify-content-center.m-2 fieldset {
    padding-top: 3%;
}
div#imgTest img {
    width: 100%;
}
.mt-2, .my2 {
    margin-top: 1.5rem !important;
    margin-bottom: 1.5rem !important;
}
.text-dan {
    color: #000102 !important;
}
ul.d-inline-block.mb-0 {
    padding: 0;
    list-style-type: none;
}
.card-body {
    padding: 0.25rem !important;
}
</style>
<body>
    <div class="container">
        <x-side-bar />
        <main class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="card news">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8 col-md-8 col-sm-12">
                                        <div class="card-block">
                                            <div class="card-body">
                                                <h4>Account Details</h4>
                                                <form action="{{route('deposit.confirm.done')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf

                                                    <ul class="d-inline-block mb-0">
                                                        <li class="my2">
                                                        Bank Name: <b class="text-dan fs-6" id="txtBankName">{{$active_bank->bank_name}}</b>
                                                            <span id="btnCopyBankName" style="cursor:pointer;background-color:#ffe180;border-radius:3px" class="px-1 ms-2">copy</span>
                                                            <input type="text" name="BankName" value="{{$active_bank->bank_name}}" hidden="">
                                                        </li>
                                                        <li class="my2">
                                                            Account Name: <b class="text-dan fs-6" id="txtBankAccountname">{{$active_bank->account_name}}</b>
                                                            <span id="btnCopyBankAccountname" style="cursor:pointer;background-color:#ffe180;border-radius:3px" class="px-1 ms-2">copy</span>
                                                            <input type="text" name="BankAccountname" value="{{$active_bank->account_name}}" hidden="">
                                                        </li>
                                                        <li class="my2">
                                                            Account Number: <b class="text-dan fs-6" id="txtBankAccountNumber">{{$active_bank->bank_account_number}}</b>
                                                            <span id="btnCopyBankAccountNumber" style="cursor:pointer;background-color:#ffe180;border-radius:3px" class="px-1 ms-2">copy</span>
                                                            <input type="text" name="BankAccountNumber" value="{{$active_bank->bank_account_number}}" hidden="">
                                                        </li>
                                                        <li class="my2">
                                                        Your Deposit Amount: <b class="text-dan fs-6">{{$amount}}</b>
                                                            <input type="text" value="{{$amount}}" hidden=""> VND
                                                        </li>
                                                        <li class="my2">
                                                            Content : <b class="text-dan fs-6" >{{$content}}</b>
                                                            <input type="text" name="content" value="{{$content}}" hidden="">
                                                        </li>
                                                    </ul>
                                                    
                                                    <input type="file" name="UploadFile" accept="image/*" class="form-control d-block rounded mt-2 form-control-sm"  id="inputFileToLoad" onchange="encodeImageFileAsURL();" required>
                                                    <input type="text" name="AttachFile" hidden="">
                                                    <div id="preview" class="d-flex justify-content-center">
                                                    <input type="hidden" id="d_img" value='' name="file">
                                                    <div id="imgTest"></div>
                                                    </div>
                                                    <input type="hidden" name="amount" value="{{$amount}}">
                                                    <input type="hidden" name="active_bank_id" value="{{$active_bank->id}}">

                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            <a href="{{ route('deposit.form') }}"
                                                               class="btn btn-primary">Back</a>
                                                            <button type="submit" class="btn btn-success">Deposit
                                                            </button>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function encodeImageFileAsURL() {

    var filesSelected = document.getElementById("inputFileToLoad").files;
    if (filesSelected.length > 0) {
    var fileToLoad = filesSelected[0];

    var fileReader = new FileReader();

    fileReader.onload = function(fileLoadedEvent) {
        var srcData = fileLoadedEvent.target.result; // <--- data: base64

        var newImage = document.createElement('img');
        newImage.src = srcData;

        document.getElementById("imgTest").innerHTML = newImage.outerHTML;
        document.getElementById("d_img").value = srcData;
    }
    fileReader.readAsDataURL(fileToLoad);
    }
}
// $('#deposit_form').on('submit', function(e) {
//     e.preventDefault(); 
//     $.ajax({
//         type: "POST",
//         url: '',
//         data: $(this).serialize(),
//         success: function(msg) {
//         alert(msg);
//         }
//     });
// });

$(document).ready(function () {
    $("#btnCopyBankAccountname").click(function () {
        if (!navigator.clipboard) return
        navigator.clipboard.writeText($("input[name='BankAccountname']").val());
        $(this).text("Copied");
    });
    $("#btnCopyBankName").click(function () {
        if (!navigator.clipboard) return
        navigator.clipboard.writeText($("input[name='BankName']").val());
        $(this).text("Copied");
    });
    $("#btnCopyBankAccountNumber").click(function () {
        if (!navigator.clipboard) return
        navigator.clipboard.writeText($("input[name='BankAccountNumber']").val());
        $(this).text("Copied");
    });
    
});
</script>

</body>