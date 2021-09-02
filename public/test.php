<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<p>
			<pre>
<?php
				$ch = curl_init();

				curl_setopt($ch, CURLOPT_URL, "http://api.synergy/api/v1/banners/list");
				curl_setopt($ch, CURLOPT_HTTPHEADER, [ 'Accept: application/vnd.api+json', 'Content-Type: application/json' ]);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($ch, CURLOPT_POSTFIELDS, '{"filter":{"name":"ab"}}');
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

				$res = curl_exec($ch);
				$status = curl_getinfo($ch);

				curl_close($ch);

				var_dump(json_encode(json_decode($res, true), JSON_UNESCAPED_UNICODE));
?>
			</pre>
		</p>
		<hr>
		<p>
			<pre>
<?php
				var_dump($status);
?>
			</pre>
		</p>
	</body>
</html>