/**
 * 元素赋值
 * @param  {[type]} url [description]
 * @return {[type]}     [description]
 */
function delcfm(url) {
        $('#url').val(url);//给会话中的隐藏属性URL赋值
        $('#delcfmModel').modal();
}
/**
 * 提交表单
 * @return {[type]} [description]
 */
function urlSubmit(){
    var url=$.trim($("#url").val());//获取会话中的隐藏属性URL
    window.location.href=url;
}