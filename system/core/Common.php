<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package CodeIgniter
 * @author ExpressionEngine Dev Team
 * @copyright Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license http://codeigniter.com/user_guide/license.html
 * @link http://codeigniter.com
 * @since Version 1.0
 * @filesource
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 */
	
// ------------------------------------------------------------------------

/**
 * Common Functions
 *
 * Loads the base classes and executes the request.
 *
 * @package CodeIgniter
 * @subpackage codeigniter
 * @category Common Functions
 * @author ExpressionEngine Dev Team
 * @link http://codeigniter.com/user_guide/
 */
	
// ------------------------------------------------------------------------

/**
 * Determines if the current version of PHP is greater then the supplied value
 *
 * Since there are a few places where we conditionally test for PHP > 5
 * we'll set a static variable.
 *
 * @access public
 * @param
 *        	string
 * @return bool if the current version is $version or higher
 *        
 */
if (! function_exists ( 'is_php' )) {
	function is_php($version = '5.0.0') {
		static $_is_php;
		$version = ( string ) $version;
		
		if (! isset ( $_is_php [$version] )) {
			$_is_php [$version] = (version_compare ( PHP_VERSION, $version ) < 0) ? FALSE : TRUE;
		}
		
		return $_is_php [$version];
	}
}

// ------------------------------------------------------------------------

/**
 * Tests for file writability
 *
 * is_writable() returns TRUE on Windows servers when you really can't write to
 * the file, based on the read-only attribute. is_writable() is also unreliable
 * on Unix servers if safe_mode is on.
 *
 * @access private
 * @return void
 */
if (! function_exists ( 'is_really_writable' )) {
	function is_really_writable($file) {
		// If we're on a Unix server with safe_mode off we call is_writable
		if (DIRECTORY_SEPARATOR == '/' and @ini_get ( "safe_mode" ) == FALSE) {
			return is_writable ( $file );
		}
		
		// For windows servers and safe_mode "on" installations we'll actually
		// write a file then read it. Bah...
		if (is_dir ( $file )) {
			$file = rtrim ( $file, '/' ) . '/' . md5 ( mt_rand ( 1, 100 ) . mt_rand ( 1, 100 ) );
			
			if (($fp = @fopen ( $file, FOPEN_WRITE_CREATE )) === FALSE) {
				return FALSE;
			}
			
			fclose ( $fp );
			@chmod ( $file, DIR_WRITE_MODE );
			@unlink ( $file );
			return TRUE;
		} elseif (! is_file ( $file ) or ($fp = @fopen ( $file, FOPEN_WRITE_CREATE )) === FALSE) {
			return FALSE;
		}
		
		fclose ( $fp );
		return TRUE;
	}
}

// ------------------------------------------------------------------------

/**
 * Class registry
 *
 * This function acts as a singleton. If the requested class does not
 * exist it is instantiated and set to a static variable. If it has
 * previously been instantiated the variable is returned.
 *
 * @access public
 * @param
 *        	string	the class name being requested
 * @param
 *        	string	the directory where the class should be found
 * @param
 *        	string	the class name prefix
 * @return object
 *
 */
if (! function_exists ( 'load_class' )) {
	function &load_class($class, $directory = 'libraries', $prefix = 'CI_') {
		static $_classes = array ();
		
		// Does the class exist? If so, we're done...
		if (isset ( $_classes [$class] )) {
			return $_classes [$class];
		}
		
		$name = FALSE;
		
		// Look for the class first in the local application/libraries folder
		// then in the native system/libraries folder
		foreach ( array (
				APPPATH,
				BASEPATH 
		) as $path ) {
			if (file_exists ( $path . $directory . '/' . $class . '.php' )) {
				$name = $prefix . $class;
				
				if (class_exists ( $name ) === FALSE) {
					require ($path . $directory . '/' . $class . '.php');
				}
				
				break;
			}
		}
		
		// Is the request a class extension? If so we load it too
		if (file_exists ( APPPATH . $directory . '/' . config_item ( 'subclass_prefix' ) . $class . '.php' )) {
			$name = config_item ( 'subclass_prefix' ) . $class;
			
			if (class_exists ( $name ) === FALSE) {
				require (APPPATH . $directory . '/' . config_item ( 'subclass_prefix' ) . $class . '.php');
			}
		}
		
		// Did we find the class?
		if ($name === FALSE) {
			// Note: We use exit() rather then show_error() in order to avoid a
			// self-referencing loop with the Excptions class
			exit ( 'Unable to locate the specified class: ' . $class . '.php' );
		}
		
		// Keep track of what we just loaded
		is_loaded ( $class );
		
		$_classes [$class] = new $name ();
		return $_classes [$class];
	}
}

