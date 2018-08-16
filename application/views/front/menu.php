<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			<?php if ($this->session->flashdata('sukses'))
			{
    			echo '<p class="warning" style="margin: 10px 20px;">'.$this->session->flashdata('sukses').'</p>';
  			}
  			echo validation_errors('<p class="warning" style="margin: 10px 20px;">','</p>');
  			?>
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="<?php echo base_url() ?>welcome">Splash <em>.</em></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li class="btn-cta"><a href="<?php echo base_url() ?>welcome"><span>Home</span></a></li>
						<li><a href="<?php echo base_url() ?>front/feature">Features</a></li>
						<li><a href="<?php echo base_url() ?>front/pricing">Pricing</a></li>
						<li><a href="<?php echo base_url() ?>front/contact">Contact</a></li>
					</ul>
				</div>
			</div>
			
		</div>
	</nav>