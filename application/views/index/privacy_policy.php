<div ng-if="UserInfo.approvedTermsAndConditions || !UserInfo.isAuthenticated">
	<ncy-breadcrumb></ncy-breadcrumb>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<form name="tandc" ng-submit="approveTandC()">
				<div class="panel panel-default" style="margin-top:20px;">
					<div class="panel-body" style="max-height:600px; overflow-y:scroll; background-color:white;">
						<div style="text-align:center;">
							<h1>Privacy and Policy</h1>
							<p>
								This is where your Privcay and Policy content will go.
							</p>
						</div>
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>