// --------------------------------------------------------------------

/**
 * Keeps track of which libraries have been loaded.
 * This function is
 * called by the load_class() function above
 *
 * @access public
 * @return array
 *
 */
if (! function_exists ( 'is_loaded' )) {
	function &is_loaded($class = '') {
		static $_is_loaded = array ();
		
		if ($class != '') {
			$_is_loaded [strtolower ( $class )] = $class;
		}
		
		return $_is_loaded;
	}
}

// ------------------------------------------------------------------------

/**
 * Loads the main config.php file
 *
 * This function lets us grab the config file even if the Config class
 * hasn't been instantiated yet
 *
 * @access private
 * @return array
 *
 */
if (! function_exists ( 'get_config' )) {
	function &get_config($replace = array()) {
		static $_config;
		
		if (isset ( $_config )) {
			return $_config [0];
		}
		
		// Is the config file in the environment folder?
		if (! defined ( 'ENVIRONMENT' ) or ! file_exists ( $file_path = APPPATH . 'config/' . ENVIRONMENT . '/config.php' )) {
			$file_path = APPPATH . 'config/config.php';
		}
		
		// Fetch the config file
		if (! file_exists ( $file_path )) {
			exit ( 'The configuration file does not exist.' );
		}
		
		require ($file_path);
		
		// Does the $config array exist in the file?
		if (! isset ( $config ) or ! is_array ( $config )) {
			exit ( 'Your config file does not appear to be formatted correctly.' );
		}
		
		// Are any values being dynamically replaced?
		if (count ( $replace ) > 0) {
			foreach ( $replace as $key => $val ) {
				if (isset ( $config [$key] )) {
					$config [$key] = $val;
				}
			}
		}
		
		return $_config [0] = & $config;
	}
}

// ------------------------------------------------------------------------

/**
 * Returns the specified config item
 *
 * @access public
 * @return mixed
 *
 */
if (! function_exists ( 'config_item' )) {
	function config_item($item) {
		static $_config_item = array ();
		
		if (! isset ( $_config_item [$item] )) {
			$config = & get_config ();
			
			if (! isset ( $config [$item] )) {
				return FALSE;
			}
			$_config_item [$item] = $config [$item];
		}
		
		return $_config_item [$item];
	}
}

// ------------------------------------------------------------------------

/**
 * Error Handler
 *
 * This function lets us invoke the exception class and
 * display errors using the standard error template located
 * in application/errors/errors.php
 * This function will send the error page directly to the
 * browser and exit.
 *
 * @access public
 * @return void
 *
 */
if (! function_exists ( 'show_error' )) {
	function show_error($message, $status_code = 500, $heading = 'An Error Was Encountered') {
		$_error = & load_class ( 'Exceptions', 'core' );
		echo $_error->show_error ( $heading, $message, 'error_general', $status_code );
		exit ();
	}
}

// ------------------------------------------------------------------------

/**
 * 404 Page Handler
 *
 * This function is similar to the show_error() function above
 * However, instead of the standard error template it displays
 * 404 errors.
 *
 * @access public
 * @return void
 *
 */
if (! function_exists ( 'show_404' )) {
	function show_404($page = '', $log_error = TRUE) {
		$_error = & load_class ( 'Exceptions', 'core' );
		$_error->show_404 ( $page, $log_error );
		exit ();
	}
}

// ------------------------------------------------------------------------

/**
 * Error Logging Interface
 *
 * We use this as a simple mechanism to access the logging
 * class and send messages to be logged.
 *
 * @access public
 * @return void
 *
 */
if (! function_exists ( 'log_message' )) {
	function log_message($level = 'error', $message, $php_error = FALSE) {
		static $_log;
		
		if (config_item ( 'log_threshold' ) == 0) {
			return;
		}
		
		$_log = & load_class ( 'Log' );
		$_log->write_log ( $level, $message, $php_error );
	}
}

// ------------------------------------------------------------------------

/**
 * Set HTTP Status Header
 *
 * @access public
 * @param
 *        	int		the status code
 * @param
 *        	string
 * @return void
 */
