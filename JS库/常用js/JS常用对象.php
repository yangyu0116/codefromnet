document.body.scrollTop  返回和设置当前竖向滚动条的坐标值，须与函数配合,
document.body.scrollLeft  返回和设置当前横向滚动务的坐标值，须与函数配合，
window.status=defaultStatus  将状态栏设置默认显示
Obejct.innerHTML  对象Object标签中的html源代码
Obejct.outerHTML  对象Object的html源代码（包含标签本身）

Math.MAX_VALUE  JavaScript中数的最大可能值；最大为1.7976931348623157e+308
Math.MIN_VALUE  JavaScript中比0大的数字的最小可能值；最小为：5e-324
Math.NaN  非数字的任意值
Math.NEGATIVE_INFINITY  JavaScript中小于最大负数的任意数字；也就是说，小于-1.7976931348623157e+308的任意数字
Math.POSITIVE_INFINITY  JavaScript中大于最大正数的任意数字；也就是说，小于1.7976931348623157e+308的任意数字
Math.E  欧拉常数（E），近似值：2.718281828459045
Math.PI  常数π，近似值：3.141592653589793
Math.abs(Number)  Number的绝对值
Math.acos(Number)  Number（必须介于-1和+1之间）的反余弦，返回值的范围在0和π弧度之间
Math.asin(Number)  Number（必须介于-1和+1之间）的反正弦，返回值的范围在-π/2和π/2弧度之间
Math.atan(Number)  Number的反正切，返回值的范围在-π/2和π/2弧度之间
Math.atan2(y, x)  y/x（这里的（x，y）是迪卡尔坐标值）的反正切，返回值的范围在-π/2和π/2弧度之间
Math.ceil(Number)  大于或等于Number的最小整数
Math.cos(Number)  Number的余弦，返回值的范围在-1和1之间
Math.exp(Number)  E的Number次幂
Math.floor(number)  小于或等于Number的最大整数，舍取所有小数
Math.log(Number)  Number的自然对数（以E为底）
Math.max(Number1, Number2)  返回Number1,Number2的较大者
Math.min(Number1, Number2)  返回Number1,Number2的较小者
Math.pow(Number1, Number2)  返回Number1的Number2次方幂
Math.random()  随机函数,只能是0到1之间的数,如果要得到其它数,可以为*10,再取整
Math.round(Number)  最靠近Number的整数（对小数部分四舍五入）
Math.sin(Number)  Number的正弦，返回值的范围在-1和1之间
Math.sqrt(Number)  Number（必须大于或等于0）的平方根
Math.tan(Number)  Number（以弧度表示）的正切
Math.toString(Number)  与Number等价的字符串
parseInt(String, Base)  将字符串转换为数字，如果字符串以数字打头，后跟一些文本，则函数只返回字符串开头的整数部分。String：待转换的字符串，Base：可选，String中数字的进制，默认为10进制
parseFloat(String)  将字符串转换为数字，如果字符串以数字打头，后跟一些文本，则函数只返回字符串开头的数字部分

navigator.appCodeName  与浏览器相关的内部代码名
navigator.appMinorVersion  辅版本号（通常是应用于浏览器的补丁或服务包）
navigator.appName  浏览器的正式名称，对于Internet Explorer返回Microsoft Internet Explorer，对于Netscape Navigator返回Netscape
navigator.appVersion  浏览器的版本号
navigator.cookieEnabled  若用户的浏览器被设置为允许cookie，则返回true，否则返回false
navigator.cpuClass  浏览器正在运行的计算机的CUP型号（通常Intel芯片返回x86，PowerPC芯片返回PPC）
navigator.language  浏览器支持的语言（English返回en，German返回de，等等）
navigator.mimetypes  浏览器支持的所有MIME类型的数组（Internet Explorer只有在Macintosh版本5中支持该属性）
navigator.onLine  如果浏览器（IE）当前为在线模式，返回true，否则返回false
navigator.oscpu  浏览器正在运行的操作系统，某些系统中也可能报告CPU的情况
navigator.platform  浏览器正在运行的操作平台，有效值包括Win16（Windows 3.x）、Win32（Windows 9x，Me，NT，2000）、Mac68K（Macintosh 680x0）和MacPPC（Macintosh PowerPC）
navigator.product  浏览器的产品名
navigator.productSub  与浏览器产品相关的更多信息；例如Netscape 6中，这个属性返回程序创建日期
navigator.securityPolicy  浏览器支持的加密类型；Export policy意味着低加密方法；US & CA domestic policy 意味着高加密方法
navigator.systemLanguage  用户操作系统支持的默认语言，例如en-us表示英语（美国）
navigator.userAgent  包含一下属性中所有或一部分的字符串：appCodeName、appName、appVersion、language和platform
navigator.userLanguage  用户在自己系统上设置的语言
navigator.userProfile  返回一个UserProfile对象，它存储用户的个人信息
navigator.vendor  制作浏览器的公司
navigator.vendor  关于浏览器制作厂商的更多信息

