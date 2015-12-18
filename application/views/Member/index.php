<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
							<div class="panel-heading">
								<a href="<?php echo base_url() ?>member/add"><div class="btn btn-primary">Add New</div></a>
							</div>
							<div class="panel-body">
								<table class="table table-bordered table-striped table-hover">
									<thead>
									<tr>
										<td>No.</td>
										<td>Name</td>
										<td>Telephone</td>
										<td>Actions</td>
									</tr>
									</thead>
									<tbody>
									<?php

									if(count($members) == 0)
									{
										echo "<tr><td colspan='4' align='center'>--- no data ---</td></tr>";
									}
									else
									{
										$no = $this->uri->segment(3)+1;
										foreach($members as $m)
										{
											echo "<tr>";
											echo "<td>$no</td>";
											echo "<td>".$m->member_name."</td>";
											echo "<td>".$m->member_tel."</td>";
											echo "<td>";
											echo anchor("member/edit/".$m->id, "Edit")."&nbsp;/&nbsp;";
											echo anchor("member/del/".$m->id, "Del", array("onclick" => "javascript:return confirm('Do you want to delete data ?');"));
											echo "</td>";
											echo "</tr>";
											$no++;
										}
									}
									?>
									</tbody>
								</table>
								<?php echo $this->pagination->create_links(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">About Me</div>
				<div class="panel-body">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Home</a></li>
						<li class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Profile</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								Dropdown <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#dropdown1" data-toggle="tab">Action</a></li>
								<li class="divider"></li>
								<li><a href="#dropdown2" data-toggle="tab">Another action</a></li>
							</ul>
						</li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="home">
							<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
						</div>
						<div class="tab-pane fade" id="profile">
							<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit.</p>
						</div>
						<div class="tab-pane fade" id="dropdown1">
							<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.</p>
						</div>
						<div class="tab-pane fade" id="dropdown2">
							<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater.</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>