if (! function_exists ( 'set_status_header' )) {
	function set_status_header($code = 200, $text = '') {
		$stati = array (
				200 => 'OK',
				201 => 'Created',
				202 => 'Accepted',
				203 => 'Non-Authoritative Information',
				204 => 'No Content',
				205 => 'Reset Content',
				206 => 'Partial Content',
				
				300 => 'Multiple Choices',
				301 => 'Moved Permanently',
				302 => 'Found',
				304 => 'Not Modified',
				305 => 'Use Proxy',
				307 => 'Temporary Redirect',
				
				400 => 'Bad Request',
				401 => 'Unauthorized',
				403 => 'Forbidden',
				404 => 'Not Found',
				405 => 'Method Not Allowed',
				406 => 'Not Acceptable',
				407 => 'Proxy Authentication Required',
				408 => 'Request Timeout',
				409 => 'Conflict',
				410 => 'Gone',
				411 => 'Length Required',
				412 => 'Precondition Failed',
				413 => 'Request Entity Too Large',
				414 => 'Request-URI Too Long',
				415 => 'Unsupported Media Type',
				416 => 'Requested Range Not Satisfiable',
				417 => 'Expectation Failed',
				
				500 => 'Internal Server Error',
				501 => 'Not Implemented',
				502 => 'Bad Gateway',
				503 => 'Service Unavailable',
				504 => 'Gateway Timeout',
				505 => 'HTTP Version Not Supported' 
		);
		
		if ($code == '' or ! is_numeric ( $code )) {
			show_error ( 'Status codes must be numeric', 500 );
		}
		
		if (isset ( $stati [$code] ) and $text == '') {
			$text = $stati [$code];
		}
		
		if ($text == '') {
			show_error ( 'No status text available.  Please check your status code number or supply your own message text.', 500 );
		}
		
		$server_protocol = (isset ( $_SERVER ['SERVER_PROTOCOL'] )) ? $_SERVER ['SERVER_PROTOCOL'] : FALSE;
		
		if (substr ( php_sapi_name (), 0, 3 ) == 'cgi') {
			header ( "Status: {$code} {$text}", TRUE );
		} elseif ($server_protocol == 'HTTP/1.1' or $server_protocol == 'HTTP/1.0') {
			header ( $server_protocol . " {$code} {$text}", TRUE, $code );
		} else {
			header ( "HTTP/1.1 {$code} {$text}", TRUE, $code );
		}
	}
}

// --------------------------------------------------------------------

/**
 * Exception Handler
 *
 * This is the custom exception handler that is declaired at the top
 * of Codeigniter.php. The main reason we use this is to permit
 * PHP errors to be logged in our own log files since the user may
 * not have access to server logs. Since this function
 * effectively intercepts PHP errors, however, we also need
 * to display errors based on the current error_reporting level.
 * We do that with the use of a PHP error template.
 *
 * @access private
 * @return void
 *
 */
if (! function_exists ( '_exception_handler' )) {
	function _exception_handler($severity, $message, $filepath, $line) {
		// We don't bother with "strict" notices since they tend to fill up
		// the log file with excess information that isn't normally very helpful.
		// For example, if you are running PHP 5 and you use version 4 style
		// class functions (without prefixes like "public", "private", etc.)
		// you'll get notices telling you that these have been deprecated.
		if ($severity == E_STRICT) {
			return;
		}
		
		$_error = & load_class ( 'Exceptions', 'core' );
		
		// Should we display the error? We'll get the current error_reporting
		// level and add its bits with the severity bits to find out.
		if (($severity & error_reporting ()) == $severity) {
			$_error->show_php_error ( $severity, $message, $filepath, $line );
		}
		
		// Should we log the error? No? We're done...
		if (config_item ( 'log_threshold' ) == 0) {
			return;
		}
		
		$_error->log_exception ( $severity, $message, $filepath, $line );
	}
}

// --------------------------------------------------------------------

/**
 * Remove Invisible Characters
 *
 * This prevents sandwiching null characters
 * between ascii characters, like Java\0script.
 *
 * @access public
 * @param
 *        	string
 * @return string
 */