String.anchor(Name)  将String转换为一个<a name>锚标记，这里的name属性值由Name参数给出，此方法等价于以下语句：<a name="Name">String</a>
String.big()  和HTML的<big>标记一样，以相同的方式格式化String，此方法等价于以下语句：<big>String</big>
String.blink()  和HTML的<blink>标记一样，等价于以下语句：<blink>String</blink>
String.bold()  和HTML的<b>标记一样，等价于一下语句：<b>String</b>
String.fixed()  和HTML的<tt>标记一样，等价于一下语句：<tt>String</tt>
String.fontcolor(Color)  和HTML的<font color>标记一样，等价于一下语句：<font color="Color">String</font>
String.fontsize(Size)  和HTML的<font size>标记一样，等价于一下语句：<font size="Size">String</font>
String.italics()  和HTML的<i>标记一样，等价于一下语句：<i>String</i>
String.link(URL)  将String转换成一个<a href>链接标记，等价于一下语句：<a href="URL">String</a>
String.small()  和HTML的<small>标记一样，等价于一下语句：<small>String</small>
String.strike()  和HTML的<strike>标记一样，等价于一下语句：<strike>String</strike>
String.sub()  和HTML的<sub>标记一样，等价于一下语句：<sub>String</sub>
String.sup()  和HTML的<sup>标记一样，等价于一下语句：<sup>String</sup>
String.charAt(Index)  返回String中索引位置为Index的字符
String.charCodeAt(Index)  返回String中索引位置为Index的字符代码
String.indexOf(Substring, start)  Substring在String中的第一个位置，没有返回-1
String.lastIndexOf(Substring, start)  Substring在String中的最后一个位置，没有返回-1
String.slice(Start, End)  返回String中起始索引位置为Start，结束索引位置为End之前的子字符串
String.split(Separator, Limit)  返回一个数组，这个数组的每一项都是String的子字符串，并且这些子字符串被Separator分离
String.substr(Start, Len)  返回String中起始索引位置为Start，长度为Len的子字符串
String.substring(Start, End)  返回String中起始索引位置为Start，结束索引位置为End的子字符串
String.concat(String2)  将String2连接到String的尾部。换句话说，此方法等价于：String + String2
String.fromCharCode(Code1, Code2, etc)  建立一个字符串，该字符串由与代码Code1、Code2等相应得字符组成
String.match(Regular_Expression)  从String中搜索出匹配Regular_Expression的子字符串，返回一个包含所有匹配值的数组
String.replace(Regular_Expression, Replace_String) 从String中搜索出所有匹配Regular_Expression的子字符串，并使用Replace_String取代这些子字符串
String.search(Regular_Expression)  从String中搜索出所有匹配Regular_Expression的子字符串，但只返回第一个子字符串实例的索引
String.toLowerCase()  将String全部转换为小写
String.toUpperCase()  将String全部转换为大写

event.clientX  返回最后一次点击鼠标X坐标值；
event.clientY  返回最后一次点击鼠标Y坐标值；
event.offsetX  返回当前鼠标悬停X坐标值
event.offsetY  返回当前鼠标悬停Y坐标值
event.button==1/2/3 鼠标键左键等于1右键等于2两个键一起按为3

opener  控制原打开窗体对象
parent  控制框架父级页面
WindowObject.closed  对象窗口WindowObject是否已关闭true/false
eval(String)  将字符串转换成JavaScript代码
confirm(String)  弹出确认框，确定返回true取消返回false
prompt("提示信息","预定值")  输入语句
alert(String)  弹出提示框，提示框显示内容为String
form.reset()  使form表单内的数据重置
form.submit() 使form对象提交数据
clearTimeout(Object)  清除已设置的setTimeout对象
clearInterval(Object)  清除已设置的setInterval对象
setTimeout("function", time)  设置一个超时对象
setInterval("function", time)  设置一个超时对象

