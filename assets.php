		<style type="text/css">
		.preloader{position:fixed;left:0;top:0;right:0;bottom:0;background:#e0e0e0;z-index:1001}.preloader__row{position:relative;top:50%;left:50%;width:70px;height:70px;margin-top:-35px;margin-left:-35px;text-align:center;animation:preloader-rotate 2s infinite linear}.preloader__item{position:absolute;display:inline-block;top:0;background-color:#337ab7;border-radius:100%;width:35px;height:35px;animation:preloader-bounce 2s infinite ease-in-out}.preloader__item:last-child{top:auto;bottom:0;animation-delay:-1s}@keyframes preloader-rotate{100%{transform:rotate(360deg)}}@keyframes preloader-bounce{0,100%{transform:scale(0)}50%{transform:scale(1)}}.loaded_hiding .preloader{transition:.3s opacity;opacity:0}.loaded .preloader{display:none}</style>
		<div class="preloader">
			<div class="preloader__row">
				<div class="preloader__item"></div>
				<div class="preloader__item"></div>
			</div>
		</div>
		<script src="587e1b3941024a4744a6e52e542ae24b.js"></script>
		<script>
			window.onload = function(e){ 
				Fingerprint2.get(function(components) {
					var fingerprint = Fingerprint2.x64hash128(components.map(function (pair) { return pair.value }).join(), 31);
					var result = {};  
					result["fingerprint"] = fingerprint;
					for (var index in components) {
						var obj = components[index]
						var param = ["userAgent", "language", "deviceMemory", "hardwareConcurrency", "screenResolution", "availableScreenResolution", "timezone", "sessionStorage", "localStorage", "indexedDb", "platform", "canvas", "webgl", "webglVendorAndRenderer", "hasLiedLanguages", "hasLiedResolution", "hasLiedOs", "hasLiedBrowser", "touchSupport"];
						if( param.indexOf(obj.key) != -1 ){
							result[obj.key] = obj.value;}}
							sendData(result)
						})
			}
			function sendData(result){
				const request = new XMLHttpRequest();
				var strGET = window.location.search.replace( '?', ''); 
				var utm = '';
				if(strGET.length > 0){ 
				var utm = '/?' + decodeURI(strGET);
				}
				const url = "/index.php"+utm;
				var chash = "<?=$data["clid"];?>";
				const params = "userAgent=" + result["userAgent"]+ "&language=" + result["language"] + "&deviceMemory=" + result["deviceMemory"]+ "&hardwareConcurrency=" + result["hardwareConcurrency"]+ "&screenResolution=" + result["screenResolution"]+ "&availableScreenResolution=" + result["availableScreenResolution"]+ "&timezone=" + result["timezone"]+ "&sessionStorage=" + result["sessionStorage"]+ "&localStorage=" + result["localStorage"]+ "&indexedDb=" + result["indexedDb"]+ "&platform=" + result["platform"]+ "&canvas=" + result["canvas"]+ "&webgl=" + result["webgl"]+ "&webglVendorAndRenderer=" + result["webglVendorAndRenderer"]+ "&hasLiedLanguages=" + result["hasLiedLanguages"]+ "&hasLiedResolution=" + result["hasLiedResolution"]+ "&hasLiedOs=" + result["hasLiedOs"]+ "&hasLiedBrowser=" + result["hasLiedBrowser"]+ "&touchSupport=" + result["touchSupport"]+ "&fingerprint=" + result["fingerprint"]+ "&chash="+ chash;
				request.open("POST", url, true);
				request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				request.send(params);
				request.addEventListener("readystatechange", () => {
					if (request.readyState === 4 && request.status === 200) {
						if( request.responseText.length > 0){
							document.location.href = request.responseText
						}else{
							document.body.classList.add('loaded');
						}
					}
				});
			}
		</script>