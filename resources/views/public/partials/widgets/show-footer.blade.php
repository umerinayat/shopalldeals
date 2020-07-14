<div class="container-fluid p-0" style="position:fixed;bottom:0;right:0;">
    <div class="row">
        <div class="col-sm-12 text-right">
            
            <button style="z-index:10;position:fixed;bottom:0;left:0;font-size:.5rem" id="showFooterBtn" class="btn ml-4 mb-4 btn-sm btn-outline-success"><b><i class="fas fa-plus"></i></b></button>
        </div>
    </div>
    	<!-- Footer Section -->
	<footer class="footer-section" id="footerSection"">
		<div class="container">
			<a href="/" class="footer-logo">
				<img class="footer-logo" src="{{asset('images/logo.png')}}" alt="shopalldeals">
			</a>
			<div class="row">
				<div class="col-lg-4 col-sm-6">
					<div class="footer-widget">
						<h2>Site Info</h2>
						<ul>
							<li><a href="{{route('privacy')}}">Privacy Policy</a></li>
                            <li><a href="{{route('terms')}}">Terms and Conditions</a></li>
                            <li><a href="{{route('about')}}">About us</a></li>
						</ul>
					</div>
				</div>
				
			</div>
			
			<div class="copyright">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <a href="https://shopalldeals.com" target="_blank">Shopalldeals</a>
</div>
		</div>
	</footer>
	<!-- Footer Section end -->
</div>