typeof(Object)  检查Obejct的类型，值有：String,Boolean,Object,Function,Underfined
Object.prototype.OwnerAttribute = Object  为对象Object增加自定义的属性或方法

screen.availWidth  用户显示器可用的最大高度，以像素为单位
screen.availHeight  用户显示器可用的最大宽度，以像素为单位
screen.colorDepth  用户显示器上每像素可用的位数
screen.height  用户显示器的实际高度，以像素为单位
screen.pixelDepth  （仅用于Netscape 4+）每像素最大的位数，由用户的显示设置给出
screen.width  用户显示器的实际宽度，以像素为单位

window.resizeTo(x, y)  将窗口设置宽高（绝对坐标）
window.resizeBy(x, y)  将窗口设置宽高（相对坐标）
window.moveTo(x, y)  将窗口移到某位置（绝对坐标）
window.moveBy(x, y)  将窗口移到某位置（相对坐标）
window.scroll(x, y)  窗口滚动条坐标，y控制上下移动，须与函数配合（绝对坐标）
window.scrollBy(x, y)  窗口滚动条坐标，y控制上下移动，须与函数配合（相对坐标）
window.focus()  使当前窗口获得焦点
window.open() window.open("地址","名称","属性") 
属 性:toolbar(工具栏), location(地址栏), directions, status(状态栏), menubar(菜单栏), scrollbar(滚动条), resizable(改变大小), width(宽), height(高), fullscreen(全屏), scrollbars(全屏时无滚动条), channelmode(宽屏), left(打开窗口x坐标), top(打开窗口y坐标)
window.location = 'view-source:' + window.location.href  应用事件查看网页源代码;

location.protocol  用于浏览器和服务器彼此通信的协议，如http:
location.hostname  作为主机发布文档的服务器名，如www.abiaos.com
location.port  用于浏览器和服务器彼此通信的端口，如80
location.host  在地址中指定的主机名和端口，此属性等于：hostname + ":" + port
location.pathname  文档的路径和文件名。如/about/index.html
location.hash  在地址中指定的锚名，其紧跟在符号#之后
location.search  从问号（？）到末尾的地址部分，包含？在内，但不包含锚名
location.href  整个地址，等价于location
location.reload(source)  重新载入页面。Source（可选）是一个布尔值。决定浏览器从那里重载页面：使用false（默认值）来从保存页面的缓冲中载入页面；使用true来迫使浏览器从服务器载入页面。
location.replace(URL)  用历史列表取代页面，调用history.go(-1)时将跳过调用函数的页面

history.back()  模拟Back按钮
history.forward()  模拟Forward按钮
history.go(How_Far)  返回历史列表中的任何页面。How_Far为一个整数值，负数往后退，正数往前进，零刷新当前页面。 运行history.go(0)与运行location.reload()不一样。history.go(0)方法只刷新页面，这意味着用户已经输入的表单数据将不会改变。

