<?PHP
// database config options
//define('DB_HOST', ':/newsants/db/newsantsdb/sock/my-newsants.sock');    // hostname of database
define('DB_HOST', 'localhost');    // hostname of database
define('DB_USERNAME', 'root');  // username of database
define('DB_PASSWORD', '*******');         // password of databsae
define('DB_TYPE', 'mysql');         // password of databsae
define('DEFAULT_DB', '*******');   // name of database to use
define('SITE_NAME', 'mysite');   // site name

// security setup

define('ACCESS_ANONYMOUS', 0);
define('ACCESS_USER', 1);
define('ACCESS_POWERUSER', 2);
define('ACCESS_ADMIN', 3);

// some settings
define('REQUIRE_VALID_EMAIL', 1);
define('RECORD_PER_PAGE',10);
define('MULTICOL',5);

// min and max password and username lengths
define('MIN_PASSWORD_LENGTH', 4);
define('MAX_PASSWORD_LENGTH', 13);
define('MIN_USERNAME_LENGTH', 4);
define('MAX_USERNAME_LENGTH', 13);

// main colors
define('BG', '#ffffff');
define('TEXT', '#000000');
define('LINK', '#0000ff');
define('ALINK', '#FF9933');
define('VLINK', '#0000ff');

// help bubble colors
define('HELP_BACKGROUND', '#FEFFC0');
define('HELP_BORDER_COLOR', '#659ACC');
define('HELP_TEXT', '#000000');
define('HELP_BORDER_STYLE', 'dashed');

// form colors (for adding questions, users, etc...);
define('FORM_BACKGROUND', '#D6EBFF');
define('FORM_BORDER_COLOR', '#659ACC');
define('FORM_BORDER_STYLE', 'dotted');

// left-hand menu colors
define('MENU_BACKGROUND', '#F9F9F9');
define('MENU_BORDER_COLOR', '#659ACC');

// table colors
define('TABLE_BORDER', '#659ACC');
define('TABLE_BG', '#ffffff');
define('TABLE_LIGHT', '#BDDFFF');
define('TABLE_DARK', '#E5F3FF');
define('TABLE_HEADER', '#eeeeee');

	$strings = array (
	'ERROR_PASSWORD_INCORRECT' => '密码不正确',
	'ERROR_USERNAME_TAKEN' => '用户名已经存在',
	'ERROR_EMAIL_TAKEN' => 'EMAIL已经使用过了',
	'ERROR_PASSWORD_TOO_SHORT' => '密码太短',
	'ERROR_PASSWORDS' => '密码不合法',
	'ERROR_USERNAME_TOO_SHORT' => '用户名太短',
	'ERROR_NO_ACTION' => '没有动作',
	'ERROR_ADMIN' => '您没有系统管理权限',
	'ERROR_FORM_INPUT' => '输入不正确',
	'ERROR_IP_NOTVAILD' => '不是一个合法的IP地址',
	'ERROR_IPADDR_TAKEN' => 'IP地址已经被分配',

	'LOG_LOGIN_FAIL' => '登录系统未成功',
	'LOG_LOGIN_SUCCESS' => '成功登录系统',
	'LOG_LOGOUT'	=> '退出系统',
	'LOG_TITLE'	=> '系统登录记录',
	'LOG_IP'	=> 'IP地址',
	'LOG_USERNAME'	=> '用户',
	'LOG_EVENT'	=> '事件',
	'LOG_DATE'	=> '时间',
	'LOG_NO_RESULTS'	=>	'无事件',

	'HELP_CHANGE_PASSWORD' => '修改您的密码,密码长度必需大于5位',

	'MENU_ADMIN' => '您有系统管理员权限',
	'MENU_HELLO' => '您好!',
	'MENU_CHANGE_PASSWORD' => '修改密码',
	'MENU_LOGOUT' => '退出系统',

	'USER_PASSWORD_CHANGED' => '修改用户密码成功',
	'USER_OLD_PASSWORD' => '旧密码',
	'USER_NEW_PASSWORD' => '新密码',
	'USER_CONFIRM_NEW_PASSWORD' => '确认新密码',
	'USER_INVALID_EMAIL' => '您的EMAIL格式不正确',
	'USER_SUCCESS' => '用户添加成功',
	'USER_DESIRED_USERNAME' => '用户名',
	'USER_ADD_ADMIN' => '拥有系统管理员权限',
	'USER_PASSWORD' => '输入用户密码',
	'USER_PASSWORD_CONFIRM' => '确认用户密码',
	'USER_EMAIL' => 'Email地址',
	'USER_BOOKMARK' => '书签',
	'USER_DESC' => '描述' ,
	'USER_DELETED' => '成功删除用户',
	'USER_USERS' => '用户列表',
	'USER_ID' => '用户ID',
	'USER_DATE_ADDED' => '用户注册日期',
	'USER_ACCESS_LEVEL' => '用户权限',
	'USER_EDIT' => '编辑',
	'USER_DELETE' => '删除',
	'USER_CONFIRM_DELETE' => '您确定要删除这个用户吗',
	'USER_NO_RESULTS' => '无符合条件用户',
	'USER_USERNAME' => '用户名',
	'USER_UPDATED' => '用户资料修改成功',
	'USER_NOTEXIST' => '用户不存在',

	'ERROR_UPLOADING_FILE' => '上载文件件错误: ',
	'ERROR_UPLOAD_1' => '<i>上载文件超出最大限制</i>',
	'ERROR_UPLOAD_2' => '<i>上载文件超过大小限制</i>',
	'ERROR_UPLOAD_3' => '<i>文件进部分上载</i>',
	'ERROR_UPLOAD_4' => '<i>没有文件上载</i>',
	'ERROR_UPLOAD_5' => '<i>上载文件是0字节</i>',
	'ERROR_WRONG_CONTENT_TYPE' => '上载文件类型错误',
	'ERROR_UPLOAD_UNKNOWN' => '<i>未知文件上载错误</i>',

	'BUTTON_SUBMIT' => '提交',

	' ' => ' ',
	'END' => ' '

	);

	$smerr= array(
        '成功' => 0,
        '失败' => 100,
        '未知错误' => 102,
        '登录失败 - 密码不对' => 103,
        '注册失败 - 用户名已存在' => 104,
        '注册失败 - 用户名有非法字符' => 105,
        '注册失败 - 密码太短  ' => 106,
        '上载失败 - 文件太大' => 107,
        '上载失败 - 文件不是XML' => 108,
        '下载失败 - 文件不存在' => 109,
	);
?>