if (! function_exists ( 'remove_invisible_characters' )) {
	function remove_invisible_characters($str, $url_encoded = TRUE) {
		$non_displayables = array ();
		
		// every control character except newline (dec 10)
		// carriage return (dec 13), and horizontal tab (dec 09)
		
		if ($url_encoded) {
			$non_displayables [] = '/%0[0-8bcef]/'; // url encoded 00-08, 11, 12, 14, 15
			$non_displayables [] = '/%1[0-9a-f]/'; // url encoded 16-31
		}
		
		$non_displayables [] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S'; // 00-08, 11, 12, 14-31, 127
		
		do {
			$str = preg_replace ( $non_displayables, '', $str, - 1, $count );
		} while ( $count );
		
		return $str;
	}
}

// ------------------------------------------------------------------------

/**
 * Returns HTML escaped variable
 *
 * @access public
 * @param
 *        	mixed
 * @return mixed
 *
 */
if (! function_exists ( 'html_escape' )) {
	function html_escape($var) {
		if (is_array ( $var )) {
			return array_map ( 'html_escape', $var );
		} else {
			return htmlspecialchars ( $var, ENT_QUOTES, config_item ( 'charset' ) );
		}
	}
}

if (! function_exists ( 'show_tips' )) {
	function show_tips() {
		$quotes = array (
				"我们是谁？#我们来自北京市海淀区三所高校，是一个致力于为大学生提供便利的高校创业团队，您的支持是我们不断改进的动力，我们将竭诚为您服务！",
				"今昔能干什么？#今昔网致力于为您提供最全面的校园二手信息。",
				"新版今昔有哪些新功能？#新版今昔网强化了自动匹配功能，提供了教材专区并强力推出绑定校园BBS跳蚤版面功能，更好的界面，更多功能，更多便利！小伙伴们快去尝试吧！",
				"商品品质是什么？#今昔网商品四种品质S、A、B、C描述了商品的新旧程度、外观及功能现状。",
				"今昔网四大特色#1、系统自动匹配；<br/>&nbsp;&nbsp;&nbsp;&nbsp;2、教材专区；<br/>&nbsp;&nbsp;&nbsp;&nbsp;3、绑定本校BBS；<br/>&nbsp;&nbsp;&nbsp;&nbsp;4、精心制作的网页UI" 
		);
		$str = random_element ( $quotes );
		$array = explode ( '#', $str );
		$ret ['strtit'] = $array[0];
		$ret ['strcon'] = $array[1];
		return $ret;
	}
}

if (! function_exists ( 'get_sex' )) {
	function get_sex($sexint) {
		$sex = array (
				"兔星人",
				"喵星人",
				"汪星人" 
		);
		return $sex [$sexint];
	}
}

if (! function_exists ( 'get_namecolor' )) {
	function get_namecolor($clr) {
		$color = array (
				"text-primary",
				"text-info",
				"text-danger",
				"text-warning",
				"text-purple" 
		);
		return $color [$clr];
	}
}

if (! function_exists ( 'ld_score' )) {
	function ld_score($ld) {
		if ($ld <= 3)
			return 1;
		else if ($ld <= 10)
			return 4;
		else if ($ld <= 50)
			return 20;
		else if ($ld <= 200)
			return 40;
		else if ($ld <= 500)
			return 80;
		else
			return 120;
	}
}

if (! function_exists ( 'po_score' )) {
	function po_score($po) {
		if ($po <= 3)
			return 20;
		else if ($po <= 8)
			return 50;
		else if ($po <= 20)
			return 100;
		else if ($po <= 50)
			return 150;
		else
			return 200;
	}
}

if (! function_exists ( 'get_level' )) {
	function get_level($score) {
		if ($score <= 5)
			return 0;
		else if ($score <= 20)
			return 1;
		else if ($score <= 50)
			return 2;
		else if ($score <= 90)
			return 3;
		else if ($score <= 150)
			return 4;
		else if ($score <= 240)
			return 5;
		else if ($score <= 350)
			return 6;
		else if ($score <= 480)
			return 7;
		else if ($score <= 560)
			return 8;
		else if ($score <= 800)
			return 9;
		else if ($score <= 990)
			return 10;
		else if ($score <= 1830)
			return 11;
		else if ($score <= 3000)
			return 12;
		else if ($score <= 5000)
			return 13;
		else if ($score <= 8000)
			return 14;
		else if ($score <= 12000)
			return 15;
		else if ($score <= 20000)
			return 16;
		else if ($score <= 30000)
			return 17;
		else if ($score <= 50000)
			return 18;
		else if ($score <= 100000)
			return 19;
		else if ($score <= 300000)
			return 20;
		else
			return 21;
	}
}