document.activeElement  当文档有焦点时，返回有焦点的对象（IE4+）
document.alinkColor  返回或设置文档中链接的颜色，相当于<body>标记中的alink属性
document.anchors  返回文档中所有锚组成的数组
document.applets  返回文档中由所有Java小程序（<applet>标记）组成的数组
document.bgColor  返回或设置文档的背景颜色，相当于<body>标记中的bgcolor属性
document.cookie  返回或设置cookie
document.defaultCharset  文档中使用的默认字符集（IE4+）
document.domain  返回或设置文档的默认域名
document.embeds  返回文档中所有嵌入对象（<embed>标记）组成的数组
document.fgColor  返回或设置文档的前景（文本）颜色；相当于<body>中的text属性
document.fileCreatedDate  返回文档创建时的日期（IE4+）
document.fileModifiedDate  返回文档最后一次修改的日期（IE4+）
document.fileSize  返回文档的字节大小（IE4+）
document.forms  返回文档中所有表单（<form>标记）组成的数组
document.images  返回文档中所有图像组成的数组
document.forms.length  返回当前页form表单数
document.anchors.length  返回当前页锚的数量
document.links.length  返回当前页联接的数量
document.lastModified  返回文档最后一次修改的日期
document.layers  返回文档中所有层（<layer>标记）组成的数组（仅Netscape4）
document.linkColor  返回或设置文档中未访问链接的颜色；相当于<body>中的link属性
document.links  返回文档中所有链接组成的数组
document.location  返回或设置文档的地址
document.nameProp  返回文档的文件名（IE4+）
document.readyState  返回文档的当前状态（文档正在装载则返回loading；文档装载完毕则返回complete）（IE4+）
document.referrer  返回用户用于冲浪至当前文档的地址。如果当前文档是首页或是通过键入URL到达的页面，那么这个属性返回空字符串
document.scripts  返回文档中所有脚本（<script>标记）组成的数组。（IE4+）
document.title  返回或设置由<title>标记给出的文档标题
document.URL  返回或设置文档的地址
document.vlinkColor  返回或设置文档中已访问链接的颜色；相当于<body>中的vlink属性
document.captureEvents()  截取一个事件，以便它被Document对象处理，而不是被激活事件的对象处理。（Netscape4+）
document.clear()  清除文档的所有文本和标记
document.close()  关闭用于向文档写入文本的输出流
document.open()  打开一个输入流，向文档写入文本
document.releaseEvents()  释放被Document对象截取的事件（Netscape4+）
document.routeEvent()  截取一个事件，以便它被Document对象处理，然后把这个事件传递给激活给事件的对象。（Netscape4+）
document.write()  向文档写入数据
document.writeln()  向文档写入一行数据，后跟一个回车

Link.target  由target属性指定的值
Link.innerHTML  在<a href>和</a>标记之间的文本（IE4+和Netscape6）
Link.text  在<a href>和</a>标记之间的文本（Netscape4+）
注：每一个Link对象也是一个Location对象。也就是说所有的Location对象的属性也是Link对象的属性，但是Location对象的方法不能用于Link对象。

Anchor.name  Anchor对象name属性指定的值
Link.innerHTML  在<a name>和</a>标记之间的文本（IE4+和Netscape6）
Link.text  在<a name>和</a>标记之间的文本（Netscape4+）

Image.complete  如果图像还在载入，则返回false；如果图像已经完全载入，则返回true。
<img onAbort="…">  当图像下载被取消时触发
<img onError="…">  当图像载入失败时触发
<img onLoad="…">  当图像完全载入时触发

document.cookie = "Name=Value; expires=GMT_String; domain=Cookie_Domain; path=Cookie_Dir; Cooke_Secure"  Name：cookie的名称；Value：cookie的值；GMT_String：表示cookie终止日期的GMT格式的字符串；Cookie_Dir：指定可以访问该cookie的最顶层目录的字符串；Cookie_Domain：指定域名或标识符的字符串；Cookie_Secure：如果为true，则该cookie只发往使用HTTPS（安全）协议链接的浏览器；如果为false（或者忽略）则发给所有的浏览器，即使使用了不安全的HTTP协议

new Date()  创建一个日期对象(当前时间)
new Date("Month dd, yyyy hh:mm:ss")  创建一个日期对象
new Date(yyyy, mth, dd, hh, mm, ss)  创建一个日期对象
new Date(ms)  创建一个日期对象(ms：从GMT时间1970-1-1起的毫秒数)
Date.getYear()  获取年份值 两位数年份
Date.getFullYear()  获取全年份数 四位数年份（1999，2000等）
Date.getMonth()  获取年中的某月，从0（January）～ 11（December）
Date.getDate()  获取月中的某日，从1～31
Date.getDay()  /获取当前星期值，从0（Sunday）～ 6（Staturday）
Date.getHours()  获取当前小时数，从0（午夜）～ 23（晚上11点）
Date.getMinutes()  获取当前分钟数，从0～59
Date.getSeconds()  获取当前秒数，从0～59
Date.getMilliseconds()  获取当前毫秒数数，从0～999
Date.getTime()  从GMT时间1970年1月1日起的毫秒数
Date.toLocaleString()  从时间对象中获取时间，以字符串型式存在
注：除getDay()外，其他的get函数都有一个对应的set函数。

