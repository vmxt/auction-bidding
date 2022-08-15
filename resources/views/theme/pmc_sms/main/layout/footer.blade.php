<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>The page you're trying to access is still under development. Thank you for your patience.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<footer id="footer" class="dark">

	<div class="container">

		<!-- Footer Widgets
		============================================= -->
		<div class="footer-widgets-wrap clearfix">

			<div class="col_two_third">

				<div class="col_one_third">

					<div class="widget clearfix">

						<img src="{{ env('APP_URL') }}/images/pmc.png" alt="" class="footer-logo">
			
					</div>

				</div>

				<div class="col_two_third col_last">

					<div class="widget widget_links clearfix">

						<p>We are a socially responsible and environmentally friendly ISO 14001 certified mining company</p>	
						<p>Philsaga Mining Corporation (PMC) was established on May 2001 after it was issued Certificate of Registration No. D200100478 by the Securities and Exchange Commission. It was not until July 2005 though that it formally started operations. The main office is located at C.P. Garcia Highway, Sasa, Davao City, Philippines. Its mine site is located Upper Coo, Barangay Consuelo, Bunawan, Agusan del Sur and field administrative offices at Bayugan 3, Rosario, Agusan del Sur. &nbsp;<a href="{{env('APP_URL')}}/sp/company-profile" style="color:#33FFEC;">Read more</a></p>		
				
					</div>

				</div>				

		  </div>

			<div class="col_one_third col_last">						

				<div class="widget subscribe-widget clearfix">
					<h5><strong>Subscribe</strong> to our site to receive updates &amp; news: </h5>
					<div class="widget-subscribe-form-result"></div>
					<form id="widget-subscribe-form" action="{{ route('subscriber') }}" method="post" class="nobottommargin">
						@csrf
						<div class="input-group divcenter">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="icon-email2"></i></div>
							</div>
							<input type="email" id="widget-subscribe-form-email" name="email" class="form-control required email" placeholder="Enter your Email">
							<div class="input-group-append">
								<button class="btn btn-success" type="submit">Subscribe</button>
							</div>
						</div>
					</form>
				</div>

				

			</div>

		</div><!-- .footer-widgets-wrap end -->

	</div>

  <!-- Copyrights
	============================================= -->
	<div id="copyrights">

		<div class="container clearfix">

			<div class="col_half">
				Copyrights &copy; {{ date('Y') }} All Rights Reserved by Philsaga Mining Corp.<br>
				<div class="copyright-links"><a href="/sp/terms-and-conditions">Terms of Use</a> / <a href="/sp/privacy-policy">Privacy Policy</a></div>
			</div>

			<div class="col_half col_last tright">				
				<i class="icon-envelope2"></i> mcd@philsaga.com <span class="middot">&middot;</span> <i class="icon-headphones"></i> (082) 235-0045 <span class="middot"></span>
			</div>

		</div>

	</div><!-- #copyrights end -->

</footer>

