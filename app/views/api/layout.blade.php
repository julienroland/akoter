<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
	<style>
	/*!
 * Bootstrap Docs (http://getbootstrap.com)
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under the Creative Commons Attribution 3.0 Unported License. For
 * details, see http://creativecommons.org/licenses/by/3.0/.
 */body{position:relative}.table code{font-size:13px;font-weight:400}.btn-outline{color:#563d7c;background-color:transparent;border-color:#563d7c}.btn-outline:hover,.btn-outline:focus,.btn-outline:active{color:#fff;background-color:#563d7c;border-color:#563d7c}.btn-outline-inverse{color:#fff;background-color:transparent;border-color:#cdbfe3}.btn-outline-inverse:hover,.btn-outline-inverse:focus,.btn-outline-inverse:active{color:#563d7c;text-shadow:none;background-color:#fff;border-color:#fff}.bs-docs-booticon{display:block;font-weight:500;color:#fff;background-color:#563d7c;border-radius:15%;cursor:default;text-align:center}.bs-docs-booticon-sm{width:30px;height:30px;font-size:20px;line-height:28px}.bs-docs-booticon-lg{width:144px;height:144px;font-size:108px;line-height:140px}.bs-docs-booticon-inverse{color:#563d7c;background-color:#fff}.bs-docs-booticon-outline{background-color:transparent;border:1px solid #cdbfe3}.bs-docs-nav{margin-bottom:0;background-color:#fff;border-bottom:0}.bs-home-nav .bs-nav-b{display:none}.bs-docs-nav .navbar-brand,.bs-docs-nav .navbar-nav>li>a{color:#563d7c;font-weight:500}.bs-docs-nav .navbar-nav>li>a:hover,.bs-docs-nav .navbar-nav>.active>a,.bs-docs-nav .navbar-nav>.active>a:hover{color:#463265;background-color:#f9f9f9}.bs-docs-nav .navbar-toggle .icon-bar{background-color:#563d7c}.bs-docs-nav .navbar-header .navbar-toggle{border-color:#fff}.bs-docs-nav .navbar-header .navbar-toggle:hover,.bs-docs-nav .navbar-header .navbar-toggle:focus{background-color:#f9f9f9;border-color:#f9f9f9}.bs-docs-footer{padding-top:40px;padding-bottom:40px;margin-top:100px;color:#777;text-align:center;border-top:1px solid #e5e5e5}.bs-docs-footer-links{margin-top:20px;padding-left:0;color:#999}.bs-docs-footer-links li{display:inline;padding:0 2px}.bs-docs-footer-links li:first-child{padding-left:0}@media (min-width:768px){.bs-docs-footer p{margin-bottom:0}}.bs-docs-social{margin-bottom:20px;text-align:center}.bs-docs-social-buttons{display:inline-block;margin-bottom:0;padding-left:0;list-style:none}.bs-docs-social-buttons li{display:inline-block;line-height:1;padding:5px 8px}.bs-docs-social-buttons .twitter-follow-button{width:225px!important}.bs-docs-social-buttons .twitter-share-button{width:98px!important}.github-btn{border:0;overflow:hidden}.bs-docs-masthead,.bs-docs-header{position:relative;padding:30px 15px;color:#cdbfe3;text-align:center;text-shadow:0 1px 0 rgba(0,0,0,.1);background-color:#6f5499;background-image:-webkit-linear-gradient(top,#563d7c 0,#6f5499 100%);background-image:linear-gradient(to bottom,#563d7c 0,#6f5499 100%);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#563d7c', endColorstr='#6F5499', GradientType=0)}.bs-docs-masthead .bs-docs-booticon{margin:0 auto 30px}.bs-docs-masthead h1{font-weight:300;line-height:1;color:#fff}.bs-docs-masthead .lead{margin:0 auto 30px;font-size:20px;color:#fff}.bs-docs-masthead .version{margin-top:-15px;margin-bottom:30px;color:#9783b9}.bs-docs-masthead .btn{width:100%;padding:15px 30px;font-size:20px}@media (min-width:480px){.bs-docs-masthead .btn{width:auto}}@media (min-width:768px){.bs-docs-masthead{padding-top:80px;padding-bottom:80px}.bs-docs-masthead h1{font-size:60px}.bs-docs-masthead .lead{font-size:24px}}@media (min-width:992px){.bs-docs-masthead .lead{width:80%;font-size:30px}}.bs-docs-header{margin-bottom:40px;font-size:20px}.bs-docs-header h1{margin-top:0;color:#fff}.bs-docs-header p{margin-bottom:0;font-weight:300;line-height:1.4}.bs-docs-header .container{position:relative}@media (min-width:768px){.bs-docs-header{padding-top:60px;padding-bottom:60px;font-size:24px;text-align:left}.bs-docs-header h1{font-size:60px;line-height:1}}@media (min-width:992px){.bs-docs-header h1,.bs-docs-header p{margin-right:380px}}.carbonad{width:auto!important;margin:30px -30px -31px!important;padding:20px!important;overflow:hidden;height:auto!important;font-size:13px!important;line-height:16px!important;text-align:left;background:transparent!important;border:solid #866ab3!important;border-width:1px 0!important}.carbonad-img{margin:0!important}.carbonad-text,.carbonad-tag{float:none!important;display:block!important;width:auto!important;height:auto!important;margin-left:145px!important;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif!important}.carbonad-text{padding-top:0!important}.carbonad-tag{color:inherit!important;text-align:left!important}.carbonad-text a,.carbonad-tag a{color:#fff!important}.carbonad #azcarbon>img{display:none}@media (min-width:480px){.carbonad{width:330px!important;margin:20px auto!important;border-radius:4px;border-width:1px!important}.bs-docs-masthead .carbonad{margin:50px auto 0!important}}@media (min-width:768px){.carbonad{margin-left:0!important;margin-right:0!important}}@media (min-width:992px){.carbonad{position:absolute;top:0;right:15px;margin:0!important;padding:15px!important;width:330px!important}.bs-docs-masthead .carbonad{position:static}}.bs-docs-featurette{padding-top:40px;padding-bottom:40px;font-size:16px;line-height:1.5;color:#555;text-align:center;background-color:#fff;border-bottom:1px solid #e5e5e5}.bs-docs-featurette+.bs-docs-footer{margin-top:0;border-top:0}.bs-docs-featurette-title{font-size:30px;font-weight:400;color:#333;margin-bottom:5px}.half-rule{width:100px;margin:40px auto}.bs-docs-featurette h3{font-weight:400;color:#333;margin-bottom:5px}.bs-docs-featurette-img{display:block;margin-bottom:20px;color:#333}.bs-docs-featurette-img:hover{text-decoration:none;color:#428bca}.bs-docs-featurette-img img{display:block;margin-bottom:15px}.bs-docs-featured-sites{margin-left:-1px;margin-right:-1px}.bs-docs-featured-sites .col-sm-3{padding-left:1px;padding-right:1px}@media (min-width:480px){.bs-docs-featurette .img-responsive{margin-top:30px}}@media (min-width:768px){.bs-docs-featurette{padding-top:100px;padding-bottom:100px}.bs-docs-featurette-title{font-size:40px}.bs-docs-featurette .lead{margin-left:auto;margin-right:auto;max-width:80%}.bs-docs-featured-sites .col-sm-3:first-child img{border-top-left-radius:4px;border-bottom-left-radius:4px}.bs-docs-featured-sites .col-sm-3:last-child img{border-top-right-radius:4px;border-bottom-right-radius:4px}.bs-docs-featurette .img-responsive{margin-top:0}}.bs-docs-sidebar.affix{position:static}@media (min-width:768px){.bs-docs-sidebar{padding-left:20px}}.bs-docs-sidenav{margin-top:20px;margin-bottom:20px}.bs-docs-sidebar .nav>li>a{display:block;font-size:13px;font-weight:500;color:#999;padding:4px 20px}.bs-docs-sidebar .nav>li>a:hover,.bs-docs-sidebar .nav>li>a:focus{padding-left:19px;color:#563d7c;text-decoration:none;background-color:transparent;border-left:1px solid #563d7c}.bs-docs-sidebar .nav>.active>a,.bs-docs-sidebar .nav>.active:hover>a,.bs-docs-sidebar .nav>.active:focus>a{padding-left:18px;font-weight:700;color:#563d7c;background-color:transparent;border-left:2px solid #563d7c}.bs-docs-sidebar .nav .nav{display:none;padding-bottom:10px}.bs-docs-sidebar .nav .nav>li>a{padding-top:1px;padding-bottom:1px;padding-left:30px;font-size:12px;font-weight:400}.bs-docs-sidebar .nav .nav>li>a:hover,.bs-docs-sidebar .nav .nav>li>a:focus{padding-left:29px}.bs-docs-sidebar .nav .nav>.active>a,.bs-docs-sidebar .nav .nav>.active:hover>a,.bs-docs-sidebar .nav .nav>.active:focus>a{font-weight:500;padding-left:28px}.back-to-top{display:none;margin-top:10px;margin-left:10px;padding:4px 10px;font-size:12px;font-weight:500;color:#999}.back-to-top:hover{text-decoration:none;color:#563d7c}@media (min-width:768px){.back-to-top{display:block}}@media (min-width:992px){.bs-docs-sidebar .nav>.active>ul{display:block}.bs-docs-sidebar.affix,.bs-docs-sidebar.affix-bottom{width:213px}.bs-docs-sidebar.affix{position:fixed;top:20px}.bs-docs-sidebar.affix-bottom{position:absolute}.bs-docs-sidebar.affix-bottom .bs-docs-sidenav,.bs-docs-sidebar.affix .bs-docs-sidenav{margin-top:0;margin-bottom:0}}@media (min-width:1200px){.bs-docs-sidebar.affix-bottom,.bs-docs-sidebar.affix{width:263px}}.bs-docs-section{margin-bottom:60px}.bs-docs-section:last-child{margin-bottom:0}h1[id]{margin-top:0;padding-top:20px}.bs-callout{margin:20px 0;padding:20px;border-left:3px solid #eee}.bs-callout h4{margin-top:0;margin-bottom:5px}.bs-callout p:last-child{margin-bottom:0}.bs-callout code{background-color:#fff;border-radius:3px}.bs-callout-danger{background-color:#fdf7f7;border-color:#d9534f}.bs-callout-danger h4{color:#d9534f}.bs-callout-warning{background-color:#fcf8f2;border-color:#f0ad4e}.bs-callout-warning h4{color:#f0ad4e}.bs-callout-info{background-color:#f4f8fa;border-color:#5bc0de}.bs-callout-info h4{color:#5bc0de}.color-swatches{margin:0 -5px;overflow:hidden}.color-swatch{float:left;width:60px;height:60px;margin:0 5px;border-radius:3px}@media (min-width:768px){.color-swatch{width:100px;height:100px}}.color-swatches .gray-darker{background-color:#222}.color-swatches .gray-dark{background-color:#333}.color-swatches .gray{background-color:#555}.color-swatches .gray-light{background-color:#999}.color-swatches .gray-lighter{background-color:#eee}.color-swatches .brand-primary{background-color:#428bca}.color-swatches .brand-success{background-color:#5cb85c}.color-swatches .brand-warning{background-color:#f0ad4e}.color-swatches .brand-danger{background-color:#d9534f}.color-swatches .brand-info{background-color:#5bc0de}.color-swatches .bs-purple{background-color:#563d7c}.color-swatches .bs-purple-light{background-color:#c7bfd3}.color-swatches .bs-purple-lighter{background-color:#e5e1ea}.color-swatches .bs-gray{background-color:#f9f9f9}.bs-team .team-member{color:#555;line-height:32px}.bs-team .team-member:hover{color:#333;text-decoration:none}.bs-team .github-btn{float:right;margin-top:6px;width:180px;height:20px}.bs-team img{float:left;width:32px;margin-right:10px;border-radius:4px}.show-grid{margin-bottom:15px}.show-grid [class^=col-]{padding-top:10px;padding-bottom:10px;background-color:#eee;background-color:rgba(86,61,124,.15);border:1px solid #ddd;border:1px solid rgba(86,61,124,.2)}.bs-example{position:relative;padding:45px 15px 15px;margin:0 -15px 15px;background-color:#fafafa;box-shadow:inset 0 3px 6px rgba(0,0,0,.05);border-color:#e5e5e5 #eee #eee;border-style:solid;border-width:1px 0}.bs-example:after{content:"Example";position:absolute;top:15px;left:15px;font-size:12px;font-weight:700;color:#bbb;text-transform:uppercase;letter-spacing:1px}.bs-example+.highlight{margin:-15px -15px 15px;border-radius:0;border-width:0 0 1px}@media (min-width:768px){.bs-example{margin-left:0;margin-right:0;background-color:#fff;border-width:1px;border-color:#ddd;border-radius:4px 4px 0 0;box-shadow:none}.bs-example+.highlight{margin-top:-16px;margin-left:0;margin-right:0;border-width:1px;border-bottom-left-radius:4px;border-bottom-right-radius:4px}}.bs-example .container{width:auto}.bs-example>p:last-child,.bs-example>ul:last-child,.bs-example>ol:last-child,.bs-example>blockquote:last-child,.bs-example>.form-control:last-child,.bs-example>.table:last-child,.bs-example>.navbar:last-child,.bs-example>.jumbotron:last-child,.bs-example>.alert:last-child,.bs-example>.panel:last-child,.bs-example>.list-group:last-child,.bs-example>.well:last-child,.bs-example>.progress:last-child,.bs-example>.table-responsive:last-child>.table{margin-bottom:0}.bs-example>p>.close{float:none}.bs-example-type .table .type-info{color:#999;vertical-align:middle}.bs-example-type .table td{padding:15px 0;border-color:#eee}.bs-example-type .table tr:first-child td{border-top:0}.bs-example-type h1,.bs-example-type h2,.bs-example-type h3,.bs-example-type h4,.bs-example-type h5,.bs-example-type h6{margin:0}.bs-example-bg-classes p{padding:15px}.bs-example>.img-circle,.bs-example>.img-rounded,.bs-example>.img-thumbnail{margin:5px}.bs-example>.table-responsive>.table{background-color:#fff}.bs-example>.btn,.bs-example>.btn-group{margin-top:5px;margin-bottom:5px}.bs-example>.btn-toolbar+.btn-toolbar{margin-top:10px}.bs-example-control-sizing select,.bs-example-control-sizing input[type=text]+input[type=text]{margin-top:10px}.bs-example-form .input-group{margin-bottom:10px}.bs-example>textarea.form-control{resize:vertical}.bs-example>.list-group{max-width:400px}.bs-example .navbar:last-child{margin-bottom:0}.bs-navbar-top-example,.bs-navbar-bottom-example{z-index:1;padding:0;overflow:hidden}.bs-navbar-top-example .navbar-header,.bs-navbar-bottom-example .navbar-header{margin-left:0}.bs-navbar-top-example .navbar-fixed-top,.bs-navbar-bottom-example .navbar-fixed-bottom{position:relative;margin-left:0;margin-right:0}.bs-navbar-top-example{padding-bottom:45px}.bs-navbar-top-example:after{top:auto;bottom:15px}.bs-navbar-top-example .navbar-fixed-top{top:-1px}.bs-navbar-bottom-example{padding-top:45px}.bs-navbar-bottom-example .navbar-fixed-bottom{bottom:-1px}.bs-navbar-bottom-example .navbar{margin-bottom:0}@media (min-width:768px){.bs-navbar-top-example .navbar-fixed-top,.bs-navbar-bottom-example .navbar-fixed-bottom{position:absolute}.bs-navbar-top-example{border-radius:0 0 4px 4px}.bs-navbar-bottom-example{border-radius:4px 4px 0 0}}.bs-example .pagination{margin-top:10px;margin-bottom:10px}.bs-example>.pager{margin-top:0}.bs-example-modal{background-color:#f5f5f5}.bs-example-modal .modal{position:relative;top:auto;right:auto;left:auto;bottom:auto;z-index:1;display:block}.bs-example-modal .modal-dialog{left:auto;margin-left:auto;margin-right:auto}.bs-example>.dropdown>.dropdown-menu{position:static;display:block;margin-bottom:5px}.bs-example-tabs .nav-tabs{margin-bottom:15px}.bs-example-tooltips{text-align:center}.bs-example-tooltips>.btn{margin-top:5px;margin-bottom:5px}.bs-example-popover{padding-bottom:24px;background-color:#f9f9f9}.bs-example-popover .popover{position:relative;display:block;float:left;width:260px;margin:20px}.scrollspy-example{position:relative;height:200px;margin-top:10px;overflow:auto}.highlight{padding:9px 14px;margin-bottom:14px;background-color:#f7f7f9;border:1px solid #e1e1e8;border-radius:4px}.highlight pre{padding:0;margin-top:0;margin-bottom:0;background-color:transparent;border:0;white-space:nowrap}.highlight pre code{font-size:inherit;color:#333}.highlight pre .lineno{display:inline-block;width:22px;padding-right:5px;margin-right:10px;text-align:right;color:#bebec5}.table-responsive .highlight pre{white-space:normal}.bs-table th small,.responsive-utilities th small{display:block;font-weight:400;color:#999}.responsive-utilities tbody th{font-weight:400}.responsive-utilities td{text-align:center}.responsive-utilities td.is-visible{color:#468847;background-color:#dff0d8!important}.responsive-utilities td.is-hidden{color:#ccc;background-color:#f9f9f9!important}.responsive-utilities-test{margin-top:5px}.responsive-utilities-test .col-xs-6{margin-bottom:10px}.responsive-utilities-test span{display:block;padding:15px 10px;font-size:14px;font-weight:700;line-height:1.1;text-align:center;border-radius:4px}.visible-on .col-xs-6 .hidden-xs,.visible-on .col-xs-6 .hidden-sm,.visible-on .col-xs-6 .hidden-md,.visible-on .col-xs-6 .hidden-lg,.hidden-on .col-xs-6 .hidden-xs,.hidden-on .col-xs-6 .hidden-sm,.hidden-on .col-xs-6 .hidden-md,.hidden-on .col-xs-6 .hidden-lg{color:#999;border:1px solid #ddd}.visible-on .col-xs-6 .visible-xs,.visible-on .col-xs-6 .visible-sm,.visible-on .col-xs-6 .visible-md,.visible-on .col-xs-6 .visible-lg,.hidden-on .col-xs-6 .visible-xs,.hidden-on .col-xs-6 .visible-sm,.hidden-on .col-xs-6 .visible-md,.hidden-on .col-xs-6 .visible-lg{color:#468847;background-color:#dff0d8;border:1px solid #d6e9c6}.bs-glyphicons{margin:0 -19px 20px -16px;overflow:hidden}.bs-glyphicons-list{padding-left:0;list-style:none}.bs-glyphicons li{float:left;width:25%;height:115px;padding:10px;font-size:10px;line-height:1.4;text-align:center;border:1px solid #fff;background-color:#f9f9f9}.bs-glyphicons .glyphicon{margin-top:5px;margin-bottom:10px;font-size:24px}.bs-glyphicons .glyphicon-class{display:block;text-align:center;word-wrap:break-word}.bs-glyphicons li:hover{color:#fff;background-color:#563d7c}@media (min-width:768px){.bs-glyphicons{margin-left:0;margin-right:0}.bs-glyphicons li{width:12.5%;font-size:12px}}.bs-customizer .toggle{float:right;margin-top:25px}.bs-customizer label{margin-top:10px;font-weight:500;color:#555}.bs-customizer h2{margin-top:0;margin-bottom:5px;padding-top:30px}.bs-customizer h3{margin-bottom:0}.bs-customizer h4{margin-top:15px;margin-bottom:0}.bs-customizer .bs-callout h4{margin-top:0;margin-bottom:5px}.bs-customizer input[type=text]{font-family:Menlo,Monaco,Consolas,"Courier New",monospace;background-color:#fafafa}.bs-customizer .help-block{font-size:12px;margin-bottom:5px}#less-section label{font-weight:400}.bs-customizer-input{float:left;width:33.333333%;padding-left:15px;padding-right:15px}.bs-customize-download .btn-outline{padding:20px}.bs-customizer-alert{position:fixed;top:0;left:0;right:0;z-index:1030;padding:15px 0;color:#fff;background-color:#d9534f;box-shadow:inset 0 1px 0 rgba(255,255,255,.25);border-bottom:1px solid #b94441}.bs-customizer-alert .close{margin-top:-4px;font-size:24px}.bs-customizer-alert p{margin-bottom:0}.bs-customizer-alert .glyphicon{margin-right:5px}.bs-customizer-alert pre{margin:10px 0 0;color:#fff;background-color:#a83c3a;border-color:#973634;box-shadow:inset 0 2px 4px rgba(0,0,0,.05),0 1px 0 rgba(255,255,255,.1)}.bs-brand-logos{display:table;width:100%;margin-bottom:15px;overflow:hidden;color:#563d7c;background-color:#f9f9f9;border-radius:4px}.bs-brand-item{padding:60px 0;text-align:center}.bs-brand-item+.bs-brand-item{border-top:1px solid #fff}.bs-brand-logos .inverse{color:#fff;background-color:#563d7c}.bs-brand-item h1,.bs-brand-item h3{margin-top:0;margin-bottom:0}.bs-brand-item .bs-docs-booticon{margin-left:auto;margin-right:auto}.bs-brand-item .glyphicon{width:30px;height:30px;margin:10px auto -10px;line-height:30px;color:#fff;border-radius:50%}.bs-brand-item .glyphicon-ok{background-color:#5cb85c}.bs-brand-item .glyphicon-remove{background-color:#d9534f}@media (min-width:768px){.bs-brand-item{display:table-cell;width:1%}.bs-brand-item+.bs-brand-item{border-top:0;border-left:1px solid #fff}.bs-brand-item h1{font-size:60px}}.bs-examples .thumbnail{margin-bottom:10px}.bs-examples h4{margin-bottom:5px}.bs-examples p{margin-bottom:20px}#focusedInput{border-color:#ccc;border-color:rgba(82,168,236,.8);outline:0;outline:thin dotted \9;-moz-box-shadow:0 0 8px rgba(82,168,236,.6);box-shadow:0 0 8px rgba(82,168,236,.6)}.hll{background-color:#ffc}.c{color:#999}.err{color:#A00;background-color:#FAA}.k{color:#069}.o{color:#555}.cm{color:#999}.cp{color:#099}.c1{color:#999}.cs{color:#999}.gd{background-color:#FCC;border:1px solid #C00}.ge{font-style:italic}.gr{color:red}.gh{color:#030}.gi{background-color:#CFC;border:1px solid #0C0}.go{color:#AAA}.gp{color:#009}.gu{color:#030}.gt{color:#9C6}.kc{color:#069}.kd{color:#069}.kn{color:#069}.kp{color:#069}.kr{color:#069}.kt{color:#078}.m{color:#F60}.s{color:#d44950}.na{color:#4f9fcf}.nb{color:#366}.nc{color:#0A8}.no{color:#360}.nd{color:#99F}.ni{color:#999}.ne{color:#C00}.nf{color:#C0F}.nl{color:#99F}.nn{color:#0CF}.nt{color:#2f6f9f}.nv{color:#033}.ow{color:#000}.w{color:#bbb}.mf{color:#F60}.mh{color:#F60}.mi{color:#F60}.mo{color:#F60}.sb{color:#C30}.sc{color:#C30}.sd{color:#C30;font-style:italic}.s2{color:#C30}.se{color:#C30}.sh{color:#C30}.si{color:#A00}.sx{color:#C30}.sr{color:#3AA}.s1{color:#C30}.ss{color:#FC3}.bp{color:#366}.vc{color:#033}.vg{color:#033}.vi{color:#033}.il{color:#F60}.css .o,.css .o+.nt,.css .nt+.nt{color:#999}</style>	
	<style>
	/*
 * Derived from einaros's Sons of Obsidian theme at
 * http://studiostyl.es/schemes/son-of-obsidian by
 * Alex Ford of CodeTunnel:
 * http://CodeTunnel.com/blog/post/71/google-code-prettify-obsidian-theme
 */

 .str
 {
 	color: #EC7600;
 }
 .kwd
 {
 	color: #93C763;
 }
 .com
 {
 	color: #66747B;
 }
 .typ
 {
 	color: #678CB1;
 }
 .lit
 {
 	color: #FACD22;
 }
 .pun
 {
 	color: #E7E1E1;
 }
 .pln
 {
 	color: #E7E1E1;
 }
 .tag
 {
 	color: #8AC763;
 }
 .atn
 {
 	color: #E0E2E4;
 }
 .atv
 {
 	color: #EC7600;
 }
 .dec
 {
 	color: purple;
 }
 pre.prettyprint
 {
 	border: 0px solid #888;
 }
 ol.linenums
 {
 	margin-top: 0;
 	margin-bottom: 0;
 }
 .prettyprint {
 	background: #000;
 }
 li.L0, li.L1, li.L2, li.L3, li.L4, li.L5, li.L6, li.L7, li.L8, li.L9
 {
 	color: #555;
 	list-style-type: decimal;
 }
 li.L1, li.L3, li.L5, li.L7, li.L9 {
 	background: #111;
 }
 @media print
 {
 	.str
 	{
 		color: #060;
 	}
 	.kwd
 	{
 		color: #006;
 		font-weight: bold;
 	}
 	.com
 	{
 		color: #600;
 		font-style: italic;
 	}
 	.typ
 	{
 		color: #404;
 		font-weight: bold;
 	}
 	.lit
 	{
 		color: #044;
 	}
 	.pun
 	{
 		color: #440;
 	}
 	.pln
 	{
 		color: #000;
 	}
 	.tag
 	{
 		color: #006;
 		font-weight: bold;
 	}
 	.atn
 	{
 		color: #404;
 	}
 	.atv
 	{
 		color: #060;
 	}
 }

</style>
{{HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css')}}
</head>
<body>
	<div style="margin-top: 50px; padding:1em 0;" class="container">
		<nav class=" navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{url('api/doc')}}">API - Doc</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">

						<li {{Helpers::isActive('locations', Request::segment(2))}}>
							<a href="{{url('api/doc/locations')}}">Locations</a>
						</li>
						<li {{Helpers::isActive('schools', Request::segment(2))}}>
							<a href="{{url('api/doc/schools')}}">Schools</a>
						</li>

					</ul>
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-default">Submit</button>
					</form> 
					<ul class="nav navbar-nav navbar-right">
						<li><a href="{{url('api/doc/leave')}}">Quitter l'API</a></li>
					</ul>
				</div>
			</div><!-- /.container-fluid -->
		</nav>
		@yield('doc')
	</div>
</body>

@if(isset($widget) && !in_array('nojs', $widget) || !isset($widget))
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
@endif
<script>
	$.ajax({
			url:"/api/location/get/20",
			dataType: "json",
			type:"get",
			success:function(oData){
				console.log(oData);
			}
		});
</script>
{{HTML::script('js/nprogress.js')}}
<script>
	NProgress.start();
	$(window).bind("load", function() {
		NProgress.done();
	});
</script>

{{HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js')}}

{{HTML::script('js/jquery.tipsy.js')}}
<script>
	$(function() {
		$('.tooltip-ui-e').tipsy({fade: true,gravity:'w',delayOut: 100, opacity: 0.9});
		$('.tooltip-ui-w').tipsy({fade: true,gravity:'e',delayOut: 100, opacity: 0.9});
		$('.tooltip-ui-s').tipsy({fade: true,gravity:'n',delayOut: 100, opacity: 0.9});
		$('.tooltip-ui-n').tipsy({fade: true,gravity:'s',delayOut: 100, opacity: 0.9});
	});
</script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script async>
	(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
		function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
	e=o.createElement(i);r=o.getElementsByTagName(i)[0];
	e.src='//www.google-analytics.com/analytics.js';
	r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
	ga('create','UA-XXXXX-X');ga('send','pageview');
</script>
</body>
</html>

</html>