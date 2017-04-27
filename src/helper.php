<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

$GLOBALS['Route']['captcha'] = "\\Jun\\captcha\\CaptchaController@index";


/**
 * @param string $id
 * @param array $config
 *
 * @return \Jun\Response
 */
function captcha( $id = "", $config = [] ) {
	$captcha = new \Jun\captcha\Captcha( $config );

	return $captcha->entry( $id );
}


/**
 * @param $id
 *
 * @return string
 */
function captcha_src( $id = "" ) {

	return U( 'captcha' );
}


/**
 * @param $id
 *
 * @return mixed
 */
function captcha_img( $id = "" ) {
	return '<img src="' . captcha_src( $id ) . '" alt="captcha" />';
}


/**
 * @param        $value
 * @param string $id
 * @param array $config
 *
 * @return bool
 */
function captcha_check( $value, $id = "", $config = [] ) {
	$captcha = new \Jun\captcha\Captcha( $config );

	return $captcha->check( $value, $id );
}

if ( ! function_exists( 'C' ) ) {
	function C( $name = '', $default = null ) {
		$temp  = $GLOBALS['Config'];
		$names = explode( '.', $name );
		if ( count( $names ) > 1 ) {
			if ( strtolower( $names[0] ) == 'database' ) {
				$temp = $GLOBALS['Database'];
			} else if ( strtolower( $names[0] ) == 'cookie' ) {
				$temp = $_COOKIE;
			} else if ( strtolower( $names[0] ) == 'session' ) {
				$temp = $_SESSION;
			}
			$name = $names[1];
		} else {
			$name = $names[0];
		}

		if ( empty( $name ) ) {
			return $temp;
		} else {
			if ( isset( $temp[ $name ] ) ) {
				return $temp[ $name ];
			} else {
				return $default;
			}
		}
	}
}

if ( ! function_exists( 'U' ) ) {
	function U( $url = '' ) {
		$postfix = is_null( C( 'url_postfix' ) ) ? '' : '.' . C( 'url_postfix' );

		return ROOT . $url . $postfix;
	}
}
