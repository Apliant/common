<!DOCTYPE html>
<html>
	<head>
	<title>@yield('title')</title>
		<link rel="stylesheet" href="/digi/css/bootstrap.min.css"/>
		<style>

			html, body, .container{
			  height: 100%;
			}
			.container{
			  display: table;
			  vertical-align: middle;
			}

			.vertical-center-row{
			  display: table-cell;
			  vertical-align: middle;
			}
		</style>
		@yield('pagecss')
	</head>
	<body>
		<div class="container">
			<div class="row vertical-center-row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3">
							@yield('content')
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
		<script src="/digi/js/jquery-1.11.3.min.js" type="text/javascript"></script>
		<script src="/digi/js/bootstrap/bootstrap.min.js"></script>
		@yield('pagejs')
</html>