对象.style.fontSize="文字大小";
单位：mm/cm/in英寸/pc帕/pt点/px象素/em文字高
1in=1.25cm
1pc=12pt
1pt=1.2px(800*600分辩率下)
文本字体属性：
fontSize大小
family字体
color颜色
fontStyle风格，取值为normal一般,italic斜体,oblique斜体且加粗
fontWeight加粗,取值为100到900不等,900最粗,light,normal,bold
letterSpacing间距,更改文字间距离,取值为,1pt,10px,1cm
textDecoration:文字修饰;取值,none不修饰,underline下划线,overline上划线
background:文字背景颜色,
backgroundImage:背景图片,取值为图片的插入路径

点击网页正文函数调用触发器：
1.onClick 当对象被点击
2.onLoad 当网页打开,只能书写在body中
3.onUnload 当网页关闭或离开时,只能书写在body中
4.onmouseover 当鼠标悬于其上时
5.onmouseout 当鼠标离开对象时
6.onmouseup 当鼠标松开
7.onmousedown 当鼠标按下键
8.onFocus 当对象获取焦点时
9.onSelect 当对象的文本被选中时
10.onChange 当对象的内容被改变
11.onBlur 当对象失去焦点
onsubmit=return(ss()) 表单调用时返回的值
直线 border-bottom:1x solid black
虚线 border-bottom:1x dotted black
点划线border-bottom:2x dashed black
双线 border-bottom:5x double black
槽状 border-bottom:1x groove black
脊状 border-bottom:1x ridge black

1.边缘高光glow(color=颜色,strength=亮光大小)
2.水平翻转fliph() 使对象水平翻转180度
3.垂直翻转flipv() 使对象垂直翻转180度
4.对象模糊blur(add=true/false direction=方向 strength=强度)
add指定是否按印象画派进行模糊direction模糊方向strength模糊强度
5.对象透明alpha(opaction=0-100,finishopacity=0-100,style=0/1/2/3)
opaction对象整体不透明值finishopacity当对象利用了渐透明时该项指定结束透明位置的不透明值style指定透明方式0为整体透明，1为线型透明，2为圆型透明，3为矩形透明
6.去除颜色chroma(color=颜色值)使对象中颜色与指定颜色相同区域透明
7.建立阴影dropshadow(color=阴影颜色,offx=水平向左偏离像素,offy=水平向下偏离像素)
8.去色gray()使对象呈灰度显示
9.负片效果invert()使对象呈底片效果
10.高光light()使对象呈黑色显示
11.遮盖mask(color=颜色)使整个对象以指定颜色进行蒙板一次
opacity 表透明度水平.0~100,0表全透明,100表完全不透明
finishopacity表想要设置的渐变透明效果.0~100.
style 表透明区的形状.0表统一形状.1表线形.2表放射形.3表长方形.
startx.starty表渐变透明效果的开始时X和Y坐标.
finishx,finishy渐变透明效果结束时x,y 的坐标.
add有来确定是否在模糊效果中使有原有目标.值为0,1.0表"否",1表"是".
direction设置模糊的方向.0度表垂直向上,45度为一个单位.默认值是向左270度.left,right,down,up.
strength 只能用整数来确定.代表有多少个像素的宽度将受到模糊影响.默认是5个.
color要透明的颜色.
offx,offy分别是x,y 方向阴影的偏移量.
positive指投影方式.0表透明像素生成阴影.1表只给出不透明像素生成阴影..
AddAmbient:加入包围的光源.
AddCone:加入锥形光源.
AddPoint加入点光源
Changcolor:改变光的颜色．
Changstrength:改变光源的强度．
Clear:清除所有的光源．
MoveLight:移动光源．
freq是波纹的频率，在指定在对象上一区需要产生多少个完事的波纹．
lightstrength可对于波纹增强光影的效果．显著0~100正整数，正弦波开始位置是0~360度．0表从0度开始，25表从90度开始．
strength表振幅大小．

hand style="cursor:hand"
crosshair style="cursor:crosshair"
text style="cursor:text"
wait style="cursor:wait"
default style="cursor:default" 
help style="cursor:help"
e-resize style="cursor:e-resize"
ne-resize style="cursor:ne-resize"
n-resize style="cursor:n-resize"
nw-resize style="cursor:nw-resize"
w-resize style="cursor:w-resize"
s-resize style="cursor:s-resize"
sw-resize style="cursor:sw-resize "
se-resize style="cursor:se-resize"
auto style="cursor:auto"
