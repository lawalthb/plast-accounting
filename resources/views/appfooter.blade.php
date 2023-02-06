<footer class="footer border-top">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<div class="copyright">&copy; 2022 {{ config("app.name") }}. {{ __('allRightsReserved') }} </div>
			</div>
			<div class="col">
				<div class="footer-links text-right">
					<a href="{{ url('info/about') }}">{{ __('aboutUs') }}</a> | 
					<a href="{{ url('info/faq') }}">{{ __('helpAndFaq') }}</a> |
					<a href="{{ url('info/contact') }}">{{ __('contactUs') }}</a>  |
					<a href="{{ url('info/privacypolicy') }}">{{ __('privacyPolicy') }}</a> |
					<a href="{{ url('info/termsandconditions') }}">{{ __('termsAndConditions') }}</a>
				</div>
			</div>
			
	<div class="col-sm-2">
		<?php 
			$langs = config('locales'); 
			$currentLang = App::getLocale();
		?>
		
		<div class="dropup">
			{{ __('language') }}:
			<button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php echo $langs[$currentLang] ?>
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<?php 
					foreach($langs as $code=>$title){
						?>
							<a class="dropdown-item" href="<?php print_link("info/changelocale/$code") ?>">
								<?php echo $title ?>
							</a>
						<?php
					}
				?>
			</div>
		</div>
	</div>

		</div>
	</div>
</footer>