if (! function_exists ( 'get_class_name' )) {
	function get_class_name($class) {
		$allclass = array (
				"手机", // 0
				"数码相机",
				"电子词典",
				"数码录音笔",
				"电子书",
				"耳机", // 5
				"移动硬盘",
				"笔记本",
				"平板",
				"电脑配件",
				"电脑数码", // 10
				"小家电",
				"居家小物",
				"杯壶",
				"个人乐器",
				"日用百货", // 15
				"男装",
				"女装",
				"配饰",
				"箱包",
				"服饰箱包", // 20
				"自行车",
				"瑜伽垫",
				"护具",
				"球类",
				"泳衣泳镜", // 25
				"运动户外",
				"公共课图书",
				"计算机图书",
				"经济管理图书",
				"工科技术图书", // 30
				"语言学习图书",
				"教育考试图书",
				"人文社科图书",
				"艺术生活图书",
				"文学小说", // 35
				"法律政治图书",
				"医学卫生图书",
				"原版小说",
				"工具书",
				"图书", // 40
				"大陆音像",
				"港台音像",
				"欧美音像",
				"日韩音像",
				"音像", // 45
				"面部护理",
				"面部彩妆",
				"身体护理",
				"护肤工具",
				"美容化妆", // 50
				"其他" 
		);
		return $allclass [$class];
	}
}

if (! function_exists ( 'get_class1' )) {
	function get_class1($class) {
		if ($class <= 10)
			return get_class_name ( 10 );
		else if ($class <= 15)
			return get_class_name ( 15 );
		else if ($class <= 20)
			return get_class_name ( 20 );
		else if ($class <= 26)
			return get_class_name ( 26 );
		else if ($class <= 40)
			return get_class_name ( 40 );
		else if ($class <= 45)
			return get_class_name ( 45 );
		else if ($class <= 50)
			return get_class_name ( 50 );
		else
			return get_class_name ( 51 );
	}
}

if (! function_exists ( 'get_class2' )) {
	function get_class2($class) {
		if ($class == 10 || $class == 15 || $class == 20 || $class == 26 || $class == 40 || $class == 45 || $class == 50 || $class == 51)
			return get_class_name ( 51 );
		else
			return get_class_name ( $class );
	}
}

if (! function_exists ( 'get_title_str' )) {
	function get_title_str($ptype, $pgtype, $pstype, $class, $brand, $modal, $pimage) {
		$titlestr = '';
		if ($ptype == 0)
			$titlestr .= '[转让]';
		else if ($ptype == 1)
			$titlestr .= '[求购]';
		if ($pgtype == 1)
			$titlestr .= '[自制]';
		else if ($pgtype == 2)
			$titlestr .= '[正品]';
		if ($pstype == 1)
			$titlestr .= '[多]';
		else if ($pstype == 2)
			$titlestr .= '[特]';
		if ($pimage > 0)
			$titlestr .= '[图]';
		$titlestr .= get_class_name ( $class );
		$titlestr .= '：';
		$titlestr .= $brand . $modal;
		return $titlestr;
	}
}

if (! function_exists ( 'get_title_full' )) {
	function get_title_full($ptype, $pgtype, $pstype, $class, $brand, $modal, $pimage) {
		$titlestr = '';
		if ($ptype == 0)
			$titlestr .= '<span class="text-primary">[转让]</span>';
		else if ($ptype == 1)
			$titlestr .= '<span class="text-primary">[求购]</span>';
		if ($pgtype == 1)
			$titlestr .= '<span class="text-warning">[自制]</span>';
		else if ($pgtype == 2)
			$titlestr .= '<span class="text-warning">[正品]</span>';
		if ($pstype == 1)
			$titlestr .= '<span class="text-warning">[多]</span>';
		else if ($pstype == 2)
			$titlestr .= '<span class="text-warning">[特]</span>';
		if ($pimage > 0)
			$titlestr .= '<span class="text-purple">[图]</span>';
		$titlestr .= get_class_name ( $class );
		$titlestr .= '：';
		$titlestr .= $brand . $modal;
		return $titlestr;
	}
}

/* End of file Common.php */
/* Location: ./system/core/Common.php */