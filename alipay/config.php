<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016080700190699",

		//商户私钥

		'merchant_private_key' => " MIIEpgIBAAKCAQEAv9VQc6AmdnW0NaeOd0POwRHXuOsg1XJ5L5ZoGgAfAPNvepSK+ePGWimrJ02FAWC2FzuWtaXPFbn9FGik954Ng6dzY6J39/osBdrUKW4heBEBn9X9CO8NTq2c6ZfyU8mzVcdnVkfSWHL9N7F8yHBU70sJWkc9+l5dvHOz8faNtfEEhjb22XrhvDeLiroZ3/EDsR1amGcBPMFFnLG7sqEF0lALfZW9IZt2a9qgaAsM+YQ2h2LWhIT0pPOuhw5hJEgMnSn4VKSQHs49JJdcuZsce8YzYrqMnk6Asvi/nVbVUVY1/L5sPLHfeui0YaR6XUAdRlSokF2LqUBzOZysEeeOzQIDAQABAoIBAQCCiLGk7D4f73n/5JNR3ocq42xKPVzrQWjrE8qknp56NCwQWlGzNuX65k27gclWpatiZb7ovfoLC7MFlyth/1+szV38V0qRJ9+a4EvsIS+PFutnCuKSmLAScJrMbQONNjvcy8IqeNbOLvjVU+XYMm/pIMMtdjrbSik4mfbBWAcX3MnGXxcXwO/8QBOMPqIjEd9XKppdLAxDJyLShSjxPd+NyzoaV6cankdbWKeZWoluWHTTxcsmIvkz1IgGMfhG1ol5Iknk9cpTA1GMm/hsBF2q+IER8ULqMnWt6d3pvjWo/y/IP7vZoByPsJdTNvbcN7FIJU5dyfgM+kJbFfIUURfVAoGBAO8CBNdD+f3cKAYHkSvilezvVLpONY1VhYWgK6Rgn1XYMDkmLGXb9dHMDLcFQMtGaiAgEhLFQSwRcpmgkqeBVbhWW9lh9KvtMCDHJlfQDEpd4sjxS29MzZKJkj1PEj8ek78Rzb48SLk4LkFCsXD5VQw9SsmH7iD/QHhBv1xwJUMvAoGBAM14tbA/Ma74HnK4vzWcS2LZCIP0qwSZN4xJ+bb1BDP0TISoMaesNhk3j8JN3W5rUSH4L7AhznHTeQXSSzb6E+pXoFh2D7vp2eyUv60TgV3hTTJd5xwyQupzgImk94APv7XX2wgQJsyPVctzsJPuibciJ+WpqZkcdvxg3+2EwD7DAoGBANKNDsKsqaBPwBp/tA3bEISn2hY+K8MUYgnzrj6it/sh9mmCDX62JXnqrhDVWd05bOhcGE/c4ar2u+RGpqtVrrQzr7pzJt4Gl21ow4h8STeCOfUXTIMCP98lvmSwMbzVLQcXog5CgTZaHbV0EWka3SdpH2cmjksXUi4ejXvbd5gVAoGBAKhII64co6lkxzM4Qko7Hrbvf/zq5yIWBpucfquskmumuwCu7DQiZBBVJCWENkXYGRPUO+JqXbV1+Jme+UEmoib863NoBkzmIziTP0UWQ47LFrmYlM7QD2QLgwu4k4hL3byl9FrvN4e0IRVHRCh0ZlAZ5kk/ooqm+ICNKvlSD02XAoGBAJsEJck53+8nn669OGg5ID5+I8EJunjGkecV/EqnpWG186cIoPhm/Be7bXr/DlimRXvCJ6JukpGZvd4PL5uBrwSGSWoAjS8G+LOeasIVTMk43qne17DA79Lcjx42KhDFuq9c24vd2hwar8yGvIyURj3PSCFo/82T3bdsr6o+xw2M",
		
			//异步通知地址
		'notify_url' => "http://it.youngjiajun.com/alipay/getpay.php",
		
		//同步跳转
		'return_url' => "http://it.youngjiajun.com/alipay/return_url.php",


		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAuT5uJK9s9Jeo4PGwtlQGoJOP8FaF8lgTopl0Z+JO9hfTwRNfZ0sAuv8+UBLiqXStqtP3q/woQ1EojSw8yKWT0PXTOIQL+4uoyjf/Y7xjQ55fWHJ/fzcAgs1EIxnTLJ8EiZ1V/BnmD4Xx5xIO7hCFhhuS+C21fi8PvHNjKqgCW6pdlIdTIIQ+h8VWeXKE2XGmSoqPVRO1z4AWd5gsDEgj4PHTw6jTDNJrHsuWrZ0dPx6euLjSLDHrduJFZj9l7Yl0zBq3TDbRT8i0EwjqYNLXYtdEaruuyLSzzueqPEfO7tTBfgnUDpQ+ikI5fFOdGOKkpMIotJCDmPA6a5NUv4yMlwIDAQAB",
);