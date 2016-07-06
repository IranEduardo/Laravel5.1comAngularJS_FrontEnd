<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	@if(Config::get('app.debug'))
		<link href="{{ asset("build/css/app.css") }}" rel="stylesheet" />
		<link href="{{ asset("build/css/components.css") }}" rel="stylesheet" />
		<link href="{{ asset("build/css/flaticon.css") }}" rel="stylesheet" />
		<link href="{{ asset("build/css/font-awesome.css") }}" rel="stylesheet" />
	@else
		<link rel="stylesheet" href="{{ elixir("css/all.css") }}" />
	@endif


	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body class="page-dashboard">
<!--[if lt IE 7]>
  <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
    <div ng-include="'build/views/templates/menu.html'"></div>

    <div ng-view></div>

    <footer class="footer-global">
	  <div class="container">
		 <div class="row">
			<div class="col-xs-12">
				<div class="text-center">&copy; Project Manager - 2015</div>
			</div>
		  </div>
	  </div>
    </footer>

	@if(Config::get('app.debug'))
		<script src="{{ asset("build/js/vendor/jquery.min.js") }}"></script>
		<script src="{{ asset("build/js/vendor/angular.min.js") }}"></script>
		<script src="{{ asset("build/js/vendor/angular-route.min.js") }}"></script>
		<script src="{{ asset("build/js/vendor/angular-resource.min.js") }}"></script>
		<script src="{{ asset("build/js/vendor/angular-animate.min.js") }}"></script>
		<script src="{{ asset("build/js/vendor/angular-messages.min.js") }}"></script>
		<script src="{{ asset("build/js/vendor/ui-bootstrap-tpls.min.js") }}"></script>
		<script src="{{ asset("build/js/vendor/navbar.min.js") }}"></script>
		<script src="{{ asset("build/js/vendor/ng-file-upload.min.js") }}"></script>
		<script src="{{ asset("build/js/vendor/http-auth-interceptor.js") }}"></script>

		<script src="{{	asset("build/js/app.js") }} "></script>
		<!-- Controllers !-->
		<script src="{{	asset("build/js/controllers/home.js") }} "></script>
		<script src="{{	asset("build/js/controllers/login.js") }} "></script>
		<script src="{{	asset("build/js/controllers/loginModal.js") }} "></script>

		<script src="{{	asset("build/js/controllers/client/clientList.js") }} "></script>
		<script src="{{	asset("build/js/controllers/client/clientNew.js") }} "></script>
		<script src="{{	asset("build/js/controllers/client/clientEdit.js") }} "></script>
		<script src="{{	asset("build/js/controllers/client/clientRemove.js") }} "></script>
		<script src="{{	asset("build/js/controllers/client/clientShow.js") }} "></script>

		<script src="{{	asset("build/js/controllers/project/projectList.js") }} "></script>
		<script src="{{	asset("build/js/controllers/project/projectNew.js") }} "></script>
		<script src="{{	asset("build/js/controllers/project/projectEdit.js") }} "></script>
		<script src="{{	asset("build/js/controllers/project/projectRemove.js") }} "></script>
		<script src="{{	asset("build/js/controllers/project/projectShow.js") }} "></script>

		<script src="{{	asset("build/js/controllers/project_note/projectNoteList.js") }} "></script>
		<script src="{{	asset("build/js/controllers/project_note/projectNoteEdit.js") }} "></script>
		<script src="{{	asset("build/js/controllers/project_note/projectNoteNew.js") }} "></script>
		<script src="{{	asset("build/js/controllers/project_note/projectNoteRemove.js") }} "></script>
		<script src="{{	asset("build/js/controllers/project_note/projectNoteShow.js") }} "></script>

		<script src="{{	asset("build/js/controllers/project_file/projectFileList.js") }} "></script>
		<script src="{{	asset("build/js/controllers/project_file/projectFileEdit.js") }} "></script>
		<script src="{{	asset("build/js/controllers/project_file/projectFileNew.js") }} "></script>
		<script src="{{	asset("build/js/controllers/project_file/projectFileRemove.js") }} "></script>

		<script src="{{	asset("build/js/controllers/project_task/projectTaskList.js") }} "></script>
		<script src="{{	asset("build/js/controllers/project_task/projectTaskEdit.js") }} "></script>
		<script src="{{	asset("build/js/controllers/project_task/projectTaskNew.js") }} "></script>
		<script src="{{	asset("build/js/controllers/project_task/projectTaskRemove.js") }} "></script>
		<script src="{{	asset("build/js/controllers/project_task/projectTaskShow.js") }} "></script>

		<script src="{{	asset("build/js/controllers/project_member/projectMemberList.js") }} "></script>
		<script src="{{	asset("build/js/controllers/project_member/projectMemberRemove.js") }} "></script>

		<!-- Directives !-->
		<script src="{{	asset("build/js/directives/projectFileDownload.js") }} "></script>
		<script src="{{	asset("build/js/directives/loginForm.js") }} "></script>
		<script src="{{	asset("build/js/directives/menu-activated.js") }} "></script>

		<!-- Services !-->
		<script src="{{	asset("build/js/services/client.js") }} "></script>
		<script src="{{	asset("build/js/services/projectNote.js") }} "></script>
		<script src="{{	asset("build/js/services/user.js") }} "></script>
		<script src="{{	asset("build/js/services/project.js") }} "></script>
		<script src="{{	asset("build/js/services/url.js") }} "></script>
		<script src="{{	asset("build/js/services/projectFile.js") }} "></script>
		<script src="{{	asset("build/js/services/projectTask.js") }} "></script>
		<script src="{{	asset("build/js/services/projectMember.js") }} "></script>
		<script src="{{	asset("build/js/services/oauthFixInterceptor.js") }} "></script>


		<!-- OAuth2 !-->
		<script src="{{	asset("build/js/vendor/angular-cookies.min.js") }} "></script>
		<script src="{{	asset("build/js/vendor/query-string.js") }} "></script>
		<script src="{{	asset("build/js/vendor/angular-oauth2.min.js") }} "></script>

	@else
		<script src="{{ elixir("js/all.js") }}"></script>
	@endif

</body>
</html>
