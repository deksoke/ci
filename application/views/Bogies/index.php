<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
							<div class="panel-heading">
								<a href="<?php echo base_url() ?>bogies/add"><div class="btn btn-primary">Add New</div></a>
							</div>
							<div class="panel-body">
								<table class="table table-bordered table-striped table-hover">
									<thead>
									<tr>
										<td>No.</td>
										<td>NAME (TH)</td>
										<td>NAME (EN)</td>
										<td>Actions</td>
									</tr>
									</thead>
									<tbody>
									<?php

									if(count($bogies) == 0)
									{
										echo "<tr><td colspan='4' align='center'>--- no data ---</td></tr>";
									}
									else
									{
										$no = $this->uri->segment(3)+1;
										foreach($bogies as $m)
										{
											echo "<tr>";
											echo "<td>$no</td>";
											echo "<td>".$m->BOGIE_NAME_TH."</td>";
											echo "<td>".$m->BOGIE_NAME_EN."</td>";
											echo "<td>";
											echo anchor("bogies/edit/".$m->BOGIE_ID, "Edit")."&nbsp;/&nbsp;";
											echo anchor("bogies/del/".$m->BOGIE_ID, "Del", array("onclick" => "javascript:return confirm('Do you want to delete data ?');"));
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
	</div>

</div>