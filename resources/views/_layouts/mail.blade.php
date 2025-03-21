<html>
<body style="background-color:#eaeaea;">
<table width="100%">
	<tr>
		<td style="padding-top:10px;padding-bottom:70px;">


			<table style="max-width:700px;margin-left:auto;margin-right:auto;border-collapse: collapse;">
				<tr>
					<td style="background-color:#000;padding:10px;">
						<img src="{{$message->embed(public_path() . '/images/logo.png')}}"/>
					</td>
				</tr>
				<tr>
					<td style="background-color:#fff;font-family: Arial, Verdana, sans-serif;padding:20px;padding-bottom:50px;font-size:15px;">
						@yield('content')

					</td>

				</tr>
			</table>

		</td>
	</tr>
</table>
</body>
</html>