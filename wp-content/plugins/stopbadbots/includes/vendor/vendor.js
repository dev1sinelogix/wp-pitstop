/*
 * @ Author: Bill Minozzi
 * @ Copyright: 2021 www.BillMinozzi.com
 * @ Modified time: 2021-29-11 09:17:42
 * */
jQuery(document).ready(function ($) {

     console.log('vendor-sbb');

     $("#stopbadbots-scan-ok").click(); 

    $("#TB_title").hide();
    if (!$("#TB_window").is(':visible')) {
        $("#stopbadbots-scan-ok").click();

        // console.log('auto click');

    }
    /*
        $("*").click(function (ev) {
            //  alert('2');
          //  console.log('click');
            console.log(ev.target.id);
          });
    */
    $("#bill-vendor-button-ok-sbb").click(function () {
        // console.log("Learn More");
        window.location.replace("https://stopbadbots.com/premium/");
    });
    $("#bill-vendor-button-again-sbb").click(function () {
        // console.log("watch again");
        $("#bill-banner").get(0).play();
    });
    $("#bill-vendor-button-dismiss-sbb").click(function (e) {
        // event.preventDefault()
        //console.log('clicked !!!!!!');
        jQuery.ajax({
            method: 'post',
            url: ajaxurl,
            data: {
                action: "stopbadbots_bill_go_pro_hide2"
            },
            success: function (data) {
                 console.log('OK-dismissed!!!');
                // return data;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('error' + errorThrown + ' ' + textStatus);
            }
        });
        //console.log("fechar");
        self.parent.tb_remove();
        // $("#TB_window").hide();
        // TB_closeWindowButton
        $('#TB_window').fadeOut();
        $("#TB_closeWindowButton").click();
    });
    if ($('#bill-banner').length) {
        $("#bill-banner").get(0).play();
    }
    if ($('#bill-banner-2').length) {
        $("#bill-banner-2").get(0).play();
    }

    $("#TB_window").height(260);
    $("#TB_window").width(550);
    $("#TB_window").addClass("bill_TB_window");
});