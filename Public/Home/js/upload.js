/**
 * 上传文件
 * @param  {[type]}      [description]
 * @return {[type]}     [description]
 */
function upload(w, h) {
    var l = (screen.width - w) / 2;
    var t = (screen.height - h) / 2;
    var s = 'width=' + w + ', height=' + h + ', top=' + t + ', left=' + l;
    s += ', toolbar=no, scrollbars=no, menubar=no, titlebar=no, location=no, resizable=no';
    window.open("/home/file/upload.html", 'oWin', s);
}