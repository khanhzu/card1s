function swal(text, icon) {
    Swal.fire({
        icon,
        title: "Thông báo",
        text,
        confirmButtonText: "Đóng",
        confirmButtonColor: "#3085d6",
    });
}

$(document).ready(function () {
    $("form[submit-ajax=jtech]").submit(function (e) {
        e.preventDefault();
        let _this = this;
        let url = $(_this).attr("action");
        let method = $(_this).attr("method");
        let href = $(_this).attr("href");
        let data = $(_this).serialize();
        let button = $(_this).find("button[type=submit]");

        submitForm(url, method, href, data, button);
    });
});

function submitForm(url, method, href, data, button) {
    let textButton = button.html().trim();
    let setting = {
        type: method,
        url,
        data,
        dataType: "json",
        beforeSend: function () {
            button
                .prop("disabled", !0)
                .html('VUI LÒNG CHỜ...');
        },
        complete: function () {
            button.prop("disabled", !1).html(textButton);
        },
        success: function (response) {
            swal(
                response.message,
                response.status === true ? "success" : "error"
            );
            if (response.status === true && button.attr("href")) {
                setTimeout(() => {
                    window.location.href = href;
                }, 2000);
            }
        },
        error: function (error) {
            console.log(error);
        },
    };
    $.ajax(setting);
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function formatNumber(nStr, decSeperate = ".", groupSeperate = ",") {
    nStr += "";
    x = nStr.split(decSeperate);
    x1 = x[0];
    x2 = x.length > 1 ? "." + x[1] : "";
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, "$1" + groupSeperate + "$2");
    }
    return x1 + x2;
}

function copyText(value, id_result = false) {
    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = value;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
    if(id_result != false){
        $(id_result).show()
        setTimeout(function(){
            $(id_result).hide()
        }, 1000)
    }
}