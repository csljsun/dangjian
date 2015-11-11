/**
 * 时间日期相关函数
 */



/**
 * 时间
 * @param  {[type]}      [description]
 * @return {[type]}     [description]
 */
function getTime() {
    // var curr_time = new Date();
    // var strDate = curr_time.getYear()+"年";
    // strDate += curr_time.getMonth()+1+"月";
    // strDate += curr_time.getDate()+"日";
    // strDate += curr_time.getHours()+":";
    // strDate += curr_time.getMinutes()+":";
    // strDate += curr_time.getSeconds();
    // document.write(strDate);

    // var curr_time = new Date();
    // with(curr_time)
    // {
    //     //定义变量，并为其赋值为当前年份，后加中文“年”字标识
    //     var strDate = getYear()+1900+"年";
    //     //取当前月份。注意月份从0开始，所以需加1，后加中文“月”字标识
    //     strDate +=getMonth()+1+"月";
    //     strDate +=getDate()+"日"; //取当前日期，后加中文“日”字标识
    //     strDate +=getHours()+":"; //取当前小时
    //     strDate +=getMinutes()+":"; //取当前分钟
    //     strDate +=getSeconds(); //取当前秒数
    //     alert(strDate); //结果输出
    // }
}

function getDate() {

}

function getDateTime() {

    var curr_time = new Date();

    //定义变量，并为其赋值为当前年份，后加中文“年”字标识
    var strDate = getYear()+1900+"年";
    //取当前月份。注意月份从0开始，所以需加1，后加中文“月”字标识
    strDate +=getMonth()+1+"月";
    strDate +=getDate()+"日"; //取当前日期，后加中文“日”字标识
    strDate +=getHours()+":"; //取当前小时
    strDate +=getMinutes()+":"; //取当前分钟
    strDate +=getSeconds(); //取当前秒数
    alert(strDate); //结果输出
    document.write(strDate);
}

function getYear() {
    var currTime = new Date();
    var strDate = currTime.getYear()+1900+"年";
    document.write(strDate);
}

function getMonthDay() {
    var currTime = new Date();
    strDate = currTime.getMonth()+1+"月";
    strDate += currTime.getDate()+"日";
    document.write(strDate);
}

function getWeekDay() {
    var currTime = new Date();
    var dayNames = new Array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
    document.write(dayNames[currTime.getDay()]);
}

