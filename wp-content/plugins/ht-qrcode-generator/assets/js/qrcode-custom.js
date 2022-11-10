//QR Code Download 
jQuery(document).ready(function($) {
    'use strict';
	$(".qrcode-download").click(function (e) {
        function dataURItoBlob(dataURI) {
            for (var byteString = atob(dataURI.split(",")[1]), mimeString = dataURI.split(",")[0].split(":")[1].split(";")[0], ab = new ArrayBuffer(byteString.length), ia = new Uint8Array(ab), i = 0; i < byteString.length; i++) ia[i] = byteString.charCodeAt(i);
            var blob;
            return new Blob([ab], {
                type: mimeString
            })
        }
        var dataTarget = $(this).data('target'),
            dataUri = $(dataTarget).children("img").attr("src");
        if (navigator.msSaveBlob) {
            var blob = dataURItoBlob(dataUri);
            return navigator.msSaveBlob(blob, dataUri + "-qrcode.png")
        } else {
            $(this).attr("href", dataUri), $(this).attr("download", "QR_Code.png");
        }
    });  
});

//QR Code Print 
printDivCSS = new String ();
function printDiv(divId) {
    window.frames["qrcode_print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML;
    window.frames["qrcode_print_frame"].window.focus();
    window.frames["qrcode_print_frame"].window.print();
}

