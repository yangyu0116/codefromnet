CheckAndValidator = function() {
    ///    <summary>
    ///        检查和验证类的构造器
    ///    </summary>
    ///    <returns type="Object">检查和验证类引用</returns>
};CheckAndValidator.prototype = {
    f_check_integer: function(value) {
        ///    <summary>
        ///    判断是否为整数，是则返回true，否则返回false
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的值 字符串类型
        ///    </param>
        ///    <returns type="bool">true 是整数，false 不是整数</returns>
        if (/^(\+|-)?\d+$/.test(value)) {
            return true;
        }
        else {
            return false;
        }
    },    f_check_float: function(value) {
        ///    <summary>
        ///    判断是否为实数，是则返回true，否则返回false
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的值 字符串类型
        ///    </param>
        ///    <returns type="bool"></returns>
        if (/^(\+|-)?\d+($|\.\d+$)/.test(value)) {
            return true;
        }
        else {
            return false;
        }
    },    f_check_zh: function(value) {
        ///    <summary>
        ///    检查输入字符串是否只由汉字组成，如果通过验证返回true,否则返回false
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的值 字符串类型
        ///    </param>
        ///    <returns type="bool"></returns>
        if (/^[\u4e00-\u9fa5]+$/.test(value)) {
            return true;
        }
        return false;
    },    f_check_lowercase: function(value) {
        ///    <summary>
        ///    判断是否为小写英文字母，是则返回true，否则返回false 
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的值 字符串类型
        ///    </param>
        ///    <returns type="bool"></returns>
        if (/^[a-z]+$/.test(value)) {
            return true;
        }
        return false;
    },    f_check_uppercase: function(value) {
        ///    <summary>
        ///    判断是否为大写英文字母，是则返回true，否则返回false 
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的值 字符串类型
        ///    </param>
        ///    <returns type="bool"></returns>
        if (/^[A-Z]+$/.test(value)) {
            return true;
        }
        return false;
    },    f_check_letter: function(value) {
        ///    <summary>
        ///    判断是否为英文字母，是则返回true，否则返回false 
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的值 字符串类型
        ///    </param>
        ///    <returns type="bool"></returns>
        if (/^[A-Za-z]+$/.test(value)) {
            return true;
        }
        return false;
    },    f_check_ZhOrNumOrLett: function(value) {
        ///    <summary>
        ///    检查输入字符串是否只由汉字、字母、数字组成，是则返回true，否则返回false 
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的值 字符串类型
        ///    </param>
        ///    <returns type="bool"></returns>
        var strRegex = "^[0-9a-zA-Z\u4e00-\u9fa5]+$";
        var re = new RegExp(strRegex);
        if (re.test(value)) {
            return true;
        }
        return false;
    },    f_check_IPv4: function(value) {
        ///    <summary>
        ///    校验ip地址的格式是否正确，是则返回true，否则返回false 
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的IPv4地址 字符串类型
        ///    </param>
        ///    <returns type="bool"></returns>
        var re = /^(\d+)\.(\d+)\.(\d+)\.(\d+)$/; //匹配IP地址的正则表达式
        if (re.test(value)) {
            if (RegExp.$1 < 256 && RegExp.$2 < 256 && RegExp.$3 < 256 && RegExp.$4 < 256) return true;
        }
        return false;
    },    f_check_IPv6: function(value) {
        ///    <summary>
        ///    校验ip地址是否为IPv6格式，是则返回true，否则返回false 
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的IPv6地址 字符串类型
        ///    </param>
        ///    <returns type="bool"></returns>
        var result = false;
        var regHex = "(\\p{XDigit}{1,4})";
        var regIPv6Full = "^(" + regHex + ":){7}" + regHex + "$";
        var regIPv6AbWithColon = "^(" + regHex + "(:|::)){0,6}" + regHex + "$";
        var regIPv6AbStartWithDoubleColon = "^(" + "::(" + regHex + ":){0,5}" + regHex + ")$";
        var regIPv6 = "^(" + regIPv6Full + ")|(" + regIPv6AbStartWithDoubleColon + ")|(" + regIPv6AbWithColon + ")$";
        if (value.indexOf(":") != -1) {
            if (value.length() <= 39) {
                var addressTemp = value;
                var doubleColon = 0;
                while (addressTemp.indexOf("::") != -1) {
                    addressTemp = addressTemp.substring(addressTemp.indexOf("::") + 2, addressTemp.length());
                    doubleColon++;
                }
                if (doubleColon <= 1) {
                    var re = new RegExp(regIPv6);
                    result = re.test(address);
                }
            }
        }
        return result;
    },    f_check_port: function(value) {
        ///    <summary>
        ///    检查输入的值是否符合合法的计算机IP地址端口号格式，是则返回true，否则返回false 
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的端口号 字符串类型
        ///    </param>
        ///    <returns type="bool"></returns>
        if (!this.f_check_number(value))
            return false;
        if (value < 65536)
            return true;
        return false;
    },    f_check_URL: function(value) {
        ///    <summary>
        ///    检查输入的值是否符合合法的计算机网址格式，是则返回true，否则返回false 
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的地址 字符串类型
        ///    </param>
        ///    <returns type="bool"></returns>
        var strRegex = "^((https|http|ftp|rtsp|mms)?://)"
        + "?(([0-9a-z_!~*'().&=+$%-]+: )?[0-9a-z_!~*'().&=+$%-]+@)?"    //ftp的user@ 
        + "(([0-9]{1,3}.){3}[0-9]{1,3}"                                 // IP形式的URL- 199.194.52.184 
        + "|"                                                           // 允许IP和DOMAIN（域名）
        + "([0-9a-z_!~*'()-]+.)*"                                       // 域名- www. 
        + "([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]."                         // 二级域名 
        + "[a-z]{2,6})"                                                 // first level domain- .com or .museum 
        + "(:[0-9]{1,4})?"                                              // 端口- :80 
        + "((/?)|"                                                      // a slash isn't required if there is no file name 
        + "(/[0-9a-z_!~*'().;?:@&=+$,%#-]+)+/?)$";
        var myReg = new RegExp(strRegex);
        if (myReg.test(value)) return true;
        return false;
    },    f_check_email: function(value) {
        ///    <summary>
        ///    检查输入的值是否符合E-Mail格式，是则返回true，否则返回false 
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的E-Mail值 字符串类型
        ///    </param>
        ///    <returns type="bool"></returns>
        var myReg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        if (myReg.test(value)) return true;
        return false;
    },    f_check_zipcode: function(value) {
        ///    <summary>
        ///    检查输入的值是否符合邮政编码格式，是则返回true，否则返回false 
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的邮政编码 字符串类型
        ///    </param>
        ///    <returns type="bool"></returns>
        if (!f_check_number(value))
            return false;
        if (value.length != 6) {
            return false;
        }
        return true;
    },    f_check_mobile: function(value) {
        ///    <summary>
        ///    检查输入手机号码是否正确，是则返回true，否则返回false 
        ///    一、移动电话号码为11或12位，如果为12位,那么第一位为0
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的手机号 字符串类型
        ///    </param>
        ///    <returns type="bool"></returns>
        var strRegex = /(^[1][0-9][0-9]{9}$)|(^0[1][0-9][0-9]{9}$)/;
        var re = new RegExp(strRegex);
        if (re.test(value)) {
            return true;
        }
        return false;
    },    f_check_phone: function(value) {
        ///    <summary>
        ///    检查输入的电话号码格式是否正确，是则返回true，否则返回false
        ///    一、电话号码由数字、"("、")"和"-"构成
        ///    二、电话号码为3到8位
        ///    三、如果电话号码中包含有区号，那么区号为三位或四位
        ///    四、区号用"("、")"或"-"和其他部分隔开 
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的电话号码 字符串类型
        ///    </param>
        ///    <returns type="bool"></returns>
        var strRegex = /(^([0][1-9]{2,3}[-])?\d{3,8}(-\d{1,6})?$)|(^\([0][1-9]{2,3}\)\d{3,8}(\(\d{1,6}\))?$)|(^\d{3,8}$)/;
        var re = new RegExp(strRegex);
        if (re.test(value)) {
            return true;
        }
        return false;
    },    /* 
    用户ID，可以为数字、字母、下划线的组合， 
    第一个字符不能为数字,且总长度不能超过20。 
    */
    f_check_userID: function(value, len) {
        ///    <summary>
        ///    检查用户ID是否正确，是则返回true，否则返回false
        ///    一、长度不能超过len的数值，不赋值时用户ID总长度默认为20
        ///    二、第一个字符不能为数字
        ///    三、只能为数字、字母、下划线的组合
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的用户ID 字符串类型
        ///    </param>
        ///    <param name="len" type="Number">
        ///    用户ID允许的长度 数值类型
        ///    </param>
        ///    <returns type="bool"></returns>        var length = 20; //用户ID总长度默认设置为20
        if (len != null && this.f_check_integer(len)) {
            length = len;
        }
        var userID = value;
        if (userID.length > length) {//ID长度不能大于length
            return false;
        }
        if (!isNaN(userID.charAt(0))) {//ID第一个字符不能为数字
            return false;
        }
        var strRegex = "^([0-9]|[a-zA-Z]|_)*$";
        var re = new RegExp(strRegex);
        if (!re.test(userID)) {//ID只能由数字、字母、下划线组合而成
            return false;
        }
        return true;
    },    f_check_IDno: function(value) {
        ///    <summary>
        ///    验证身份证号码是否有效
        ///    一、支持15位和18位身份证格式
        ///    二、验证通过则返回字符串“Right”，如果返回值不为“Right”则返回具体错误信息。
        ///    例子：var result = CheckAndValidator.f_check_IDno("452427198705050058");if(result != "Right")alert("错误身份证："+result);
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的身份证号 字符串类型
        ///    </param>
        ///    <returns type="String"></returns>
        var aCity = { 11: "北京", 12: "天津", 13: "河北", 14: "山西", 15: "内蒙古", 21: "辽宁", 22: "吉林", 23: "黑龙江", 31: "上海", 32: "江苏", 33: "浙江", 34: "安徽", 35: "福建", 36: "江西", 37: "山东", 41: "河南", 42: "湖北", 43: "湖南", 44: "广东", 45: "广西", 46: "海南", 50: "重庆", 51: "四川", 52: "贵州", 53: "云南", 54: "西藏", 61: "陕西", 62: "甘肃", 63: "青海", 64: "宁夏", 65: "新疆", 71: "台湾", 81: "香港", 82: "澳门", 91: "国外" };
        var iSum = 0;
        var info = "";
        var strIDno = value;
        var idCardLength = strIDno.length;
        var result = "Right";        if (!/^\d{17}(\d|x)$/i.test(strIDno) && !/^\d{15}$/i.test(strIDno)) {
            return result = "非法身份证号";
        }        //在后面的运算中x相当于数字10,所以转换成a   
        strIDno = strIDno.replace(/x$/i, "a");        if (aCity[parseInt(strIDno.substr(0, 2))] == null) {
            return result = "非法地区";
        }        if (idCardLength == 18) {
            sBirthday = strIDno.substr(6, 4) + "-" + Number(strIDno.substr(10, 2)) + "-" + Number(strIDno.substr(12, 2));
            var d = new Date(sBirthday.replace(/-/g, "/"))
            if (sBirthday != (d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate())) {
                return result = "非法生日";
            }            for (var i = 17; i >= 0; i--)
                iSum += (Math.pow(2, i) % 11) * parseInt(strIDno.charAt(17 - i), 11);            if (iSum % 11 != 1) {
                return result = "非法身份证号";
            }
        }
        else if (idCardLength == 15) {
            sBirthday = "19" + strIDno.substr(6, 2) + "-" + Number(strIDno.substr(8, 2)) + "-" + Number(strIDno.substr(10, 2));
            var d = new Date(sBirthday.replace(/-/g, "/"))
            var dd = d.getFullYear().toString() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
            if (sBirthday != dd) {
                return result = "非法生日";
            }
        }
        return result;
    },    f_check_str_match_reg: function(value, regu) {
        ///    <summary>
        ///    判断字符串是否符合指定的正则表达式，是则返回true，否则返回false
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的字符串 字符串类型
        ///    </param>
        ///    <param name="regu" type="String">
        ///    正则规则字符串 字符串类型
        ///    </param>
        ///    <returns type="bool"></returns>
        var re = new RegExp(regu);
        if (re.test(value))
            return true;
        return false;
    },    f_ltrim: function(value) {
        ///    <summary>
        ///    去除左边的空格，返回去除左边空格后的字符串
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要去除左边空格的字符串 字符串类型
        ///    </param>
        ///    <returns type="String"></returns>
        var whitespace = new String(" \t\n\r");
        var s = new String(value);        if (whitespace.indexOf(s.charAt(0)) != -1) {
            var j = 0, i = s.length;
            while (j < i && whitespace.indexOf(s.charAt(j)) != -1) {
                j++;
            }
            s = s.substring(j, i);
        }
        return s;
    },    f_rtrim: function(value) {
        ///    <summary>
        ///    去除右边的空格，返回去除右边空格后的字符串
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要去除右边空格的字符串 字符串类型
        ///    </param>
        ///    <returns type="String"></returns>
        var whitespace = new String(" \t\n\r");
        var s = new String(value);        if (whitespace.indexOf(s.charAt(s.length - 1)) != -1) {
            var i = s.length - 1;
            while (i >= 0 && whitespace.indexOf(s.charAt(i)) != -1) {
                i--;
            }
            s = s.substring(0, i + 1);
        }
        return s;
    },    f_trim: function(str) {
        ///    <summary>
        ///    去除字符串两边的空格，返回去除两边空格后的字符串
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要去除两边空格的字符串 字符串类型
        ///    </param>
        ///    <returns type="String"></returns>
        return RTrim(LTrim(str));
    },    f_check_date: function(obj, format) {
        ///    <summary>
        ///    判断日期是否与指定格式匹配
        ///    一、format的格式为：yyyy年MM月dd日, yyyy-MM-dd, yyyy/MM/dd, yyyyMMdd
        ///    二、验证通过则返回字符串“Right”，如果返回值不为“Right”则返回具体错误信息。
        ///    例子：var result = CheckAndValidator.f_check_date("2008-01-01");if(result != "Right")alert("错误信息："+result);
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的日期 字符串类型
        ///    </param>
        ///    <param name="value" type="String">
        ///    匹配的日期格式（yyyy年MM月dd日, yyyy-MM-dd, yyyy/MM/dd, yyyyMMdd） 字符串类型
        ///    </param>
        ///    <returns type="String"></returns>
        var date = this.f_trim(value);
        var year, month, day, datePat, matchArray;
        var result = "Right";        if (/^(y{4})(-|\/)(M{1,2})\2(d{1,2})$/.test(format))
            datePat = /^(\d{4})(-|\/)(\d{1,2})\2(\d{1,2})$/;
        else if (/^(y{4})(年)(M{1,2})(月)(d{1,2})(日)$/.test(format))
            datePat = /^(\d{4})年(\d{1,2})月(\d{1,2})日$/;
        else if (format == "yyyyMMdd")
            datePat = /^(\d{4})(\d{2})(\d{2})$/;
        else {
            return result = "日期格式不对";
        }
        matchArray = date.match(datePat);
        if (matchArray == null) {
            return result = "日期长度不对或日期中有非数字符号";
        }
        if (/^(y{4})(-|\/)(M{1,2})\2(d{1,2})$/.test(format)) {
            year = matchArray[1];
            month = matchArray[3];
            day = matchArray[4];
        } else {
            year = matchArray[1];
            month = matchArray[2];
            day = matchArray[3];
        }
        if (month < 1 || month > 12) {
            return result = "月份应该为1到12的整数";
        }
        if (day < 1 || day > 31) {
            return result = "每个月的天数应该为1到31的整数";
        }
        if ((month == 4 || month == 6 || month == 9 || month == 11) && day == 31) {
            return result = "该月不存在31号";
        }
        if (month == 2) {
            var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
            if (day > 29) {
                return result = "2月最多有29天";
            }
            if ((day == 29) && (!isleap)) {
                return result = "闰年2月才有29天";
            }
        }
        return result;
    },    f_check_time: function(value, format) {
        ///    <summary>
        ///    判断时间是否与指定格式匹配
        ///    一、format的格式为：yyyy年MM月dd日HH时mm分ss秒, yyyy-MM-dd HH:mm:ss, yyyy/MM/dd HH:mm:ss, yyyyMMddHHmmss 
        ///    二、验证通过则返回字符串“Right”，如果返回值不为“Right”则返回具体错误信息。
        ///    例子：var result = CheckAndValidator.f_check_time("2008-01-01 12:30:21");if(result != "Right")alert("错误信息："+result);
        ///    </summary>
        ///    <param name="value" type="String">
        ///    需要判断的时间 字符串类型
        ///    </param>
        ///    <param name="value" type="String">
        ///    匹配的时间格式（yyyy年MM月dd日HH时mm分ss秒, yyyy-MM-dd HH:mm:ss, yyyy/MM/dd HH:mm:ss, yyyyMMddHHmmss ） 字符串类型
        ///    </param>
        ///    <returns type="String"></returns>
        var time = this.f_trim(value);
        var datePat, matchArray, year, month, day, hour, minute, second;
        var result = "Right";        if (/^(y{4})(-|\/)(M{1,2})\2(d{1,2}) (HH:mm:ss)$/.test(format))
            datePat = /^(\d{4})(-|\/)(\d{1,2})\2(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})$/;
        else if (/^(y{4})(年)(M{1,2})(月)(d{1,2})(日)(HH时mm分ss秒)$/.test(format))
            datePat = /^(\d{4})年(\d{1,2})月(\d{1,2})日(\d{1,2})时(\d{1,2})分(\d{1,2})秒$/;
        else if (format == "yyyyMMddHHmmss")
            datePat = /^(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/;
        else {
            return result = "日期格式不对";
        }
        matchArray = time.match(datePat);
        if (matchArray == null) {
            return result = "日期长度不对或日期中有非数字符号";
        }
        if (/^(y{4})(-|\/)(M{1,2})\2(d{1,2}) (HH:mm:ss)$/.test(format)) {
            year = matchArray[1];
            month = matchArray[3];
            day = matchArray[4];
            hour = matchArray[5];
            minute = matchArray[6];
            second = matchArray[7];
        } else {
            year = matchArray[1];
            month = matchArray[2];
            day = matchArray[3];
            hour = matchArray[4];
            minute = matchArray[5];
            second = matchArray[6];
        }
        if (month < 1 || month > 12) {
            return result = "月份应该为1到12的整数";
        }
        if (day < 1 || day > 31) {
            return result = "每个月的天数应该为1到31的整数";
        }
        if ((month == 4 || month == 6 || month == 9 || month == 11) && day == 31) {
            return result = "该月不存在31号";
        }
        if (month == 2) {
            var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
            if (day > 29) {
                return result = "2月最多有29天";
            }
            if ((day == 29) && (!isleap)) {
                return result = "闰年2月才有29天";
            }
        }
        if (hour < 0 || hour > 23) {
            return result = "小时应该是0到23的整数";
        }
        if (minute < 0 || minute > 59) {
            return result = "分应该是0到59的整数";
        }
        if (second < 0 || second > 59) {
            return result = "秒应该是0到59的整数";
        }
        return true;
    },    f_is_visible: function(obj) {
        ///    <summary>
        ///    判断当前DOM对象是否可见，可见则返回true，否则返回false
        ///    </summary>
        ///    <param name="obj" type="DOM Object">
        ///    需要处理的DOM元素 DOM对象
        ///    </param>
        ///    <returns type="bool"></returns>
        var visAtt, disAtt;
        try {
            disAtt = obj.style.display;
            visAtt = obj.style.visibility;
        } catch (e) { }
        if (disAtt == "none" || visAtt == "hidden")
            return false;
        return true;
    },    f_check_pr_visible: function(obj) {
        ///    <summary>
        ///    判断当前对象及其父对象是否可见，可见则返回true，否则返回false
        ///    </summary>
        ///    <param name="obj" type="DOM Object">
        ///    需要处理的DOM元素 DOM对象
        ///    </param>
        ///    <returns type="bool"></returns>
        var pr = obj.parentNode;
        do {
            if (pr == undefined || pr == "undefined") return true;
            else {
                if (!this.f_is_visible(pr)) return false;
            }
        } while (pr = pr.parentNode);
        return true;
    },    /** 
    * 检测字符串是否为空 
    */
    f_is_null: function(str) {
        var i;
        if (str.length == 0)
            return true;
        for (i = 0; i < str.length; i++) {
            if (str.charAt(i) != ' ')
                return false;
        }
        return true;
    },    f_get_date_by_format: function(str, format) {
        ///    <summary>
        ///    根据日期格式，将字符串转换成Date对象 不正确则返回null，否则返回日期Date对象
        /// 格式：yyyy-MM-dd HH:mm:ss，yyyy-MM-dd
        ///    </summary>
        ///    <param name="str" type="String">
        ///    需要处理的日期字符串 字符串类型
        ///    </param>
        ///    <param name="format" type="String">
        ///    日期格式 默认为：yyyy-MM-dd HH:mm:ss
        ///    </param>
        ///    <returns type="Date?"></returns>
        var dateReg, format;
        var y, M, d, H, m, s, yi, Mi, di, Hi, mi, si;
        if ((arguments[1] + "") == "undefined") format = "yyyy-MM-dd HH:mm:ss";
        else format = arguments[1];
        yi = format.indexOf("yyyy");
        Mi = format.indexOf("MM");
        di = format.indexOf("dd");
        Hi = format.indexOf("HH");
        mi = format.indexOf("mm");
        si = format.indexOf("ss");
        if (yi == -1 || Mi == -1 || di == -1) return null;
        else {
            y = parseInt(str.substring(yi, yi + 4));
            M = parseInt(str.substring(Mi, Mi + 2));
            d = parseInt(str.substring(di, di + 2));
        }
        if (isNaN(y) || isNaN(M) || isNaN(d)) return null;
        if (Hi == -1 || mi == -1 || si == -1) return new Date(y, M - 1, d);
        else {
            H = str.substring(Hi, Hi + 4);
            m = str.substring(mi, mi + 2);
            s = str.substring(si, si + 2);
        }
        if (isNaN(parseInt(y)) || isNaN(parseInt(M)) || isNaN(parseInt(d))) return new Date(y, M - 1, d);
        else return new Date(y, M - 1, d, H, m, s);
    }
};CheckAndValidator = new CheckAndValidator();