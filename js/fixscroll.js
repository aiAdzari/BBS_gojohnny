window.onscroll = function () {
    var scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
    if (scrollTop >= 70) {
        document.getElementById("nav").classList.add("fixnav"); //在滚动完title的距离后，nav增加fixd属性，吸附在窗口上方
        document.getElementById("sep1").classList.remove("sep"); //修复因为滚动后，nav为fixd后本身不占用html空间导致的下方元素向上跳动
        document.getElementById("sep1").classList.add("fixsep");
        document.getElementById("sep2").classList.remove("sep");
        document.getElementById("sep2").classList.add("fixsep");
    } else {
        document.getElementById("nav").classList.remove("fixnav");
        document.getElementById("sep1").classList.remove("fixsep");
        document.getElementById("sep1").classList.add("sep");
        document.getElementById("sep2").classList.remove("fixsep");
        document.getElementById("sep2").classList.add("sep");
    }

}