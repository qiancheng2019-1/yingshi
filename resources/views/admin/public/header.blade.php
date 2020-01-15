<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta name="referrer" content="no-referrer" />

    <title>{{isset($config['siteconfig']->cmstitle) ? $config['siteconfig']->cmstitle:''}} @yield("title")</title>

    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link rel="shortcut icon" href="favicon.ico"> <link href="{{asset(__ADMIN__)}}/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="{{asset(__ADMIN__)}}/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="{{asset(__ADMIN__)}}/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="{{asset(__ADMIN__)}}/css/animate.css" rel="stylesheet">
    <link href="{{asset(__ADMIN__)}}/css/style.css?v=4.1.0" rel="stylesheet">
    <link href="{{asset(__ADMIN__)}}/css/plugins/iCheck/custom.css" rel="stylesheet">
    <script src="{{asset(__ADMIN__)}}/js/jquery.min.js?v=2.1.4"></script>
    <!-- iCheck -->
    <script src="{{asset(__ADMIN__)}}/js/plugins/iCheck/icheck.min.js"></script>
</head>
